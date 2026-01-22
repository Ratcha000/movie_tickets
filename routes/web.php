<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AdimController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\PageMovieController;
use App\Http\Controllers\PageNewsController;
use App\Http\Controllers\PagePromotionController;
use App\Http\Controllers\AMController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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

Auth::routes();

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes with middleware
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/adminHome', function () {
    return view('adminHome');
})->name('adminHome');

Route::middleware(['is_admin'])->group(function () {
    Route::get('/HomeAdmin', [AMController::class, 'index'])->name('HomeAdmin');
    Route::get('/Add_movie', [AMController::class, 'createForm']);
    Route::post('/Add_movie/insert', [AMController::class, 'insert']);
    Route::get('/Add_movie/edit/{id}', [AMController::class, 'edit']);
    Route::post('/Add_movie/updated', [AMController::class, 'updatedMovie']);
    Route::get('/HomeAdmin/delete/{id}', [AMController::class, 'delete']);
});

// Layout route
Route::get('layout', function () {
    return view('layout');
});

// Booking routes
Route::prefix('booking')->group(function () {
    Route::get('/{id}', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/save', [BookingController::class, 'store'])->name('booking.save');
});

// Payment routes
Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'showPaymentPage'])->name('payment');
    Route::post('/save', [BookingController::class, 'store'])->name('payment.save'); 
    Route::post('/submit', [PaymentController::class, 'submitPayment'])->name('payment.submit')->middleware('auth');
    Route::get('/success', [PaymentController::class, 'success'])->name('paymentsuccess'); // Route ชำระเงินเสร็จสิ้น
    Route::post('/apply-discount', [PaymentController::class, 'applyDiscount'])->name('discount.apply');
});

// Movie routes
Route::prefix('movies')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movies.update');
    Route::get('/{id}/delete', [MovieController::class, 'delete'])->name('movies.delete');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // Movie review routes
    Route::post('/{id}/reviews', [MovieController::class, 'storeReview'])->name('reviews.store');
});

// Comment routes for movie reviews
Route::post('/movies/{movieId}/comments', [CommentController::class, 'store'])->name('comments.store');

// Time routes for movie
Route::get('/stime/{id}', [PromotionController::class, 'Stime'])->name('stime');

// View routes
Route::get('/view/{id}', [AdimController::class, 'index'])->name('view');
Route::get('/view/delete/{id}', [AdimController::class, 'delete'])->name('delete');

// PageHome routes
Route::get('/', [PageHomeController::class, 'index'])->name('homes');

// PageMovie routes
Route::get('/movie', [PageMovieController::class, 'index'])->name('movie');

// PagePromotion routes
Route::prefix('promotions')->group(function () {
    Route::get('/', [PagePromotionController::class, 'index'])->name('promotions');
    Route::get('/{id}', [PagePromotionController::class, 'show'])->name('promotions.show');
    Route::get('/{id}/redeem', [PagePromotionController::class, 'redeemCode']);
    Route::get('/manage', [PagePromotionController::class, 'manage'])->name('promotions.manage');
    Route::post('/', [PagePromotionController::class, 'store'])->name('promotions.store');
    Route::get('/{id}/edit', [PagePromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/{id}', [PagePromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/{id}', [PagePromotionController::class, 'destroy'])->name('promotions.destroy');
});

// PageNews routes
Route::get('/news', [PageNewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [PageNewsController::class, 'show'])->name('news.show');
