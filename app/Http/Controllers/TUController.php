<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TUController extends Controller
{
    public function index() {
        $tu = Auth::user();        
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('status_pengajuan', 'disetujui')->get();
        $pengajuanDiterima = Pengajuan::where('status_pengajuan', 'Disetujui')->get();
        $pengajuanPending = Pengajuan::where('status_pengajuan', 'pending')->get();
        $pengajuanDitolak = Pengajuan::where('status_pengajuan', 'Ditolak')->get();
        return view('TU.dashboard', compact('tu', 'pengajuans', 'pengajuanDiterima', 'pengajuanPending', 'pengajuanDitolak'));
    }

    public function profile() {
        $tu = Auth::user();        
        return view('TU.profile', compact('tu'));
    }

    public function updateProfile(Request $request, $nomor_induk) {
        $tu = User::where('nomor_induk', $nomor_induk)->firstOrFail();

        $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,'.$tu->nomor_induk.',nomor_induk',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $nomor_induk . ',nomor_induk',
            'role_id' => 'required|exists:role,id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

    
     if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $tu->profile = $imagePath;
            $tu->save();

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
    
        $tu->update($data);
        return redirect()->route('TU.profile')->with('success', 'User berhasil diperbarui!');
    }

}
