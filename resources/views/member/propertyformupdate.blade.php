<x-app-layout>
    <div class="w-full max-w-5xl mx-auto p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Property</h2>

        <form id="propertyForm"
              method="POST"
              action="{{ route('member.properties.update', $property->id) }}"
              enctype="multipart/form-data"
              class="grid grid-cols-1 gap-4">
            @csrf
            @method('PUT')

            <!-- Property Title -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            </div>

            <!-- Property Type & Post Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Property Type</label>
                    <select name="property_type" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                        <option value="">Select Type</option>
                        <option value="House" {{ old('property_type', $property->property_type) == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Apartment" {{ old('property_type', $property->property_type) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="Commercial" {{ old('property_type', $property->property_type) == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Villa" {{ old('property_type', $property->property_type) == 'Villa' ? 'selected' : '' }}>Villa</option>
                        <option value="Bungalow" {{ old('property_type', $property->property_type) == 'Bungalow' ? 'selected' : '' }}>Bungalow</option>
                        <option value="Land" {{ old('property_type', $property->property_type) == 'Land' ? 'selected' : '' }}>Land</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Post Type</label>
                    <select name="post_type" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                        <option value="">Select Post Type</option>
                        <option value="Sale" {{ old('post_type', $property->post_type) == 'Sale' ? 'selected' : '' }}>Sale</option>
                        <option value="Rent" {{ old('post_type', $property->post_type) == 'Rent' ? 'selected' : '' }}>Rent</option>
                    </select>
                </div>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Price</label>
                <input type="number" name="price" value="{{ old('price', $property->price) }}" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            </div>

            <!-- Location Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city', $property->city) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">State</label>
                    <input type="text" name="state" value="{{ old('state', $property->state) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Postal Code</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $property->postal_code) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Country</label>
                <input type="text" name="country" value="{{ old('country', $property->country) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            </div>

            <!-- Bedrooms, Bathrooms, Area -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Bedrooms</label>
                    <input type="number" name="bedrooms" min="0" value="{{ old('bedrooms', $property->bedrooms) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Bathrooms</label>
                    <input type="number" name="bathrooms" min="0" value="{{ old('bathrooms', $property->bathrooms) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Area (sq ft)</label>
                    <input type="number" name="area" min="0" value="{{ old('area', $property->area) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>
            </div>

            <!-- Year Built -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Year Built</label>
                <input type="number" name="year_built" min="1800" max="{{ date('Y') }}" value="{{ old('year_built', $property->year_built) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">{{ old('description', $property->description) }}</textarea>
            </div>

            <!-- Publish -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $property->is_published) ? 'checked' : '' }} class="mr-2" required>
                    <span class="text-gray-700">Publish this property</span>
                </label>
            </div>

            <!-- Images -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Upload Images</label>
                <input type="file" name="images[]" id="imageInput" multiple accept="image/*"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <div id="imagePreviewContainer" class="grid grid-cols-3 gap-4 mt-4"></div>
            </div>

            <!-- Submit -->
            <div class="flex justify-center pt-4">
                <button type="submit"
                    class="px-6 py-3 bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition-all">Update Property</button>
            </div>
        </form>
    </div>
</x-app-layout>