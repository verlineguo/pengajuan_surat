<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use App\Models\Pengajuan;
use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index() {
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('nrp', Auth::user()->nomor_induk)->get();
        return view('mahasiswa.pengajuan.index', compact('pengajuans', 'surats'));
    }

    public function create() {
        $surats = Surat::all();
        $mahasiswa = Auth::user();
        return view('mahasiswa.pengajuan.create', compact('surats', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required',
            'name' => 'nullable|string',
            'nrp' => 'nullable|string',
            'semester' => 'nullable|string',
            'alamat_bandung' => 'nullable|string',
            'keperluan' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'tujukan' => 'nullable|string',
            'mata_kuliah' => 'nullable|string',
            'data_mahasiswa' => 'nullable|string',
            'topik' => 'nullable|string',
            'tanggal_kelulusan' => 'nullable|date',
        ]);
        


        $pengajuan = Pengajuan::create([
            'nrp' => Auth::user()->nomor_induk,
            'id_surat' => $request->id_surat,
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        DetailSurat::create([
            'pengajuan_id' => $pengajuan->id_pengajuan,
            'semester' => $request->semester,
            'alamat_bandung' => $request->alamat_bandung,
            'keperluan' => $request->keperluan,
            'tujuan' => $request->tujuan,
            'tujukan' => $request->tujukan,
            'mata_kuliah' => $request->mata_kuliah,
            'data_mahasiswa' => $request->data_mahasiswa,
            'topik' => $request->topik,
            'tanggal_kelulusan' => $request->tanggal_kelulusan,
        ]);

        

        return redirect()->route('mahasiswa.pengajuan.history')->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    public function edit($id) {
        $pengajuan = Pengajuan::findOrFail($id);
        $surats = Surat::all();
        $mahasiswa = Auth::user();
        return view('mahasiswa.pengajuan.edit', compact('pengajuan', 'surats', 'mahasiswa'));
    }

    

    public function show($id)
    {
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'detailSurat')->findOrFail($id);
        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);

        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }
        if ($pengajuan->detailSurat->tanggal_kelulusan) {
            $pengajuan->detailSurat->tanggal_kelulusan = Carbon::parse($pengajuan->detailSurat->tanggal_kelulusan);
        }
        return view('mahasiswa.pengajuan.show', compact('pengajuan'));

        
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $detailSurat = DetailSurat::where('id_pengajuan', $id)->first();
        if ($detailSurat) {
            $detailSurat->delete();
        }
        
        // Hapus file terkait jika ada
        if ($pengajuan->file_pendukung) {
            Storage::delete($pengajuan->file_pendukung);
        }

        if ($detailSurat) {
            $detailSurat->delete();
        }
        

        $pengajuan->delete();
        return redirect()->route('mahasiswa.pengajuan.history')->with('success', 'Pengajuan berhasil dihapus.');
    }


    public function approve($id) {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status_pengajuan' => 'Disetujui',
            'tanggal_persetujuan' => now(),
        ]);
        return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil disetujui.');
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
        ]);

        return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
    }



}
