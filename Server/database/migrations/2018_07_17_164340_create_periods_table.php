<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('day', ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat']);
            $table->string('starts_at', 5);
            $table->string('ends_at', 5);
            $table->string('ramadan_starts_at', 5);
            $table->string('ramadan_ends_at', 5);

            $table->unique(['day', 'starts_at']);
            $table->unique(['day', 'ramadan_starts_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periods');
    }
}
