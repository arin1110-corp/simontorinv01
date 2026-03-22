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
        Schema::create('simontorin_user_role', function (Blueprint $table) {
            $table->id('user_role_id');

            $table->unsignedBigInteger('user_role_user'); // dari SADARIN

            $table->enum('user_role_nama', ['admin', 'user'])->default('user');

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
        Schema::dropIfExists('simontorin_user_role');
    }
};