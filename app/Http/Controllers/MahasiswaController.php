<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index() {
        $user = Auth::user();
        $surats = Surat::all();
        $pengajuans = Pengajuan::where('nrp', Auth::user()->nomor_induk)->get();
        $pengajuanDiterima = Pengajuan::where('status_pengajuan', 'Disetujui')->get();
        $pengajuanPending = Pengajuan::where('status_pengajuan', 'pending')->get();
        $pengajuanDitolak = Pengajuan::where('status_pengajuan', 'Ditolak')->get();
        return view('mahasiswa.dashboard', compact('user', 'pengajuans', 'pengajuanDiterima', 'pengajuanPending', 'pengajuanDitolak'));
    }

   



}
