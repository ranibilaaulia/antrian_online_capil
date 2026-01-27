<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
           $table->id();
            $table->date('tanggal')->nullable(false);   // wajib isi
            $table->time('jam_buka')->nullable(false);  // wajib isi
            $table->time('jam_tutup')->nullable(false); // wajib isi
            $table->integer('kuota')->nullable(false);  // wajib isi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
