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
        $mahasiswa = Auth::user();
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('nrp', Auth::user()->nomor_induk)->get();
        return view('mahasiswa.pengajuan.index', compact('mahasiswa', 'pengajuans', 'surats'));
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

    public function update(Request $request, $id_pengajuan)
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

        // Cari pengajuan berdasarkan ID
        $pengajuan = Pengajuan::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        
        // Update data pengajuan
        $pengajuan->update([
            'id_surat' => $request->id_surat,
            'status_pengajuan' => 'pending', // Jika perlu dikembalikan ke pending setelah update
        ]);

        // Update atau buat detail surat jika belum ada
        $detailSurat = DetailSurat::where('pengajuan_id', $id_pengajuan)->first();
        
        if ($detailSurat) {
            $detailSurat->update([
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
        } else {
            DetailSurat::create([
                'pengajuan_id' => $id_pengajuan,
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
        }

        return redirect()->route('mahasiswa.pengajuan.history')->with('success', 'Pengajuan surat berhasil diperbarui!');
    }

    public function edit($id_pengajuan) {
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $surats = Surat::all();
        $mahasiswa = Auth::user();
        return view('mahasiswa.pengajuan.edit', compact('pengajuan', 'surats', 'mahasiswa'));
    }
    
    public function show($id_pengajuan)
    {
        $mahasiswa = Auth::user();
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'detailSurat')->findOrFail($id_pengajuan);
        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);
        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }
        if ($pengajuan->detailSurat->tanggal_kelulusan) {
            $pengajuan->detailSurat->tanggal_kelulusan = Carbon::parse($pengajuan->detailSurat->tanggal_kelulusan);
        }
        return view('mahasiswa.pengajuan.show', compact('pengajuan', 'mahasiswa'));
        
    }

    public function destroy($id_pengajuan)
    {
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $detailSurat = DetailSurat::where('id_pengajuan', $id_pengajuan)->first();
        if ($detailSurat) {
            $detailSurat->delete();
        }
        
        // Hapus file terkait jika ada
        if ($pengajuan->file_pendukung) {
            Storage::delete($pengajuan->file_pendukung);
        }

        $pengajuan->delete();
        return redirect()->route('mahasiswa.pengajuan.history')->with('success', 'Pengajuan berhasil dihapus.');
    }


    public function approve($id_pengajuan) {
        
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $pengajuan->update([
            'status_pengajuan' => 'Disetujui',
            'tanggal_persetujuan' => now(),
        ]);
        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject($id_pengajuan, Request $request) {
    
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);
        $pengajuan->update([
            'status_pengajuan' => 'Ditolak',
            'catatan_kaprodi' => $request->catatan_kaprodi,
        ]);

        return redirect()->route('kaprodi.pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
    }

}
