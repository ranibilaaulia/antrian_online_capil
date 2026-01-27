<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'jam_buka',
        'jam_tutup',
        'kuota',
    ];
    public function antrean()
{
    return $this->hasMany(Antrean::class, 'jadwal_id');
}
}
