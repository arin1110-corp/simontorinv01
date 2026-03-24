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
        Schema::create('simontorin_kir', function (Blueprint $table) {
            $table->id('kir_id');

            $table->unsignedBigInteger('kir_lokasi');

            $table->string('kir_kode', 50);
            $table->year('kir_tahun');
            $table->string('kir_barcode', 50)->nullable();

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
        Schema::dropIfExists('simontorin_kir');
    }
};