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
        Schema::create('simontorin_kir_detail', function (Blueprint $table) {
            $table->id('kir_detail_id');

            $table->unsignedBigInteger('kir_detail_kir'); // dari simontorin_kir

            $table->unsignedBigInteger('kir_detail_inventaris'); // dari simontorin_inventaris

            $table->integer('kir_detail_jumlah')->default(1);

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
        Schema::dropIfExists('simontorin_kir_detail');
    }
};