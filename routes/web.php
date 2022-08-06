<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VedioController;
use App\Http\Controllers\DocumentController;

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
Route::group(['middleware' => ['auth']], function () {
Route::get('/image', [ImageController::class, 'index']);
Route::post('/imageupload', [ImageController::class, 'upload']);
Route::get('/vedio', [VedioController::class, 'index']);
Route::post('/vedioupload', [VedioController::class, 'upload']);
Route::get('/document_upload', [DocumentController::class, 'index']);
Route::post('/documentupload', [DocumentController::class, 'upload']);
});
