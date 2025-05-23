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
        Schema::create('jaringans', function (Blueprint $table) {
            $table->id();
            $table->string('nopemasangan')->nullable();
            $table->string('tanggal');
            $table->string('id_masterclient');
            $table->string('id_masterteknisi');
            $table->string('alamat');
            $table->string('fotohasil');
            $table->string('catatan');
            $table->string('statuspasang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaringans');
    }
};
