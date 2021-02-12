<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->text('name', 50);
            $table->text('desc', 50);
            $table->foreignId('skill_id')->constrained();
            $table->string('img', 255);
            $table->boolean('active')->default(true);

            $table->tinyInteger('questions_no');
            $table->tinyInteger('difficulty');
            $table->smallInteger('duration_mins');

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
        Schema::dropIfExists('exams');
    }
}
