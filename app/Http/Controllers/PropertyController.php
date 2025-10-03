<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();

        $member = auth()->user()->member; // Use relationship

        if (!$member) {
           return redirect()->back()->with('error', 'Only members can list properties');
        }

        $data['member_id'] = $member->id;
        $data['slug'] = Str::slug($data['title']);

        // Ensure unique slug
        $slug = $data['slug'];
        $counter = 1;
        while (Property::where('slug', $slug)->exists()) {
            $slug = $data['slug'] . '-' . $counter++;
        }
        $data['slug'] = $slug;

        $property = Property::create($data);

        // handle images if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store("properties/{$property->id}", 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'file_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('member.properties.show', $property->slug)
            ->with('success', 'Property listed successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
         $property = Property::with(['images', 'member.user'])
        ->where('slug', $slug)
        ->firstOrFail();

           return view('member.propertyshow', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);

        $data = $request->validated();

        // Remove empty strings to avoid overwriting existing data
        $data = array_filter($data, fn($value) => !is_null($value) && $value !== '');

        if (isset($data['title']) && $data['title'] !== $property->title) {
            $slug = Str::slug($data['title']);
            $counter = 1;
            while (Property::where('slug', $slug)->where('id', '!=', $property->id)->exists()) {
                $slug = Str::slug($data['title']) . '-' . $counter++;
            }
            $data['slug'] = $slug;
        }

        $property->update($data);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store("properties/{$property->id}", 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'file_path' => $path,
                    'sort_order' => $property->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('member.properties.show', $property->slug)
            ->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
    $this->authorize('delete', $property);

    // Delete files
    foreach ($property->images as $img) {
        Storage::disk('public')->delete($img->file_path);
    }

    $property->delete(); // soft delete if using SoftDeletes

    return redirect()->route('member.dashboard')->with('success', 'Property deleted successfully');

    }

    public function browse() 
    {
        $properties = Property::with('images')->latest()->get();
        return view('browse', compact('properties'));
    }


}
