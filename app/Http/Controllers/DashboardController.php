<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingCount = Auth::user()->tasks()->where('status', 'pending')->count();
        $inProgressCount = Auth::user()->tasks()->where('status', 'in_progress')->count();
        $completedCount = Auth::user()->tasks()->where('status', 'completed')->count();
        return view('dashboard', compact('pendingCount', 'inProgressCount', 'completedCount'));
    }

    public function settings()
    {
        return view('settings');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        $user->name = $request->input('name');

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                $oldImagePath = public_path('storage/' . $user->profile_image); 
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); 
                }
            }

            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();
        
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
    }

}
