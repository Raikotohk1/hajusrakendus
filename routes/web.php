<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WeatherController;
use Nette\Iterators\Mapper;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\RecordsController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('/weather', [WeatherController::class, 'getWeather'])->name('weather');

Route::resource('markers', MarkerController::class);
Route::delete('markers', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::resource('chirps', ChirpController::class);
Route::get('chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
Route::put('chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');

Route::get('records', [RecordsController::class, 'index'])->name('records.index');

require __DIR__.'/auth.php';
