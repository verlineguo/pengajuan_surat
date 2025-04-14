<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\User;
use App\Notifications\LetterUploaded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index() {
        $user = Auth::user();
        $pengajuans = Pengajuan::with('mahasiswa', 'surat')
        ->whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })
        ->get();

        return view('TU.pengajuan.index', compact('user','pengajuans'));
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

        return view('TU.pengajuan.show', compact('user','pengajuan'));


    }

    
    public function update(Request $request, $id_pengajuan)
    {
        $user = Auth::user();

        $pengajuan = Pengajuan::whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })->findOrFail($id_pengajuan);
    
        $pengajuan->status_pengajuan = $request->status_pengajuan;
        $pengajuan->catatan_tu = $request->catatan_tu; 
        $pengajuan->save();

        return redirect()->route('tu.pengajuan')->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function uploadSurat(Request $request, $id_pengajuan)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:2048', // Hanya menerima file PDF dengan ukuran maksimal 2MB
            'catatan_tu' => 'nullable|string|max:255', // Catatan TU opsional
        ]);
        $user = Auth::user();

        $pengajuan = Pengajuan::whereHas('mahasiswa', function ($query) use ($user) {
            $query->where('kode_prodi', $user->kode_prodi);
        })->findOrFail($id_pengajuan);
    
        // Hapus file surat lama jika ada
        if ($pengajuan->file_surat) {
            $oldFilePath = public_path('uploads/surat/' . $pengajuan->file_surat);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Simpan file surat baru
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/surat'), $filename);

            $pengajuan->update([
                'file_surat' => $filename,
                'catatan_tu' => $request->catatan_tu, 
                'status_pengajuan' => 'Done', 
                
            ]);

            $mahasiswa = User::where('nomor_induk', $pengajuan->nrp)->first();
            $mahasiswa->notify(new LetterUploaded($pengajuan));
            
            $kaprodi = User::where('role_id', 3)
                        ->where('kode_prodi', $mahasiswa->kode_prodi)
                        ->where('status', 'aktif')
                        ->get();
            
            foreach ($kaprodi as $kp) {
                $kp->notify(new LetterUploaded($pengajuan));
            }
            
        }

        return redirect()->route('tu.pengajuan.show', ['id_pengajuan' => $id_pengajuan])
                        ->with('success', 'Surat berhasil diunggah ulang dan catatan TU diperbarui.');
    }


}
