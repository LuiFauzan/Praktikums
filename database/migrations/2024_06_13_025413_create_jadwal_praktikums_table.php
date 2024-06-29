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
        Schema::create('jadwal_praktikums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('praktikum_id')->constrained();
            $table->foreignId('dosen_id')->constrained();
            $table->string('hari');
            $table->string('kelas');
            $table->string('ruangan');
            $table->string('tahunajaran');
            $table->time('jammulai');
            $table->time('jamberes');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_praktikums');
    }
};
