<?php
namespace App\Http\Controllers; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () { return view('usuarios/show'); })->name('user-show');
Route::get('/user/create', function () { return view('usuarios/store'); })->name('new-user');
Route::get('/user/{user}', [UserController::class, 'update'])->name('user.update');


