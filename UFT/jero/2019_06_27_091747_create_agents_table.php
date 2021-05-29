<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name')->index();
            $table->string('district');
<<<<<<< HEAD:UFT/database/migrations/2019_06_27_091747_create_agents_table.php
            $table->string('role')->default('Agent');
            $table->unsignedDecimal('salary',12)->default(0);
=======
            $table->foreign('district')->references('code')->on('districts');
            $table->string('role')->default('Agent');
            $table->unsignedDecimal('salary',12,2)->default(0);
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd:UFT/jero/2019_06_27_091747_create_agents_table.php
            $table->string('signature');
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
        Schema::dropIfExists('agents');
    }
}
