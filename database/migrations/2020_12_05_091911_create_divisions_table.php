<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('conference_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('divisions');
    }
}
