<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hostip/{host}', [Api\HostIPController::class, 'show']);
Route::get('/ssldata/{host}', [Api\SSLDataController::class, 'show']);
Route::get('/dns/{domain}', [Api\DNSController::class, 'show']);
