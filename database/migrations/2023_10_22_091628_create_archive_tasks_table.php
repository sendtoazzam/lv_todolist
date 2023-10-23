<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('tags')->nullable();
            $table->enum('priority',['Urgent', 'High', 'Normal', 'Low'])->default('Low')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->boolean("completed")->nullable();
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
        Schema::dropIfExists('archive_tasks');
    }
}
