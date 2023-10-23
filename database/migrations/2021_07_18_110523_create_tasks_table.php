<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('task_id')->length(10);
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('tags')->nullable();
            $table->enum('priority',['Urgent', 'High', 'Normal', 'Low'])->default('Low');
            $table->timestamp('due_date')->nullable();
            $table->boolean("completed")->default(false);
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->string("created_from")->nullable();
            $table->string("updated_from")->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
