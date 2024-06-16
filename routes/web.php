<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BicycleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WeatherController;
use Nette\Iterators\Mapper;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\RecordsController;

use App\Http\Controllers\StripePaymentController;
use App\Models\Blog;

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

Route::middleware('auth')->resource('posts.comments', CommentController::class);

Route::resource('blog', BlogController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('comments', CommentController::class)
    ->only(['store', 'destroy'])
    ->middleware(['auth', 'verified']);


Route::get('bicycles', [BicycleController::class, 'index'])->name('bicycles.index');
Route::get('addbikes', [BicycleController::class, 'create'])->name('addbikes');
Route::post('savebike', [BicycleController::class, 'store'])->name('bicycles.store');

Route::get('/cart', [BicycleController::class, 'cart'])->name('cart');
Route::get('cart', [BicycleController::class, 'showCartTable'])->name('cart');
Route::get('add-to-cart/{id}', [BicycleController::class, 'addToCart'])->name('addToCart');
Route::delete('remove-from-cart', [BicycleController::class, 'removeCartItem'])->name('removeFromCart');
Route::get('clear-cart', [BicycleController::class, 'clearCart'])->name('clearCart');
Route::patch('/update-cart', [BicycleController::class, 'updateCart'])->name('updateCart');

Route::get('/', [StripePaymentController::class, 'stripe'])->name('stripe.index');
Route::get('stripe/checkout', [StripePaymentController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('stripe/checkout/success', [StripePaymentController::class, 'stripeCheckoutSuccess'])->name('stripe.checkout.success');

Route::resource('markers', MarkerController::class);
Route::delete('/markers/{id}', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::apiResource('bicycles/api', ApiController::class);

    

Route::get('records', [RecordsController::class, 'index'])->name('records.index');

require __DIR__.'/auth.php';
