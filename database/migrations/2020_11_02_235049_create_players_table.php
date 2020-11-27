<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('team_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->text('img')->nullable();
            $table->enum('position', ['pg', 'sg', 'sf', 'pf', 'c'])->nullable();
            $table->decimal('height', 8, 1)->nullable();;
            $table->integer('weight')->nullable();;
            $table->string('college')->nullable();;
            $table->date('birthdate')->nullable();;
            $table->string('nation_name')->nullable();;
            $table->string('draft_year')->nullable();;
            $table->integer('average')->nullable();
            $table->boolean('retired')->default(false);
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
        Schema::dropIfExists('players');
    }
}
