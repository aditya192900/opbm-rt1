<?php

namespace App\Http\Controllers;

use App\Models\LaporanWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanWargaController extends Controller
{
    public function index()
    {
        $laporans = LaporanWarga::with('user')->latest()->paginate(10);
        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        LaporanWarga::create($data);
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(LaporanWarga $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(LaporanWarga $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, LaporanWarga $laporan)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $laporan->update($request->all());
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diupdate!');
    }

    public function destroy(LaporanWarga $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}