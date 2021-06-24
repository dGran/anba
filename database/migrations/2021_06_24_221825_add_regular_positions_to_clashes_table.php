<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegularPositionsToClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_clashes', function (Blueprint $table) {
            $table->integer('regular_position_local')->nullable();
            $table->integer('regular_position_visitor')->nullable();
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
            $table->dropColumn('regular_position_local');
            $table->dropColumn('regular_position_visitor');
        });
    }
}
