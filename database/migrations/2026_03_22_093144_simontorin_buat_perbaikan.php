<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('simontorin_perbaikan', function (Blueprint $table) {
            $table->id('perbaikan_id');

            // relasi ke inventaris (versi kamu)
            $table->unsignedBigInteger('perbaikan_inventaris');

            $table->date('perbaikan_tanggal_masuk');
            $table->date('perbaikan_tanggal_selesai')->nullable();

            $table->text('perbaikan_keluhan');
            $table->text('perbaikan_tindakan')->nullable();

            $table->enum('perbaikan_status', ['Proses', 'Selesai', 'Tidak Bisa Diperbaiki'])->default('Proses');

            $table->text('perbaikan_keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simontorin_perbaikan');
    }
};