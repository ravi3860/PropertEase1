<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Get current admin
    private function getAdmin() {
        return Admin::with('user')->where('user_id', auth()->id())->first();
    }

    // Show Admin Dashboard
    public function dashboard()
    {
        $admin = $this->getAdmin();
        $members = User::where('role', 'member')->get();
        $agents = User::where('role', 'agent')->get();
        return view('admin.dashboard', compact('admin', 'members', 'agents'));
    }

    // Update Member
    public function updateMember(Request $request, $id)
    {
        $member = User::findOrFail($id);
        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $member->password
        ]);
        return redirect()->back()->with('success', 'Member updated successfully.');
    }

    // Delete Member
    public function deleteMember($id)
    {
        $member = User::findOrFail($id);
        $member->delete();
        return redirect()->back()->with('success', 'Member deleted successfully.');
    }

    // Update Agent
    public function updateAgent(Request $request, $id)
    {
        $agent = User::findOrFail($id);
        $agent->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $agent->password
        ]);
        return redirect()->back()->with('success', 'Agent updated successfully.');
    }

    // Delete Agent
    public function deleteAgent($id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();
        return redirect()->back()->with('success', 'Agent deleted successfully.');
    }
}
