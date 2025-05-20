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
        Schema::create('pemasangans', function (Blueprint $table) {
            $table->id();
            $table->string('nopemasangan')->nullable();
            $table->string('id_masteralat');
            $table->string('id_masterclient');
            $table->string('id_masterteknisi');
            $table->string('lokasi');
            $table->string('kapasitas');
            $table->string('odcterhubung');
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasangans');
    }
};
