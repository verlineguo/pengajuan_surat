<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KaprodiController extends Controller
{
    public function index() {
        $kaprodi = Auth::user();        
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('status_pengajuan', 'pending')->get();
        $pengajuanDiterima = Pengajuan::where('status_pengajuan', 'Disetujui')->get();
        $pengajuanPending = Pengajuan::where('status_pengajuan', 'pending')->get();
        $pengajuanDitolak = Pengajuan::where('status_pengajuan', 'Ditolak')->get();
        return view('kaprodi.dashboard', compact('kaprodi', 'pengajuans', 'pengajuanDiterima', 'pengajuanPending', 'pengajuanDitolak'));
    }

    public function profile() {
        $kaprodi = Auth::user();        
        return view('kaprodi.profile', compact('kaprodi'));
    }

    public function updateProfile(Request $request, $nomor_induk) {
        $kaprodi = User::where('nomor_induk', $nomor_induk)->firstOrFail();

        $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,'.$kaprodi->nomor_induk.',nomor_induk',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $nomor_induk . ',nomor_induk',
            'role_id' => 'required|exists:role,id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

    
     if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('profiles', 'public');
            $kaprodi->profile = $imagePath;
            $kaprodi->save();

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
    
        $kaprodi->update($data);
        return redirect()->route('kaprodi.profile')->with('success', 'User berhasil diperbarui!');
    }


}
