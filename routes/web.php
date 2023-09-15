<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')
        ->get('/permissions', [PermissionsController::class, 'index']);

    Route::prefix('users')
        ->controller(UserController::class)
        ->group(function() {
            Route::get('/', 'index')->name('home');
            Route::get('list', 'getListUsers')->name('getListUsers');
        });
});

