<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('seasons_scores_headers_id')
                ->constrained('seasons_scores_headers')
                ->onDelete('cascade');
            $table->integer('local_score')->nullable();
            $table->integer('visitor_score')->nullable();
            $table->integer('order')->default(1);
            $table->foreignId('updated_user_id')
                ->nullable()
                ->constrained('users')
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
        Schema::dropIfExists('scores');
    }
}
