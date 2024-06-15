<?php

use App\Http\Controllers\BicycleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WeatherController;
use Nette\Iterators\Mapper;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\CommentController;
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


Route::get('bicycles', [BicycleController::class, 'index'])->name('bicycles.index');
Route::get('addbikes', [BicycleController::class, 'create'])->name('addbikes');
Route::post('savebike', [BicycleController::class, 'store'])->name('bicycles.store');

Route::post('addToCart/{product_id}/{quantity}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('cart', [CartController::class, 'showCart'])->name('cart');
Route::patch('/updateCartItem/{index}', [CartController::class, 'updateCartItem'])->name('updateCartItem');
Route::post('/removeFromCart/{index}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

Route::resource('markers', MarkerController::class);
Route::delete('/markers/{id}', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::resource('chirps', ChirpController::class)
->only(['index', 'store', 'edit', 'update', 'destroy', 'create'])
->middleware(['auth', 'verified']);
Route::get('chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
Route::put('chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');

Route::post('/chirps/{chirp}/comments', [CommentController::class, 'store'])->name('chirps.comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    

Route::get('records', [RecordsController::class, 'index'])->name('records.index');

require __DIR__.'/auth.php';
