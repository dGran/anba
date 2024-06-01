<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinyPlayoffIdToPlayoffsClashes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_clashes', function (Blueprint $table) {
            $table->integer('destiny_playoff_id')->nullable();
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
            $table->dropColumn('destiny_playoff_id');
        });
    }
}
