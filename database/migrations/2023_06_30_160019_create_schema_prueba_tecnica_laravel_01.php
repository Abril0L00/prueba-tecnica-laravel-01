<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemaPruebaTecnicaLaravel01 extends Migration
{
    const USERS = 'users';
    const STATUS = 'status';
    const STEPS = 'steps';
    const TASKS = 'tasks';
    const TODOLISTS = 'todolists';
    const TASK_USER = 'task_user';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createTableUsers();
        $this->createTableStatus();
        $this->createTableSteps();
        $this->createTableTasks();
        $this->createTableTaskUser();
        $this->createTableTodolists();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            TODOLISTS,
            TASK_USER,
            TASKS,
            STEPS,
            STATUS,
            USERS
        ];

        foreach($tables as $table){
            Schema::dropIfExists($table);
        }
        
    }

    public function createTableUsers(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->foreignId('todolist_id')->constrained();
        });
    }

    public function createTableStatus(){
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    public function createTableSteps(){
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignId('task_id')->constrained();
            $table->foreignId('status_id')->constrained();
        });
    }

    public function createTableTaskUser(){
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    public function createTableTasks(){
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->foreignId('todolist_id')->constrained();
            $table->foreignId('status_id')->constrained();
        });
    }

    public function createTableTodolists(){
        Schema::create('todolists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('status_id')->constrained();
        });
    }
}
