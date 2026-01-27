<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal', 'asc')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_buka' => 'required',
            'jam_tutup' => 'required|after:jam_buka',
            'kuota' => 'required|integer|min:1',
        ]);

        Jadwal::create([
            'tanggal' => $request->tanggal,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan.');
    }
}
