<?php
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('users', [UsersController::class, 'index']);
Route::post('users', [UsersController::class, 'store'])->name('user-submit.form');
Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [UsersController::class, 'delete'])->name('users.delete');
