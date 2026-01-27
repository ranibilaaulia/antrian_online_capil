<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                        // Nama lengkap
            $table->string('nik')->unique();               // NIK
            $table->string('no_hp');                       // Nomor HP
            $table->text('alamat');                        // Alamat lengkap
            $table->enum('jenis_pendaftaran', ['dukcapil', 'pencatatan_sipil']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};

