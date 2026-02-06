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
            $table->string('inventaris_nama', 150);
            $table->string('inventaris_jenis', 150);
            $table->date('inventaris_tanggal');
            $table->string('inventaris_barcode', 100)->unique();
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