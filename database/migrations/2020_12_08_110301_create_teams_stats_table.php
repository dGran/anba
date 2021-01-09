<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->integer('counterattack')->nullable(); // puntos al contraataque
            $table->integer('zone')->nullable(); // puntos en la zona
            $table->integer('2nd')->nullable(); // puntos en segunda oportunidad
            $table->integer('substitute')->nullable(); // puntos de los suplentes
            $table->integer('advantage')->nullable(); // ventaja maxima
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
        Schema::dropIfExists('teams_stats');
    }
}
