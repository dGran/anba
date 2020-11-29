<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('medium_name');
            $table->string('short_name');
            // $table->enum('conference', ['eastern', 'western']);
            // $table->enum('division', ['atlantic', 'central', 'southeast', 'northwest ', 'pacific', 'southwest']);
            $table->text('img')->nullable();
            $table->string('stadium')->nullable();
            $table->string('color')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('teams');
    }
}
