<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiPengajuanController extends Controller
{
    public function index() {
        $user = Auth::user();
        $pengajuans = Pengajuan::with('mahasiswa', 'surat')
        ->whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })
        ->get();
        return view('kaprodi.pengajuan.index', compact('user','pengajuans'));
    }

    public function show($id_pengajuan) {
        $user = Auth::user();
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'lhs', 'skl', 'skma', 'sptmk')
        ->whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })
        ->findOrFail($id_pengajuan);

        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);
    
        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }

        if ($pengajuan->skl && $pengajuan->skl->tanggal_kelulusan) {
            $pengajuan->skl->tanggal_kelulusan = Carbon::parse($pengajuan->skl->tanggal_kelulusan);
        }

        return view('kaprodi.pengajuan.show', compact('user','pengajuan'));


    }

    public function approve($id_pengajuan) {
        $user = Auth::user();
        $pengajuan = Pengajuan::whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })->findOrFail($id_pengajuan);
        $pengajuan->update([
            'status_pengajuan' => 'Disetujui',
            'tanggal_persetujuan' => now(),
        ]);
        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject($id_pengajuan, Request $request) {
        $request->validate([
            'catatan_kaprodi' => 'nullable|string',
            'catatan_tu' => 'nullable|string',
        ]);

        $user = Auth::user();
        $pengajuan = Pengajuan::whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })->findOrFail($id_pengajuan);
                
        $pengajuan->update([
            'status_pengajuan' => 'Ditolak',
            'catatan_kaprodi' => $request->catatan_kaprodi,
            'catatan_tu' => $request->catatan_tu,
        ]);

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function update(Request $request, $id_pengajuan)
    {
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status_pengajuan = $request->status_pengajuan;
        $pengajuan->catatan_kaprodi = $request->catatan_kaprodi; // Simpan catatan Kaprodi
        $pengajuan->save();

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Status pengajuan berhasil diperbarui.');
    }



    public function destroy($id_pengajuan) {
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $pengajuan->delete();

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil dihapus.');
    }
}
