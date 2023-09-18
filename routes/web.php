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
        ->group(function () {
            Route::get('/', 'index')->name('home.users');
            Route::get('/create', 'create')->name('user.create');
            Route::post('/store', 'store')->name('user.store');
            Route::delete('{id}', 'delete')->name('user.delete');
            Route::get('list', 'getListUsers')->name('getListUsers');
            Route::put('{id}', 'update')->name('update.user');
            Route::delete('{id}/permission/{permission}', 'removePermission')
                ->name('user.remove.permission');
            Route::put('{id}/permission/{permission}', 'addPermission')
                ->name('user.add.permission');
        });

    Route::middleware('permission:produtos')
        ->get('/products', function () {
            return view('frontend.product');
        });

    Route::middleware('permission:categoria')
        ->get('/category', function () {
            return view('frontend.category');
        });

    Route::middleware('permission:marcas')
        ->get('/brands', function () {
            return view('frontend.brands');
        });
});

