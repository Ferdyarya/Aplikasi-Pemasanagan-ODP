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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('id_masteralat');
            $table->string('id_masterteknisi');
            $table->string('tanggal');
            $table->string('kapasitas');
            $table->string('lokasi');
            $table->string('keterangan');
            $table->string('fotosebelum');
            $table->string('fotosesudah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
