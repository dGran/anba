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
            $table->foreignId('player_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('minutos');
            $table->integer('puntos');
            $table->integer('rebotes');
            $table->integer('asistencias');
            $table->integer('robos');
            $table->integer('tapones');
            $table->integer('perdidas');
            $table->integer('FGM'); // tiros de campo anotados
            $table->integer('FGA'); // tiros de campo intentados
            $table->integer('3PM'); // triples anotados
            $table->integer('3PA'); // triples intentados
            $table->integer('TLM'); // tiros libres anotados
            $table->integer('TLA'); // tiros libres intentados
            $table->integer('RO'); // rebotes ofensivos
            $table->integer('FP'); // faltas personales
            $table->integer('more_less');
            $table->boolean('titular')->default(0);
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
