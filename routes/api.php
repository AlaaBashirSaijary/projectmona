<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ContactController;


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
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/password/email', [PasswordResetController::class, 'sendResetLink']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('/home-page-images', [HomePageImageController::class, 'index']);
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::get('/users/admins', [UserController::class, 'getAdmins']);
Route::middleware(['auth:api', 'role:admin'])->group(function () {

    Route::get('/home-page-images/{id}', [HomePageImageController::class, 'show']);
    Route::post('/home-page-images', [HomePageImageController::class, 'store']);
    Route::put('/home-page-images/{id}', [HomePageImageController::class, 'update']);
    Route::delete('/home-page-images/{id}', [HomePageImageController::class, 'destroy']);
});
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/users/{id}/toggle-role', [UserController::class, 'toggleRole']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});
