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
        Schema::create('simontorin_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_kodesync', 255)->unique();
            $table->string('user_nip', 255);
            $table->string('user_nik', 255);
            $table->string('user_nama', 255);
            $table->string('user_email', 255)->unique();
            $table->string('user_password', 255);
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
    }
};
