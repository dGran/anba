<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['general', 'resultados', 'records', 'rachas', 'lesiones', 'movimientos', 'destacados', 'declaraciones']);
            $table->foreignId('match_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('statement_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('transfer_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('category');
            $table->string('title');
            $table->string('description');
            $table->text('img')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
