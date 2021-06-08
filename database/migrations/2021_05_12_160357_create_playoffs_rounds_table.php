<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayoffsRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playoff_id')
                ->constrained('playoffs')
                ->onDelete('cascade');
            $table->string('name');
            $table->integer('matches_to_win');
            $table->integer('matches_max');
            $table->integer('order')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds');
    }
}
