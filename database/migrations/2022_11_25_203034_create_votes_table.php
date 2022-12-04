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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('horario_id')->nullable();
            $table->unsignedBigInteger('meet_id')->nullable();
            $table->string('value')->default('1');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->foreign('meet_id')->references('id')->on('meets');

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
        Schema::dropIfExists('votes');
    }
};
