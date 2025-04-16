<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexKaryawan() {
        $user = Auth::user();        
        $users = User::whereHas('role', function ($query) {
            $query->whereNot('name', 'mahasiswa');
        })->get();
        
    
        $roles = Role::whereNot('name', 'mahasiswa')->get();
        $prodis = Prodi::all();

        return view('admin.karyawan.index', compact('user','users', 'roles', 'prodis'));
    }

    public function createKaryawan(){
        $user = Auth::user();        
        $roles = Role::whereNot('name', 'mahasiswa')->get();
        $prodis = Prodi::all();

        return view('admin.karyawan.create', compact('user', 'roles', 'prodis'));
    }


    public function editKaryawan($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $roles = Role::whereNot('name', 'mahasiswa')->get();
        $prodis = Prodi::all();

        return view('admin.karyawan.edit', compact('user', 'roles', 'prodis'));
    }

    public function storeKaryawan(Request $request) {
        $request->validate([
            'nomor_induk' => 'required|string|max:10|unique:users,nomor_induk',
            'name' => 'required|string|max:255',
            'kode_prodi' => 'required|exists:prodi,kode_prodi',
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

        return redirect()->route('admin.karyawan')->with('success', 'User berhasil ditambahkan!');
    }

    
    public function updateKaryawan(Request $request, $nomor_induk) {
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
            'status' => 'nullable|in:aktif,tidak aktif',


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
            'status' => $request->status,


            
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
        return redirect()->route('admin.karyawan')->with('success', 'User berhasil diperbarui!');
    }

    public function destroyKaryawan($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $user->delete();

        return redirect()->route('admin.karyawan')->with('success', 'User berhasil dihapus!');
    }


    public function indexMahasiswa() {
        $user = Auth::user();        

        $users = User::with('role', 'prodi')->get();
    
        $prodis = Prodi::all();

        return view('admin.mahasiswa.index', compact('user','users', 'prodis'));
    }

    public function createMahasiswa(){
        $roles = Role::all(); 
        $prodis = Prodi::all();
        $user = Auth::user();        


        return view('admin.mahasiswa.create', compact('user','roles', 'prodis'));
    }


    public function editMahasiswa($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $roles = Role::all(); // Ambil semua role untuk pilihan dropdown
        $prodis = Prodi::all();

        return view('admin.mahasiswa.edit', compact('user', 'roles', 'prodis'));
    }

    public function storeMahasiswa(Request $request) {
        $request->validate([
            'nomor_induk' => 'required|string|max:10|unique:users,nomor_induk',
            'name' => 'required|string|max:255',
            'kode_prodi' => 'nullable|exists:prodi,kode_prodi',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
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
            'role_id' => 4,
            'profile' => $profilePicturePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.mahasiswa')->with('success', 'User berhasil ditambahkan!');
    }

    
    public function updateMahasiswa(Request $request, $nomor_induk) {
        $user = User::where('nomor_induk', $nomor_induk)->firstOrFail();

        $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,'.$user->nomor_induk.',nomor_induk',
            'name' => 'required|string|max:255',
            'kode_prodi' => 'required|exists:prodi,kode_prodi',
            'email' => 'required|email|unique:users,email,' . $nomor_induk . ',nomor_induk',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:aktif,tidak aktif',


        ]);

    
     if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $imagePath;
            $user->save();

        }
   

        $data = [
            'nomor_induk' => $request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'kode_prodi' => $request->kode_prodi,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
        return redirect()->route('admin.mahasiswa')->with('success', 'User berhasil diperbarui!');
    }

    public function destroyMahasiswa($nomor_induk) {
        $user = User::findOrFail($nomor_induk);
        $user->delete();

        return redirect()->route('admin.mahasiswa')->with('success', 'User berhasil dihapus!');
    }

    

}
