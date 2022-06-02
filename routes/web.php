<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

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


Route::get('visitor', [VisitorController::class, 'index']);
Route::get('visitor/store', [VisitorController::class, 'store']);
Route::get('visitor/update', [VisitorController::class, 'update']);
Route::get('visitor/delete', [VisitorController::class, 'delete']);
