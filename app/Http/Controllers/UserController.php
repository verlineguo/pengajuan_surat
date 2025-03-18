<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::with('role')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create(){
    $roles = Role::all(); 
    return view('admin.user.create', compact('roles'));
}


    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Ambil semua role untuk pilihan dropdown
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_induk' => 'required|string|max:10|unique:users,nomor_induk',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:role,id',
            'profile' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        User::create([
            'nomor_induk' => $request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role_id' => $request->role_id,
            'profile' => $request->profile,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan!');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $request->validate([
            'nomor_induk' => 'required|string|max:10|unique:users,nomor_induk,' . $id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:role,id',
            'profile' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $data = [
            'nomor_induk' => $request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
        return redirect()->route('admin.user')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus!');
    }

}
