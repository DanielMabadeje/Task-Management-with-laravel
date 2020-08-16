<?php

use Illuminate\Support\Facades\Schema;
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
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('project_id');
            $table->string('task_name');
            $table->string('priority');
            $table->timestamps();
        });
        Schema::table('tasks', function ($table) {
            $table->engine = 'InnoDB';
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
