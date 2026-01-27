<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    //
    use HasFactory;

    protected $table = 'pendaftar';

    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'jenis_pendaftaran',
    ];
        public function antrean()
    {
        return $this->hasMany(Antrean::class, 'pendaftar_id');
    }
}
