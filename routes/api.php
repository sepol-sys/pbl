<?php

use App\Http\Controllers\AuthController;
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

Route::post('/pbl/register', [AuthController::class, 'register']);
Route::post('/pbl/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/pbl/register', [AuthController::class, 'register']);
    // Route::post('/pbl/login', [AuthController::class, 'login']);
    Route::get('/pbl/me', [AuthController::class, 'me']);
    Route::get('/pbl/logout', [AuthController::class, 'logout']);
});
