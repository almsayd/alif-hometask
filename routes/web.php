<?php

use App\Models\User;
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
    $user = User::query()->first(); //тут мы берем первого юзера в нащей таблице
    Cache::put('key',$user , ttl: 60); // тут кешируем
    $user= Cache::get('key' , 'default'); // достаем расшкешируем
    return $user;

    //в каком типе мы передаем данные в таком и получаем . В данном случае мы передали модель и получили модельку
//    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
