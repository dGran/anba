<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds_clashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('round_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('order');
            $table->foreignId('local_team_id')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('visitor_team_id')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('clash_destiny_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('stadium')->nullable();
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
        Schema::dropIfExists('rounds_clashes');
    }
}
