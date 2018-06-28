<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_records', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('Date');
            $table->string('Device',50);
            $table->double('temp', 8, 2); 
            $table->double('hum', 8, 2); 
            $table->double('light', 8, 2); 
            $table->double('dark', 8, 2); 
            $table->double('sound', 8, 2); 
            $table->double('air_quality', 8, 2); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_records');
    }
}
