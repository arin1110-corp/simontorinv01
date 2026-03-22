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
        Schema::create('simontorin_peminjaman', function (Blueprint $table) {
            $table->id('peminjaman_id');

            $table->unsignedBigInteger('peminjaman_inventaris');

            $table->unsignedBigInteger('peminjaman_user'); // dari SADARIN

            $table->date('peminjaman_tanggal');
            $table->date('peminjaman_tanggal_kembali')->nullable();

            $table->enum('peminjaman_status', ['Dipinjam', 'Dikembalikan'])->default('Dipinjam');

            $table->text('peminjaman_keterangan')->nullable();

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
        //
        Schema::dropIfExists('simontorin_peminjaman');
    }
};