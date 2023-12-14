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
        Schema::create('record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idquestion');
            $table->foreign('idquestion')->references('id')->on('question')->onDelete('cascade');
            $table->foreignId('idanswer');
            $table->foreign('idanswer')->references('id')->on('answer')->onDelete('cascade');
            $table->string('alias', 50);
            $table->boolean('correct');
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
        Schema::dropIfExists('record');
    }
};

