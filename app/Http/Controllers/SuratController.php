<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index() {
        $user = Auth::user();        
        $surats = Surat::all();
        return view('admin.surat.index', compact('user','surats'));
    }

    public function create(){
        $user = Auth::user();        
        return view('admin.surat.create', compact('user'));
    }

    public function edit($id) {
        $user = Auth::user();        
        $surat = Surat::findOrFail($id);
        return view('admin.surat.edit', compact('surat', 'user'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_jenis_surat' => 'required|string|max:50',

        ]);

        Surat::create([
            'nama_jenis_surat' => $request->nama_jenis_surat
        ]);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'nama_jenis_surat' => 'required|string|max:50',
        ]);


        $surat->update([
            'nama_jenis_surat' => $request->nama_jenis_surat,
        ]);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil diperbarui!');
    }

    public function destroy($id) {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil dihapus!');
    }
}
