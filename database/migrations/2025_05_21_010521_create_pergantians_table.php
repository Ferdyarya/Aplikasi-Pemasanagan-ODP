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
        Schema::create('pergantians', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('lokasi');
            // $table->string('id_masteralat');
            // $table->string('id_masterteknisi');
            $table->string('id_masterperbaikan');
            $table->string('keterangan');
            // $table->string('kapasitas');
            $table->string('biaya');
            $table->string('fotosebelum');
            $table->string('fotosesudah');
            $table->string('waktumulai');
            $table->string('waktuselesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pergantians');
    }
};
