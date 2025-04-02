<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Prodi;
class UserController extends Controller
{
    public function index() {
        $users = User::with('role')->get();
    
        $roles = Role::all(); 
        $prodis = Prodi::all();

        return view('admin.user.index', compact('users', 'roles', 'prodis'));
    }

    public function create(){
        $roles = Role::all(); 
        $prodis = Prodi::all();

        return view('admin.user.create', compact('roles', 'prodis'));
    }


    public function edit($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $roles = Role::all(); // Ambil semua role untuk pilihan dropdown
        $prodis = Prodi::all();

        return view('admin.user.edit', compact('user', 'roles', 'prodis'));
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_induk' => 'required|string|max:10|unique:users,nomor_induk',
            'name' => 'required|string|max:255',
            'kode_prodi' => 'nullable|exists:prodi,kode_prodi',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:role,id',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile')) {
            $profilePicturePath = $request->file('profile')->store('profiles', 'public');
        }

        User::create([
            'nomor_induk' => $request->nomor_induk,
            'name' => $request->name,
            'kode_prodi' => $request->kode_prodi,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role_id' => $request->role_id,
            'profile' => $profilePicturePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan!');
    }

    
    public function update(Request $request, $nomor_induk) {
        $user = User::where('nomor_induk', $nomor_induk)->firstOrFail();

        $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,'.$user->nomor_induk.',nomor_induk',
            'name' => 'required|string|max:255',
            'kode_prodi' => 'required|exists:prodi,kode_prodi',
            'email' => 'required|email|unique:users,email,' . $nomor_induk . ',nomor_induk',
            'role_id' => 'required|exists:role,id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

    
     if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $imagePath;
            $user->save();

        }
   

        $data = [
            'nomor_induk' => $request->nomor_induk,
            'kode_prodi' => $request->kode_prodi,
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

    public function destroy($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus!');
    }

}
