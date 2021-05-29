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
            $table->string('district');
<<<<<<< HEAD:UFT/database/migrations/2019_06_27_091819_create_members_table.php
=======
            $table->foreign('district')->references('name')->on('districts');
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd:UFT/database/migrations/2019_08_01_102941_create_members_table.php
            $table->string('recommender')->nullable();
            $table->date('DateOfEnroll');
            $table->string('agent');
            $table->enum('gender',['F','M']);
            $table->foreign('agent')->references('name')->on('agents');
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
