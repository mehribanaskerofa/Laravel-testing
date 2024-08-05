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
Route::get('/',function(){
    dd(2);
});
// Route::get('/', function () {
//     $redis = new Redis();
//     $redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
//     $redis->auth(env('REDIS_PASSWORD'));

//     $redis->set('example_key', 'example_value');
//     $value = $redis->get('name');
// return bcrypt('admin');
// });

Route::get('/admin/login',[AdminController::class,'loginView'])->name('admin.login-view');
Route::post('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::get('/salam/salam',function (){
    return 'salam';
})->middleware('is_admin');



Route::resource('products',\App\Http\Controllers\Front\ProductController::class)->except(['show'])->middleware('is_admin');
Route::resource('adv',\App\Http\Controllers\Admin\AdvController::class)->except(['show']);;


Route::get('product/{id}',[\App\Http\Controllers\RedisController::class,'product_view'])->name('product_view');
Route::get('datas',[\App\Http\Controllers\RedisController::class,'products_data'])->name('products_data');
Route::get('datass',[\App\Http\Controllers\RedisController::class,'products_datas'])->name('products_datas');
Route::get('/tag-filter',[\App\Http\Controllers\RedisController::class,'product_create'])->name('product_create');
Route::get('filter/{tag}',[\App\Http\Controllers\RedisController::class,'products_tag'])->name('products_tag');


Route::get('/{id}/post',[\App\Http\Controllers\RedisController::class,'post_show'])->name('post_show');
Route::get('/{id}/post',[\App\Http\Controllers\RedisController::class,'post_update'])->name('post_update');
Route::get('/{id}/feed',[\App\Http\Controllers\RedisController::class,'feed_show'])->name('feed_show');

Route::get('/register',[\App\Http\Controllers\RedisController::class,'redister_admin'])->name('redister_admin');
Route::get('/json',[\App\Http\Controllers\RedisController::class,'json_redis'])->name('redister_admin');
