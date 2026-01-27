<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    //
public function index(Request $request)
{
    $antrean = $request->input('antrean');
    $bulan   = $request->input('bulan');

    $query = DB::table('antrean')
        ->join('pendaftar', 'antrean.pendaftar_id', '=', 'pendaftar.id')
        ->select(
            'antrean.id',
            'antrean.nomor',
            'antrean.status',
            'pendaftar.nama',
            'pendaftar.jenis_pendaftaran',
            DB::raw("DATE_FORMAT(antrean.created_at, '%Y-%m-%d') as periode")
        );

    if (!empty($antrean)) {
        $query->where('pendaftar.jenis_pendaftaran', $antrean);
    }
    if (!empty($bulan)) {
        try {
            $tanggal = Carbon::createFromFormat('Y-m', $bulan);
            $query->whereMonth('antrean.created_at', $tanggal->month)
                  ->whereYear('antrean.created_at', $tanggal->year);
        } catch (\Exception $e) {
        }
    }

    $laporan = $query->orderBy('antrean.created_at', 'asc')->get();

    return view('admin.laporan.index', compact('laporan'));
}

}
