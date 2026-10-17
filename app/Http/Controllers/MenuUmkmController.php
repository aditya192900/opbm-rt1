<?php

namespace App\Http\Controllers;

use App\Models\MenuUmkm;
use App\Models\UmkmWarga;
use Illuminate\Http\Request;

class MenuUmkmController extends Controller
{
    public function index(UmkmWarga $umkm)
    {
        $menus = $umkm->menus()->latest()->paginate(20);
        return view('menu.index', compact('umkm', 'menus'));
    }

    public function create(UmkmWarga $umkm)
    {
        return view('menu.create', compact('umkm'));
    }

    public function store(Request $request, UmkmWarga $umkm)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['umkm_warga_id'] = $umkm->id;
        $data['is_available'] = $request->has('is_available') ? true : false;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('menu', 'public');
        }

        MenuUmkm::create($data);
        return redirect()->route('umkm.menu.index', $umkm)->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(UmkmWarga $umkm, MenuUmkm $menu)
    {
        return view('menu.edit', compact('umkm', 'menu'));
    }

    public function update(Request $request, UmkmWarga $umkm, MenuUmkm $menu)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available') ? true : false;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $menu->update($data);
        return redirect()->route('umkm.menu.index', $umkm)->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy(UmkmWarga $umkm, MenuUmkm $menu)
    {
        $menu->delete();
        return redirect()->route('umkm.menu.index', $umkm)->with('success', 'Menu berhasil dihapus!');
    }

    public function show(UmkmWarga $umkm, MenuUmkm $menu)
    {
        return redirect()->route('umkm.menu.index', $umkm);
    }
}