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
        Schema::create('simontorin_inventaris_detail', function (Blueprint $table) {
            $table->id('detail_id');

            $table->unsignedBigInteger('detail_inventaris');

            $table->string('detail_nama');
            $table->text('detail_isi');
            $table->text('detail_foto')->nullable();

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
        Schema::dropIfExists('simontorin_inventaris_detail');
    }
};