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
        Schema::create('simontorin_booking_rapat', function (Blueprint $table) {
            $table->id('booking_id');

            // Lokasi ruang rapat
            $table->unsignedBigInteger('booking_lokasi'); // dari simontorin_lokasi

            // User pemesan
            $table->unsignedBigInteger('booking_user'); // dari SADARIN

            $table->string('booking_kegiatan'); // misal: "Rapat Koordinasi"

            $table->date('booking_tanggal');
            $table->time('booking_jam_mulai');
            $table->time('booking_jam_selesai');

            $table->enum('booking_status', ['Booked', 'Batal'])->default('Booked');

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
        Schema::dropIfExists('simontorin_booking_rapat');
    }
};