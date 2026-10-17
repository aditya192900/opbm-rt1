<?php

namespace App\Http\Controllers;

use App\Models\UmkmWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmWargaController extends Controller
{
    public function index()
    {
        $umkms = UmkmWarga::latest()->paginate(12);
        return view('umkm.index', compact('umkms'));
    }

    public function create()
    {
        return view('umkm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'pemilik' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'no_wa' => 'required',
            'foto_produk' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('umkm', 'public');
        }

        UmkmWarga::create($data);
        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function show(UmkmWarga $umkm)
    {
        return view('umkm.show', compact('umkm'));
    }

    public function edit(UmkmWarga $umkm)
    {
        return view('umkm.edit', compact('umkm'));
    }

    public function update(Request $request, UmkmWarga $umkm)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'pemilik' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'no_wa' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('umkm', 'public');
        }
        $umkm->update($data);
        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil diupdate!');
    }

    public function destroy(UmkmWarga $umkm)
    {
        $umkm->delete();
        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil dihapus!');
    }
}