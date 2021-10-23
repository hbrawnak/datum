<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser1951To2000sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user1951_to2000s', function (Blueprint $table) {
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
        Schema::dropIfExists('user1951_to2000s');
    }
}
