<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('team_1')->nullable();
            $table->text('team_2')->nullable();
            $table->text('team_3')->nullable();
            $table->text('team_4')->nullable();
            $table->integer('max_row')->default(0);
            $table->integer('sum')->default(0);
            $table->json('leave_early')->nullable();
            $table->json('come_late')->nullable();
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
        Schema::dropIfExists('histories');
    }
}
