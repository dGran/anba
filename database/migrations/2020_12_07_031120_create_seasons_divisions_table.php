<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('division_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('season_conference_id')
                ->nullable()
                ->constrained('seasons_conferences')
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
        Schema::dropIfExists('seasons_divisions');
    }
}
