<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('player_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->integer('MIN')->nullable(); // minutos
            $table->integer('PTS')->nullable(); // puntos
            $table->integer('REB')->nullable(); // rebotes
            $table->integer('AST')->nullable(); // asistencias
            $table->integer('STL')->nullable(); // robos
            $table->integer('BLK')->nullable(); // tapones
            $table->integer('LOS')->nullable(); // perdidas
            $table->integer('FGM')->nullable(); // tiros de campo anotados
            $table->integer('FGA')->nullable(); // tiros de campo intentados
            $table->integer('TPM')->nullable(); // triples anotados
            $table->integer('TPA')->nullable(); // triples intentados
            $table->integer('FTM')->nullable(); // tiros libres anotados
            $table->integer('FTA')->nullable(); // tiros libres intentados
            $table->integer('OR')->nullable(); // rebotes ofensivos
            $table->integer('PF')->nullable(); // faltas personales
            $table->integer('ML')->nullable(); // +/-
            $table->boolean('headline')->default(0);
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
        Schema::dropIfExists('players_stats');
    }
}
