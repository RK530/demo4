<?php

use App\Http\Controllers\DrawDateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TotoSiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultApiController;
use App\Http\Controllers\Result4DController;
use App\Http\Controllers\tblGztController;
use App\Http\Controllers\tblQztController;
use App\Http\Controllers\tblWztController;
use App\Http\Controllers\tblApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', UserController::class);
Route::resource('result_api',ResultApiController::class);
Route::resource('drawdate',DrawDateController::class);
Route::resource('totoSite',TotoSiteController::class);
Route::resource('result',Result4DController::class);
Route::resource('dream',tblGztController::class);
Route::resource('qzt',tblQztController::class);
Route::resource('wzt',tblWztController::class);
Route::resource('api',tblApiController::class);
Route::get('result_post/{date}',[Result4DController::class,'getResult']);
Route::get('number/{number}',[Result4DController::class,'getNumberCount']);