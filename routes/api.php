<?php

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
Route::get('/', function () {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->set('example_key', 'example_value');
    $value = $redis->get('example_key');
    return $value;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
