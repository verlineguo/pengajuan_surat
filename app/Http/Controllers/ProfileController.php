<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile($role)
    {
        $user = Auth::user();

        // Pastikan role sesuai dengan pengguna yang sedang login
        if ($user->role->name !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return view("$role.profile", compact('user'));
    }
    public function updateProfile(Request $request, $role) {
        $user = Auth::user();
    
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($user->role->name !== $role) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->hasFile(key: 'profile')) {
            $user->profile = $request->file('profile')->store('profile', 'public');
        }
        $user->save();
        return redirect()->route('profile', ['role' => $role])
        ->with('success', 'Profil berhasil diperbarui.');    }
}
