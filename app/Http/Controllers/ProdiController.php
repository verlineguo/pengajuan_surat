<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    public function index()
    {
        $user = Auth::user();        
        $prodis = Prodi::all();
        return view('admin.prodi.index', compact('prodis', 'user'));
    }

    public function create()
    {
        $user = Auth::user();        

        return view('admin.prodi.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'nama_prodi' => 'required|string|max:50',
            'kode_prodi' => 'required|string|max:10|unique:prodi,kode_prodi',
          
        ]);

        Prodi::create($request->all());

        return redirect()->route('admin.prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $user = Auth::user();
        $prodi = Prodi::findOrFail($id);
        return view('admin.prodi.edit', compact('prodi', 'user'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:prodi,kode_prodi,' . $id . ',kode_prodi',
            'nama_prodi' => 'required|string|max:50',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return redirect()->route('admin.prodi')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('admin.prodi')->with('success', 'Prodi berhasil dihapus!');
    }
}
