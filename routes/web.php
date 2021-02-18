<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamController;
use App\Http\Controllers\MatchController;

use App\Http\Livewire\Admin\Dashboard;

use App\Http\Livewire\Admin\AdminLogCrud;

use App\Http\Livewire\Admin\SeasonCrud;
use App\Http\Livewire\Admin\MatchCrud;
use App\Http\Livewire\Admin\ConferenceCrud;
use App\Http\Livewire\Admin\DivisionCrud;
use App\Http\Livewire\Admin\TeamCrud;
use App\Http\Livewire\Admin\PlayerCrud;
use App\Http\Livewire\Admin\UserCrud;
use App\Http\Livewire\Admin\PostCrud;
use App\Http\Livewire\Admin\ConfigNotificationsCrud;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/prueba', function () {
    // $users = \App\Models\Match::all();
    $users = \App\Models\Match::with('localTeam')->with('visitorTeam')->with('scores')->get(['id', 'season_id', 'round_id', 'local_team_id', 'visitor_team_id', 'local_manager_id', 'visitor_manager_id', 'stadium', 'extra_times', 'created_at']);
    return view('test');
    // dd($match);
});

Route::get('/partidos', function () {
    return view('matches');
})->name('matches');
Route::get('/partidos/{match:id}', [MatchController::class, 'index'])->name('match');
Route::get('/clasificaciones', function () {
    return view('standings');
})->name('standings');
Route::get('/estadisticas', function () {
    return view('stats');
})->name('stats');
Route::get('/jugadores', function () {
    return view('players');
})->name('players');
Route::get('/equipos', function () {
    return view('teams');
})->name('teams');
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
	Route::get('temporadas', SeasonCrud::class)->name('admin.seasons');
	Route::get('temporadas/{season:slug}/partidos', MatchCrud::class)->name('admin.matches');

	Route::get('configuracion/notificaciones', ConfigNotificationsCrud::class)->name('admin.config.notifications');
});