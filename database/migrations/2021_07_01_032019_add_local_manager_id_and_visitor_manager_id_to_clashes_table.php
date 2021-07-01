<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocalManagerIdAndVisitorManagerIdToClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playoffs_clashes', function (Blueprint $table) {
            $table->foreignId('local_manager_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('visitor_manager_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
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
            $table->dropColumn('local_manager_id');
            $table->dropColumn('visitor_manager_id');
        });
    }
}
