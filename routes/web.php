<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\ApartmentController as ApartmentController;
use App\Http\Controllers\Admin\MessageController as MessageController;
use App\Http\Controllers\Admin\ServiceController as ServiceController;
use App\Http\Controllers\Admin\SponsorshipController as SponsorshipController;
use App\Models\Sponsorship;
use Illuminate\Http\Request;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $gateway = new \Braintree\Gateway([
    //     'environment' => config('services.braintree.environment'),
    //     'merchantId' => config('services.braintree.merchantId'),
    //     'publicKey' => config('services.braintree.publicKey'),
    //     'privateKey' => config('services.braintree.privateKey')
    // ]);
    // $token = $gateway->ClientToken()->generate();
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);
    Route::get('{id}/messages', [MessageController::class, 'index'])->name('messages');
    Route::resource('services', ServiceController::class);
    Route::get('/sponsorships/{apartmentSlug}', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::get('/sponsorships/{apartmentSlug}/{id}', [SponsorshipController::class, 'show'])->name('sponsorships.show');
    Route::post('/sponsorships/{apartmentSlug}/{id}/payment', [SponsorshipController::class, 'processPayment'])->name('sponsorships.process_payment');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
