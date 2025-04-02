<?php

namespace App\Http\Controllers;

use App\Models\LHS;
use App\Models\Pengajuan;
use App\Models\SKL;
use App\Models\SKMA;
use App\Models\SPTMK;
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
        ]);
        


        $pengajuan = Pengajuan::create([
            'nrp' => Auth::user()->nomor_induk,
            'id_surat' => $request->id_surat,
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        
        switch ($request->id_surat) {
            case 1:
                SKMA::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan,
                    'semester' => $request->semester,
                    'alamat_bandung' => $request->alamat_bandung,
                    'keperluan' => $request->keperluan,
                ]);
                break;
    
            case 2:
                SPTMK::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan,
                    'tujukan' => $request->tujukan,
                    'mata_kuliah' => $request->mata_kuliah,
                    'semester' => $request->semester,
                    'data_mahasiswa' => $request->data_mahasiswa,
                    'tujuan' => $request->tujuan,
                    'topik' => $request->topik,
                ]);
                break;
    
            case 3:
                SKL::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan,
                    'tanggal_kelulusan' => $request->tanggal_kelulusan,
                ]);
                break;
    
            case 4:
                LHS::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan,
                    'keperluan' => $request->keperluan,
                ]);
                break;
    
            default:
                throw new \Exception('Jenis surat tidak valid.');
        }
    
        return redirect()->route('mahasiswa.pengajuan.history')->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    public function update(Request $request, $id_pengajuan)
    {
        $request->validate([
            'id_surat' => 'required',
            'semester' => 'nullable|string',
            'alamat_bandung' => 'nullable|string',
            'keperluan' => 'nullable|string',
            'tujukan' => 'nullable|string',
            'mata_kuliah' => 'nullable|string',
            'data_mahasiswa' => 'nullable|string',
            'topik' => 'nullable|string',
            'tanggal_kelulusan' => 'nullable|date',
        ]);

        // Cari pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);

        // Update data pengajuan
        $pengajuan->update([
            'id_surat' => $request->id_surat,
            'status_pengajuan' => 'pending', // Jika perlu dikembalikan ke pending setelah update
        ]);

        // Update detail surat berdasarkan jenis surat
        switch ($request->id_surat) {
            case 1: // Surat Keterangan Mahasiswa Aktif
                $skma = SKMA::where('pengajuan_id', $id_pengajuan)->first();
                if ($skma) {
                    $skma->update([
                        'semester' => $request->semester,
                        'alamat_bandung' => $request->alamat_bandung,
                        'keperluan' => $request->keperluan,
                    ]);
                } else {
                    SKMA::create([
                        'pengajuan_id' => $id_pengajuan,
                        'semester' => $request->semester,
                        'alamat_bandung' => $request->alamat_bandung,
                        'keperluan' => $request->keperluan,
                    ]);
                }
                break;

            case 2: // Surat Pengantar Tugas Mata Kuliah
                $sptmk = SPTMK::where('pengajuan_id', $id_pengajuan)->first();
                if ($sptmk) {
                    $sptmk->update([
                        'tujukan' => $request->tujukan,
                        'mata_kuliah' => $request->mata_kuliah,
                        'semester' => $request->semester,
                        'data_mahasiswa' => $request->data_mahasiswa,
                        'tujuan' => $request->tujuan,
                        'topik' => $request->topik,
                    ]);
                } else {
                    SPTMK::create([
                        'pengajuan_id' => $id_pengajuan,
                        'tujukan' => $request->tujukan,
                        'mata_kuliah' => $request->mata_kuliah,
                        'semester' => $request->semester,
                        'data_mahasiswa' => $request->data_mahasiswa,
                        'tujuan' => $request->tujuan,
                        'topik' => $request->topik,
                    ]);
                }
                break;

            case 3: // Surat Keterangan Lulus
                $skl = SKL::where('pengajuan_id', $id_pengajuan)->first();
                if ($skl) {
                    $skl->update([
                        'tanggal_kelulusan' => $request->tanggal_kelulusan,
                    ]);
                } else {
                    SKL::create([
                        'pengajuan_id' => $id_pengajuan,
                        'tanggal_kelulusan' => $request->tanggal_kelulusan,
                    ]);
                }
                break;

            case 4: // Laporan Hasil Studi
                $lhs = LHS::where('pengajuan_id', $id_pengajuan)->first();
                if ($lhs) {
                    $lhs->update([
                        'keperluan' => $request->keperluan,
                    ]);
                } else {
                    LHS::create([
                        'pengajuan_id' => $id_pengajuan,
                        'keperluan' => $request->keperluan,
                    ]);
                }
                break;

            default:
                throw new \Exception('Jenis surat tidak valid.');
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
        $pengajuan = Pengajuan::with('mahasiswa', 'surat', 'lhs', 'skl', 'skma', 'sptmk')->findOrFail($id_pengajuan);
        $pengajuan->tanggal_pengajuan = Carbon::parse($pengajuan->tanggal_pengajuan);
        if ($pengajuan->tanggal_persetujuan) {
            $pengajuan->tanggal_persetujuan = Carbon::parse($pengajuan->tanggal_persetujuan);
        }
        if ($pengajuan->skl && $pengajuan->skl->tanggal_kelulusan) {
            $pengajuan->skl->tanggal_kelulusan = Carbon::parse($pengajuan->skl->tanggal_kelulusan);
        }
        return view('mahasiswa.pengajuan.show', compact('pengajuan', 'mahasiswa'));
        
    }

    public function destroy($id_pengajuan)
    {
        // Cari pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id_pengajuan);

        // Hapus detail surat berdasarkan jenis surat
        switch ($pengajuan->id_surat) {
            case 1:
                $skma = SKMA::where('pengajuan_id', $id_pengajuan)->first();
                if ($skma) {
                    $skma->delete();
                }
                break;

            case 2:
                $sptmk = SPTMK::where('pengajuan_id', $id_pengajuan)->first();
                if ($sptmk) {
                    $sptmk->delete();
                }
                break;

            case 3:
                $skl = SKL::where('pengajuan_id', $id_pengajuan)->first();
                if ($skl) {
                    $skl->delete();
                }
                break;

            case 4:
                $lhs = LHS::where('pengajuan_id', $id_pengajuan)->first();
                if ($lhs) {
                    $lhs->delete();
                }
                break;

            default:
                throw new \Exception('Jenis surat tidak valid.');
        }

        // Hapus file pendukung jika ada
        if ($pengajuan->file_pendukung) {
            Storage::delete($pengajuan->file_pendukung);
        }

        // Hapus pengajuan
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
