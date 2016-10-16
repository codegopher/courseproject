<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contactemail');
            $table->string('contactnumber');
            $table->text('tasktext');
            $table->string('taskfile');
            $table->boolean('isactive');
            $table->text('solutiontext');
            $table->string('solutionfile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::Drop('tasks');
    }
}
