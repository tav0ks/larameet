<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->dateTime('meet_date');
            $table->text('agenda');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meets');
    }
};
