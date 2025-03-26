<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TuPengajuanController extends Controller
{
    public function index() {
        $pengajuans = Pengajuan::with('mahasiswa', 'surat')->get();
        return view('tu.pengajuan.index', compact('pengajuans'));
    }

    public function show($id) {
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'detailSurat')->findOrFail($id);

        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);
    
        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }

        if ($pengajuan->detailSurat->tanggal_kelulusan) {
            $pengajuan->detailSurat->tanggal_kelulusan = Carbon::parse($pengajuan->detailSurat->tanggal_kelulusan);
        }

        return view('tu.pengajuan.show', compact('pengajuan'));


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
