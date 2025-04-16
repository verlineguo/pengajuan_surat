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
        $user = Auth::user();
        $surats = Surat::all();
        $mahasiswaNrp = User::where('kode_prodi', $user->kode_prodi)->pluck('nomor_induk')->toArray();
        $pengajuans = Pengajuan::whereIn('nrp', $mahasiswaNrp)->get();
        $pengajuanPending = Pengajuan::where('status_pengajuan', 'pending')->whereIn('nrp', $mahasiswaNrp)->get();

        $pengajuanDiterima = Pengajuan::where('status_pengajuan', 'Disetujui')->whereIn('nrp', $mahasiswaNrp)->get();

        $pengajuanDitolak = Pengajuan::where('status_pengajuan', 'Ditolak')->whereIn('nrp', $mahasiswaNrp)->get();
        return view('TU.dashboard', compact('user', 'pengajuans', 'pengajuanDiterima', 'pengajuanPending', 'pengajuanDitolak'));
    }

   

}
