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
            $table->string('name')->unique();
            $table->foreignId('division_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('medium_name');
            $table->string('short_name');
            $table->text('img')->nullable();
            $table->string('stadium')->nullable();
            $table->string('color')->nullable();
            $table->boolean('active')->default(1);
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
