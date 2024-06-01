<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\AdminLogCrud;
use App\Http\Livewire\Admin\SeasonCrud;
use App\Http\Livewire\Admin\MatchCrud;
use App\Http\Livewire\Admin\PlayoffCrud;
use App\Http\Livewire\Admin\ConferenceCrud;
use App\Http\Livewire\Admin\DivisionCrud;
use App\Http\Livewire\Admin\TeamCrud;
use App\Http\Livewire\Admin\PlayerCrud;
use App\Http\Livewire\Admin\UserCrud;
use App\Http\Livewire\Admin\PostCrud;
use App\Http\Livewire\Admin\ConfigNotificationsCrud;
use App\Http\Livewire\Admin\InjuryCrud;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/partidos', function () {
    return view('matches');
})->name('matches');
Route::get('/partidos/{match:id}', [MatchController::class, 'index'])->name('match');
Route::get('/clasificaciones', function () {
    return view('standings');
})->name('standings');

Route::prefix('estadisticas')->group(function() {
	Route::get('/', function () {
	    return view('stats.tops');
	})->name('stats');
	Route::get('/jugadores', function () {
	    return view('stats.players');
	})->name('stats.players');
	Route::get('/equipos', function () {
	    return view('stats.teams');
	})->name('stats.teams');
	Route::get('/records', function () {
	    return view('stats.records');
	})->name('stats.records');
});

Route::prefix('jugadores')->group(function() {
	Route::get('/', function () {
	    return view('players');
	})->name('players');
	Route::get('/lesionados', function () {
	    return view('injuries');
	})->name('players.injuries');
	Route::get('/{player:slug}', [PlayerController::class, 'index'])->name('player');
	Route::get('/{player:slug}/game_log', [PlayerController::class, 'gameLog'])->name('playerGameLog');
});

Route::prefix('equipos')->group(function() {
	Route::get('/', [TeamController::class, 'teams'])->name('teams');
	Route::get('/home', [TeamController::class, 'home'])->name('team.home');
	Route::get('/roster', [TeamController::class, 'roster'])->name('team.roster');
	Route::get('/schedule', [TeamController::class, 'schedule'])->name('team.schedule');
	Route::get('/leaders', [TeamController::class, 'leaders'])->name('team.leaders');
	Route::get('/team-stats', [TeamController::class, 'teamStats'])->name('team.team_stats');
	Route::get('/player-stats', [TeamController::class, 'playerStats'])->name('team.player_stats');
});

Route::get('/managers', function () {
    return view('managers');
})->name('managers');

Route::get('/politica-de-cookies', function () {
    return view('cookies-policy');
})->name('cookies');
Route::get('/politica-de-privacidad', function () {
    return view('privacity-policy');
})->name('privacity');
Route::get('/reglamento', function () {
    return view('rules');
})->name('rules');

// manager routes
Route::middleware(['auth:sanctum', 'verified', 'role:manager'])->prefix('manager')->group(function() {
	Route::get('reportes-pendientes', [ManagerController::class, 'pendingReports'])->name('manager.pending_reports');
	Route::get('partidos-pendientes', [ManagerController::class, 'pendingMatches'])->name('manager.pending_matches');
	Route::get('listo-para-jugar-switcher/{user_id}', [ManagerController::class, 'readyToPlaySwitcher'])->name('manager.ready_to_play_switcher');
});

// admin routes
Route::middleware(['auth:sanctum', 'verified', 'role:super-admin|admin', 'password.confirm'])->prefix('admin')->group(function() {
	Route::get('usuarios', UserCrud::class)->name('admin.users');

	Route::get('/', Dashboard::class)->name('admin');
	//good
	Route::get('log', AdminLogCrud::class)->name('admin.log');
	Route::get('jugadores', PlayerCrud::class)->name('admin.players');
	Route::get('equipos', TeamCrud::class)->name('admin.teams');
	Route::get('divisiones', DivisionCrud::class)->name('admin.divisions');
	Route::get('conferencias', ConferenceCrud::class)->name('admin.conferences');
	Route::get('noticias', PostCrud::class)->name('admin.posts');
	Route::get('lesiones', InjuryCrud::class)->name('admin.injuries');
	Route::get('temporadas', SeasonCrud::class)->name('admin.seasons');
	Route::get('temporadas/{season:slug}/partidos', MatchCrud::class)->name('admin.matches');
	Route::get('temporadas/{season:slug}/playoffs', PlayoffCrud::class)->name('admin.playoffs');

	Route::get('configuracion/notificaciones', ConfigNotificationsCrud::class)->name('admin.config.notifications');

	Route::get('lobby', function () {
		return view('admin/lobby');
	})->name('lobby');

});
