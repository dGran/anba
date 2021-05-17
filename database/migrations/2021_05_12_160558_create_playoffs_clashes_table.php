<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayoffsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_clashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('round_id')
                ->constrained('playoffs_rounds')
                ->onDelete('cascade');
            $table->foreignId('local_team_id')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->foreignId('visitor_team_id')
                ->nullable()
                ->constrained('seasons_teams')
                ->onDelete('cascade');
            $table->integer('order');
            $table->integer('destiny_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_clashes');
    }
}
