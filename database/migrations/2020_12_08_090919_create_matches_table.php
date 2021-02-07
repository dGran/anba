<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('round_id')
                ->nullable()
                ->constrained('rounds')
                ->onDelete('cascade');
            $table->foreignId('local_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('local_manager_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('visitor_team_id')
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('visitor_manager_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('stadium')->nullable();
            $table->integer('extra_times')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
