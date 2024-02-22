<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Cache;
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
    $redis = new Redis();
    $redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
    $redis->auth(env('REDIS_PASSWORD'));

    $redis->set('example_key', 'example_value');
    $value = $redis->get('name');
return bcrypt('admin');
});

Route::get('/admin/login',[AdminController::class,'loginView'])->name('admin.login-view');
Route::post('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::get('/salam/salam',function (){
    return 'salam';
})->middleware('is_admin');



Route::resource('products',\App\Http\Controllers\Front\ProductController::class)->except(['show'])->middleware('is_admin');
Route::resource('adv',\App\Http\Controllers\Admin\AdvController::class)->except(['show']);;
