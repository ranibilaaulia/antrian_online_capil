<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PencatatanSipilController extends Controller
{
    //
    public function index()
    {
        // Ambil antrean berdasarkan tanggal hari ini
        $antreans = Antrean::whereDate('created_at', today())
            ->whereHas('pendaftar', function ($query) {
                $query->where('jenis_pendaftaran', 'pencatatan_sipil');
            })
            ->orderBy('nomor', 'asc')
            ->get();
        return view('admin.pendaftar.pencatatan_sipil.index', compact('antreans'));
    }

    // Konfirmasi antrean
    public function konfirmasi($id)
    {
        $antrean = Antrean::findOrFail($id);
        $antrean->status = 'selesai';
        $antrean->save();

        return redirect()->route('pencatatan_sipil.index')->with('success', 'Antrean berhasil dikonfirmasi.');
    }

    // Detail antrean
    public function show($id)
    {
        $Pendaftar = Pendaftar::findOrFail($id);

        return view('admin.pendaftar.dukcapil.show', compact('Pendaftar'));
    }

    // Panggil antrean (misal buat update status "dipanggil")
    public function call($id)
    {
        $antrean = Antrean::findOrFail($id);
        $antrean->status = 'dipanggil';
        $antrean->save();

        return redirect()->route('pencatatan_sipil.index')->with('success', 'Antrean berhasil dipanggil.');
    }
}
