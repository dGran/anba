<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamController;

use App\Http\Livewire\Admin\Dashboard;

use App\Http\Livewire\Admin\AdminLogCrud;

use App\Http\Livewire\Admin\SeasonCrud;
use App\Http\Livewire\Admin\MatchCrud;
use App\Http\Livewire\Admin\ConferenceCrud;
use App\Http\Livewire\Admin\DivisionCrud;
use App\Http\Livewire\Admin\TeamCrud;
use App\Http\Livewire\Admin\PlayerCrud;
use App\Http\Livewire\Admin\UsersCrud;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/clasificaciones', function () {
    return view('standings');
})->name('standings');

Route::get('/partidos', function () {
    return view('matches');
})->name('matches');

Route::middleware(['auth:sanctum', 'verified'])->get('/equipos', function () {
    return view('teams');
})->name('teams');

Route::middleware(['auth:sanctum', 'verified'])->get('/jugadores', function () {
    return view('players');
})->name('players');


// admin routes

// Route::middleware(['auth:sanctum', 'verified'])
// 	->get('/equipos', UsersCrud::class)
// 	->name('teams');

Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->group(function() {
	Route::get('usuarios', UsersCrud::class)->name('admin.users');


	Route::get('/', Dashboard::class)->name('admin');
	//good
	Route::get('log', AdminLogCrud::class)->name('admin.log');
	Route::get('jugadores', PlayerCrud::class)->name('admin.players');
	Route::get('equipos', TeamCrud::class)->name('admin.teams');
	Route::get('divisiones', DivisionCrud::class)->name('admin.divisions');
	Route::get('conferencias', ConferenceCrud::class)->name('admin.conferences');
	Route::get('temporadas', SeasonCrud::class)->name('admin.seasons');
	Route::get('temporadas/{season:slug}/partidos', MatchCrud::class)->name('admin.matches');
});