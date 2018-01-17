<?php

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

Route::get('/', 'MovieController@landing');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/separate', function() {
        if(Auth::user()->isAdmin()) {
            return redirect('/admin');
        } else {
            return redirect('/movies');
        }
    });

    Route::group(['middleware' => ['auth', 'admin']], function(){
        Route::resource('admin', AdminController::class);
    });

    Route::resource('movies', MovieController::class);
    Route::get('/movies/{id}/ratings', 'MovieController@ratings');
});
