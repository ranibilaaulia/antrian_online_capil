<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrean', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('jam');
            $table->unsignedBigInteger('jadwals_id');
            $table->unsignedBigInteger('pendaftar_id');
            $table->foreign('jadwals_id')->references('id')->on('jadwals')->onDelete('cascade');
            $table->foreign('pendaftar_id')->references('id')->on('pendaftar')->onDelete('cascade');
            $table->enum('status', ['belum', 'selesai'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrean');
    }
};
