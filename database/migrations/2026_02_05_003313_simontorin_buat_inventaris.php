<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('simontorin_inventaris', function (Blueprint $table) {
            $table->increments('inventaris_id');
            $table->string('inventaris_kode', 50)->unique();
            $table->string('inventaris_kode_registerbarang', 50);
            $table->string('inventaris_nomor_register', 50);
            $table->string('inventaris_nama', 150);
            $table->string('inventaris_merk', 100);
            $table->string('inventaris_model', 100);
            $table->string('inventaris_jenis', 150);
            $table->string('inventaris_tahun_perolehan', 4);
            $table->string('inventaris_barcode', 100)->unique();
            $table->string('inventaris_asalusul', 150);
            $table->text('inventaris_keterangan');
            $table->string('inventaris_kondisi', 50);
            $table->string('inventaris_status', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};