<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    public function index() {
        $user = Auth::user();        
        $matakuliahs = MataKuliah::all();
        return view('admin.matakuliah.index', compact('matakuliahs', 'user'));
    }

    public function create(){
        $user = Auth::user();
        $prodis = Prodi::all();
        return view('admin.matakuliah.create', compact('user', 'prodis'));
    }

    public function edit($id) {
        $user = Auth::user();
        $prodis = Prodi::all();
        $matakuliah = MataKuliah::findOrFail($id);
        return view('admin.matakuliah.edit', compact('matakuliah', 'user', 'prodis'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:50',
            'kode_prodi' => 'required|exists:prodi,kode_prodi',
        ]);

        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'kode_prodi' => $request->kode_prodi
        ]);

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $matakuliah = MataKuliah::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk,' . $id . ',kode_mk',
            'nama_mk' => 'required|string|max:50',
            'kode_prodi' => 'required|exists:prodi,kode_prodi',

        ]);

        $matakuliah->update([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'kode_prodi' => $request->kode_prodi

        ]);

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function destroy($id) {
        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
