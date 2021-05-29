<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name');
            $table->string('district')->references('name')->on('districts');
            $table->string('recommender')->nullable();
            $table->date('DateOfEnroll');
            $table->enum('gender',['F','M']);
            $table->string('agent')->references('name')->on('agents');
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('members');
    }
}
