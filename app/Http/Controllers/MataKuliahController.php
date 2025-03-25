<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index() {
        $matakuliahs = MataKuliah::all();
        return view('admin.matakuliah.index', compact('matakuliahs'));
    }

    public function create(){
        return view('admin.matakuliah.create');
    }

    public function edit($id) {
        $matakuliah = MataKuliah::findOrFail($id);
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:50',
        ]);

        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk
        ]);

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $matakuliah = MataKuliah::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk,' . $id . ',kode_mk',
            'nama_mk' => 'required|string|max:50',
        ]);

        $matakuliah->update([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
        ]);

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    public function destroy($id) {
        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('admin.matakuliah')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
