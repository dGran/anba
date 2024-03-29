<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('team_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_division_id')
                ->nullable()
                ->constrained('seasons_divisions')
                ->onDelete('cascade');
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
        Schema::dropIfExists('seasons_teams');
    }
}
