<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->dateTime('meet_date');
            $table->dateTime('meet_start');
            $table->integer('votes')->default(0);
            $table->string('day')->nullable();
            $table->string('month')->nullable();
            $table->unsignedBigInteger('meet_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('meet_id')->references('id')->on('meets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('horarios');
    }
};
