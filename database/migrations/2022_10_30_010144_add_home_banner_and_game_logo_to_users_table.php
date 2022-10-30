<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeBannerAndGameLogoToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('seasons', function (Blueprint $table) {
            $table->string('home_banner')->after('current')->nullable()->default('default.jpg');
            $table->string('game_logo')->nullable()->after('home_banner')->default('default.png');
        });
    }

    public function down(): void
    {
        Schema::table('seasons', function (Blueprint $table) {
            $table->dropColumn('home_banner');
            $table->dropColumn('game_logo');
        });
    }
}
