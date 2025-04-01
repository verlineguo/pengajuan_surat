<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswa = Auth::user();        
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('nrp', Auth::user()->nomor_induk)->get();
        $pengajuanDiterima = Pengajuan::where('status_pengajuan', 'Disetujui')->get();
        $pengajuanPending = Pengajuan::where('status_pengajuan', 'pending')->get();
        $pengajuanDitolak = Pengajuan::where('status_pengajuan', 'Ditolak')->get();
        return view('mahasiswa.dashboard', compact('mahasiswa', 'pengajuans', 'pengajuanDiterima', 'pengajuanPending', 'pengajuanDitolak'));
    }

    public function profile() {
        $mahasiswa = Auth::user();        
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    public function updateProfile(Request $request, $nomor_induk) {
        $user = User::where('nomor_induk', $nomor_induk)->firstOrFail();

        $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,'.$user->nomor_induk.',nomor_induk',
            'name' => 'required|string|max:255',
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
        return redirect()->route('mahasiswa.profile')->with('success', 'User berhasil diperbarui!');
    }



}
