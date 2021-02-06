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
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->integer('counterattack')->nullable(); // puntos al contraataque
            $table->integer('zone')->nullable(); // puntos en la zona
            $table->integer('second_oportunity')->nullable(); // puntos en segunda oportunidad
            $table->integer('substitute')->nullable(); // puntos de los suplentes
            $table->integer('advantage')->nullable(); // ventaja maxima
            $table->integer('AST')->nullable(); // asistencias
            $table->integer('DRB')->nullable(); // rebotes defensivos
            $table->integer('ORB')->nullable(); // rebotes ofensivos
            $table->integer('STL')->nullable(); // robos
            $table->integer('BLK')->nullable(); // tapones
            $table->integer('LOS')->nullable(); // pérdidas
            $table->integer('PF')->nullable(); // faltas personales
            $table->foreignId('updated_user_id')
                ->nullable()
                ->constrained('users')
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
        Schema::dropIfExists('teams_stats');
    }
}
