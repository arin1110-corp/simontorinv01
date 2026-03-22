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
        Schema::create('simontorin_inventaris', function (Blueprint $table) {
            $table->id('inventaris_id');
            $table->string('inventaris_kode')->unique();
            $table->string('inventaris_barcode')->unique()->nullable();
            $table->string('inventaris_nama');
            $table->string('inventaris_merk')->nullable();
            $table->string('inventaris_model')->nullable();
            $table->string('inventaris_jenis')->nullable();
            $table->year('inventaris_tahun_perolehan')->nullable();
            $table->string('inventaris_asalusul')->nullable();
            $table->text('inventaris_keterangan')->nullable();
            $table->enum('inventaris_kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->enum('inventaris_status', ['Tersedia', 'Dipakai', 'Dipinjam', 'Rusak', 'Dihapus', 'Perbaikan'])->default('Tersedia');
            $table->text('inventaris_alasan_dihapus')->nullable();
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
        Schema::dropIfExists('simontorin_inventaris');
    }
};