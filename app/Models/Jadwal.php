<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // PAKAI NAMA TABEL YANG BENAR & HURUF KECIL
    protected $table = 'jadwals';

    protected $fillable = [
        'tanggal',
        'jam_buka',
        'jam_tutup',
        'kuota',
    ];

    public function antrean()
    {
        return $this->hasMany(Antrean::class, 'jadwals_id');
    }
}
