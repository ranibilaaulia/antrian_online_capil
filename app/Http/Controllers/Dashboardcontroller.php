<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $antrean = Antrean::whereDate('created_at', today())->orderBy('nomor', 'asc')
            ->get();

        $antreans = Antrean::whereDate('created_at', today())
            ->where('status', 'selesai')
            ->orderBy('nomor', 'asc')
            ->get();
        return view('admin.index', [
            'menu' => 'dashboard',
            'title' => 'Dashboard',
            'totalAntrian' => $antrean->count(),
            'antrianSelesai' => $antreans->count(),
            'antrianBerjalan' => $antrean->where('status', 'belum')->count(),
        ]);
    }
}
