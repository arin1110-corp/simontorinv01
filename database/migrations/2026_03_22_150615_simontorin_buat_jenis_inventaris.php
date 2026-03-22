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
        Schema::create('simontorin_jenis_inventaris', function (Blueprint $table) {
            $table->id('jenis_inventaris_id');
            $table->string('jenis_inventaris_nama');
            $table->string('jenis_inventaris_status');
            $table->string('jenis_inventaris_kode');
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
        Schema::dropIfExists('simontorin_jenis_inventaris');
    }
};