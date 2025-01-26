<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageImageController;
use App\Http\Controllers\AuthController;

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
/*Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login'])->name('login');*/
Route::get('/', function () {
    return view('welcome');
});
/*Route::get('/home-page-images', [HomePageImageController::class, 'index']);
Route::get('/home-page-images/{id}', [HomePageImageController::class, 'show']);
Route::post('/home-page-images', [HomePageImageController::class, 'store']);
Route::put('/home-page-images/{id}', [HomePageImageController::class, 'update']);
Route::delete('/home-page-images/{id}', [HomePageImageController::class, 'destroy']);*/

