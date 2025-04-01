<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index() {

        $users = User::all();
        $user = Auth::user();

        $totalMahasiswa = User::whereHas('role', function ($query) {
            $query->where('name', 'mahasiswa');
        })->count();
    
        $totalKaryawan = User::whereHas('role', function ($query) {
            $query->whereIn('name', ['tu', 'admin', 'kaprodi']);
        })->count();
    
        $totalSurat = Surat::count();
        $totalMataKuliah = MataKuliah::count();
    
        return view('admin.dashboard', compact('users','user', 'totalMahasiswa', 'totalKaryawan', 'totalSurat', 'totalMataKuliah'));
    }
    public function profile() {
        $user = Auth::user();        
        return view('admin.profile', compact('user'));
    }

}