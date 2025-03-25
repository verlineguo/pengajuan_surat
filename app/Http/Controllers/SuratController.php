<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index() {
        $surats = Surat::all();
        return view('admin.surat.index', compact('surats'));
    }

    public function create(){
        return view('admin.surat.create');
    }

    public function edit($id) {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.edit', compact('surat'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_jenis_surat' => 'required|string|max:50',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('surat', 'public');
        }

        Surat::create([
            'nama_jenis_surat' => $request->nama_jenis_surat,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil ditambahkan!');
    }   

    public function update(Request $request, $id) {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'nama_jenis_surat' => 'required|string|max:50',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($surat->file_path) {
                Storage::disk('public')->delete($surat->file_path);
            }
            $path = $request->file('file')->store('surat', 'public');
        } else {
            $path = $surat->file_path;
        }

        $surat->update([
            'nama_jenis_surat' => $request->nama_jenis_surat,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil diperbarui!');
    }  

    public function destroy($id) {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil dihapus!');
    }
}
