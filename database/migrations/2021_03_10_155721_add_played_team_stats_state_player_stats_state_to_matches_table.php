<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlayedTeamStatsStatePlayerStatsStateToMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->boolean('played')->default(0);
            $table->enum('teamStats_state', ['success', 'warning', 'error'])->nullable();
            $table->enum('playerStats_state', ['success', 'warning', 'error'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('played');
            $table->dropColumn('teamStats_state');
            $table->dropColumn('playerStats_state');
        });
    }
}
