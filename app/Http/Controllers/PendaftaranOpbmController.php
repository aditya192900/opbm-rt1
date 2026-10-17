<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranOpbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranOpbmController extends Controller
{
    public function index()
    {
        $pendaftarans = PendaftaranOpbm::latest()->paginate(15);
        $totalPending = PendaftaranOpbm::where('status', 'pending')->count();
        return view('pendaftaran.index', compact('pendaftarans', 'totalPending'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kepala_keluarga' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'zona' => 'required|string',
        ]);

        PendaftaranOpbm::create([
            'user_id' => Auth::id(),
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'nik' => $request->nik ?? null,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'zona' => $request->zona,
            'status' => 'pending',
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan!');
    }

    public function show(PendaftaranOpbm $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(PendaftaranOpbm $pendaftaran)
    {
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, PendaftaranOpbm $pendaftaran)
    {
        $request->validate([
            'nama_kepala_keluarga' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'zona' => 'required|string',
            'status' => 'required|in:pending,aktif,nonaktif',
        ]);

        $pendaftaran->update($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil dikonfirmasi!');
    }

    public function destroy(PendaftaranOpbm $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil dihapus!');
    }
}