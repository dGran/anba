<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injuries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->integer('MIN')->nullable(); // minutos
            $table->integer('PTS')->nullable(); // puntos
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
        Schema::dropIfExists('injuries');
    }
}
