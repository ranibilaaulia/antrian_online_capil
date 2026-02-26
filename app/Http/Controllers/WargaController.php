<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Models\Pendaftar;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    //
    public function index()
    {
        $pendaftarId = session('pendaftar_id');
        return view('warga.index', compact('pendaftarId'));
    }
    public function register()
    {
    $jadwals = Jadwal::whereDate('tanggal', '>=', now()->toDateString())
        ->whereRaw('
            (SELECT COUNT(*)
             FROM antrean
             WHERE antrean.jadwals_id = jadwals.id) < jadwals.kuota
        ')
        ->orderBy('tanggal', 'asc')
        ->get();

        $errorMessage = null;

        if ($jadwals->isEmpty()) {
            $errorMessage = 'Belum ada jadwal yang tersedia.';
        }

        return view('warga.register', compact('jadwals', 'errorMessage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pendaftar,nik',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_pendaftaran' => 'required|in:dukcapil,pencatatan_sipil',
        ]);
        $validated['nama'] = strtoupper($validated['nama']);
        $pendaftar = Pendaftar::create($validated);

        session(['pendaftar_id' => $pendaftar->id]);
        session(['jenis_pendaftaran' => $pendaftar->jenis_pendaftaran]);
        session(['jadwals_id' => $request->jadwals_id]);

        return redirect()->route('warga.index')
            ->with('success', 'Pendaftar berhasil ditambahkan.');
    }

public function cetak(Request $request)
{
    $pendaftarId = session('pendaftar_id');
    $jenis_pendaftaran = session('jenis_pendaftaran');
    $jadwals_id = session('jadwals_id');

    // 🔒 Pastikan warga sudah registrasi
    if (!$pendaftarId) {
        return redirect()->route('register')
            ->with('error', 'Adnda Telah Mengambil Nomor Antrean Silakan daftar terlebih dahulu.');

    }

    // Tentukan prefix berdasarkan jenis pendaftaran
    $prefix = match ($jenis_pendaftaran) {
        'dukcapil' => 'A',
        'pencatatan_sipil' => 'B',
        default => 'A'
    };

    // Ambil jadwal berdasarkan session
    $jadwal = Jadwal::find($jadwals_id);
    if (!$jadwal) {
        return redirect()->route('register')
            ->with('error', 'Jadwal tidak ditemukan.');
    }

    // ✅ Cek kuota antrean untuk jadwal ini
    $totalAntrean = Antrean::where('jadwals_id', $jadwal->id)->count();
    if ($totalAntrean >= $jadwal->kuota) {
        return redirect()->route('register')
            ->with('error', 'Kuota antrean untuk jadwal ini sudah penuh.');
    }

    // ✅ Ambil nomor terakhir untuk jadwal & prefix ini
    $last = Antrean::where('jadwals_id', $jadwal->id)
        ->where('nomor', 'like', $prefix . '%')
        ->orderByDesc('id')
        ->first();

    // Tentukan nomor baru
    $newNumber = $last ? ((int) substr($last->nomor, 1) + 1) : 1;

    // Format nomor (contoh: A001, B002, dst)
    $nomor = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);



    // ✅ Simpan ke database
    $antrean = Antrean::create([
        'nomor'         => $nomor,
        'jam'           => now()->format('H:i'),
        'jadwals_id'     => $jadwal->id,
        'pendaftar_id'  => $pendaftarId,
    ]);
      session()->forget(['pendaftar_id', 'jenis_pendaftaran', 'jadwals_id']);

    return view('warga.show', compact('antrean', 'jadwal'));
}

}
