<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_working_day');
            $table->integer('number_of_sub_per_day');
            $table->integer('total_subject');
            $table->integer('total_hours_for_week');
            $table->text('html')->nullable();
            $table->text('subject_name')->nullable();
            $table->text('subject_hour')->nullable();
            
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
        Schema::dropIfExists('timetable');
    }
}
