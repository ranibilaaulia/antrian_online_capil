<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    use HasFactory;

    protected $table = 'antrean';

    protected $fillable = [
        'nomor',
        'jam',
        'jadwals_id',
        'pendaftar_id',
    ];
        public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }
        public function jadwals()
    {
        return $this->belongsTo(Jadwal::class, 'jadwals_id');
    }

}
