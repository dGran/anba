<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['free', 'trade', 'dismiss']);
            $table->foreignId('player_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_team_from')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('season_team_to')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->decimal('price')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
