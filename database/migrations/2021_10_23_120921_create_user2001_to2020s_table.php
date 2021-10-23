<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser2001To2020sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user2001_to2020s', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 100);
            $table->dateTime('birthday');
            $table->string('phone', 20);
            $table->ipAddress('ip');
            $table->string('country', 50);
            $table->year('year')->index();
            $table->year('month')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user2001_to2020s');
    }
}
