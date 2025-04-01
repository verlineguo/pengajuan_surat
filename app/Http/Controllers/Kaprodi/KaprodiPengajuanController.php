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
        $kaprodi = Auth::user();
        $pengajuans = Pengajuan::with('mahasiswa', 'surat')->get();
        return view('kaprodi.pengajuan.index', compact('kaprodi','pengajuans'));
    }

    public function show($id) {
        $kaprodi = Auth::user();
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'detailSurat')->findOrFail($id);

        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);
    
        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }

        if ($pengajuan->detailSurat->tanggal_kelulusan) {
            $pengajuan->detailSurat->tanggal_kelulusan = Carbon::parse($pengajuan->detailSurat->tanggal_kelulusan);
        }

        return view('kaprodi.pengajuan.show', compact('kaprodi','pengajuan'));


    }

    public function approve($id) {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => 'Disetujui',
            'tanggal_persetujuan' => now(),
        ]);
        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject($id, Request $request) {
        $request->validate([
            'catatan_kaprodi' => 'nullable|string',
            'catatan_tu' => 'nullable|string',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => 'Ditolak',
            'catatan_kaprodi' => $request->catatan_kaprodi,
            'catatan_tu' => $request->catatan_tu,
        ]);

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_pengajuan = $request->status_pengajuan;
        $pengajuan->catatan_kaprodi = $request->catatan_kaprodi; // Simpan catatan Kaprodi
        $pengajuan->save();

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Status pengajuan berhasil diperbarui.');
    }



    public function destroy($id) {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil dihapus.');
    }
}
