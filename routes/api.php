<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiayaAdmin;
use App\Http\Controllers\DaftarAnggota;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Pengembalian;
use App\Http\Controllers\registersimpanan;
use App\Http\Controllers\Setoran;
use App\Models\biaya;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('image', [ImageController::class, 'imageStore']);

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::post('DaftarAnggota', [DaftarAnggota::class, 'register'])->middleware('auth:sanctum');

Route::post('registersimpanan', [registersimpanan::class, 'register']);
Route::post('BiayaAdmin', [BiayaAdmin::class, 'register']);
Route::post('setoran', [Setoran::class, 'register']);
Route::post('pengembalian', [Pengembalian::class, 'register']);

Route::get('anggota', [DaftarAnggota::class, 'me']);

Route::get('data', [AuthController::class, 'index']);



Route::get('me', [AuthController::class, 'me']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/pbl/register', [AuthController::class, 'register']);
    // Route::post('/pbl/login', [AuthController::class, 'login']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);
});
