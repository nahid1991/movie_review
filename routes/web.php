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

Route::get('/', 'HomeController@landing');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/separate', function() {
        if(Auth::user()->isAdmin()) {
            return redirect('/admin');
        } else {
            return redirect('/home');
        }
    });

    Route::group(['middleware' => ['auth', 'admin']], function(){
        Route::resource('admin', AdminController::class);
    });

    Route::get('/home', 'HomeController@index')->name('home');
});
