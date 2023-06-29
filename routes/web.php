<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\esewaController;
use App\Http\Controllers\KothaController;
use App\Http\Controllers\postController;
use App\Http\Controllers\trashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Route::get('/', [KothaController::class, 'index'])->name('kotha.index');

Route::get('user/preferences',[UserController::class, 'openPreferencesForm'])->name('user.preferences.index');
Route::post('user/preferences',[UserController::class, 'preferences'])->name('user.preferences.store');

Route::post('kotha/filter', [kothaController::class, 'filter'])->name('kotha.filter');
Route::post('esewa', [esewaController::class, 'esewaPay'])->name('esewa');
Route::get('payment/success', [esewaController::class, 'paymentSuccess'])->name('esewa.success');
Route::get('payment/failure', [esewaController::class, 'paymentFailure'])->name('esewa.failure');
Route::get('kotha/{kotha}/show', [kothaController::class, 'showImages'])->name('kotha.showImages');
Route::get('trash', [trashController::class, 'index'])->name('trash');
Route::get('trash/restore/{id}', [trashController::class, 'restore'])->name('trash.restore');
Route::get('trash/delete/{id}', [trashController::class, 'delete'])->name('trash.delete');
Route::resource('user', UserController::class);
Route::resource('kotha', KothaController::class);
Route::resource('post', postController::class);

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/kotha', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin /kotha/{kotha}/preview', [AdminController::class, 'show'])->name('admin.kotha.preview');
Route::get('admin/kotha/{kotha}/approve', [AdminController::class, 'approve'])->name('admin.kotha.approve');
Route::get('admin/kotha/{kotha}/reject', [AdminController::class, 'reject'])->name('admin.kotha.reject');


