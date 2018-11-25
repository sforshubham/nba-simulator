<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('first_team');
            $table->integer('score_first_team')->default(0);
            $table->integer('second_team');
            $table->integer('score_second_team')->default(0);
            $table->integer('minutes_passed')->default(0);
            $table->enum('status', [0, 1, 2, 3])->default(0)->comment('0 = not started, 1 = ongoing, 2 = completed, 3 = cancelled');
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
        Schema::dropIfExists('matches');
    }
}
