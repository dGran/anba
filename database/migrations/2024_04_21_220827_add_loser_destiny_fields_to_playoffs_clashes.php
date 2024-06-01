<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoserDestinyFieldsToPlayoffsClashes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_clashes', function (Blueprint $table) {
            $table->integer('loser_destiny_clash')->nullable();
            $table->boolean('loser_destiny_clash_local')->nullable();
            $table->integer('loser_destiny_playoff_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playoffs_clashes', function (Blueprint $table) {
            $table->dropColumn('loser_destiny_clash');
            $table->dropColumn('loser_destiny_clash_local');
            $table->dropColumn('loser_destiny_playoff_id');
        });
    }
}
