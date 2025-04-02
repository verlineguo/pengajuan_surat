<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\User;

class ProdiController extends Controller
{
    public function index()
    {
        // Menampilkan semua prodi
        $prodiList = Prodi::with(['kaprodi', 'tu'])->get();
        return view('prodi.index', compact('prodiList'));
    }

    public function create()
    {
        // Ambil daftar kaprodi dan TU yang tersedia
        $kaprodiList = User::where('role_id', 2)->get();
        $tuList = User::where('role_id', 3)->get();

        return view('prodi.create', compact('kaprodiList', 'tuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'required|string|max:10|unique:prodi,kode_prodi',
            'kaprodi_id' => 'nullable|exists:users,nomor_induk',
            'tu_id' => 'nullable|exists:users,nomor_induk',
        ]);

        Prodi::create($request->all());

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $prodi = Prodi::with(['kaprodi', 'tu'])->findOrFail($id);
        return view('prodi.show', compact('prodi'));
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $kaprodiList = User::where('role_id', 2)->get();
        $tuList = User::where('role_id', 3)->get();

        return view('prodi.edit', compact('prodi', 'kaprodiList', 'tuList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'required|string|max:10',
            'kaprodi_id' => 'nullable|exists:users,nomor_induk',
            'tu_id' => 'nullable|exists:users,nomor_induk',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Prodi::destroy($id);
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
