<?php

use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
})->middleware(['auth:web','verified']);



Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::as('backend.')->group(function () {
        Route::resource('users', UsersController::class);
        Route::post('users/multi-delete',[UsersController::class,'MultiDelete'])->name('users.multi-delete');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
