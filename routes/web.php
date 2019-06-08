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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'renter','middleware' => ['web','auth']], function(){
    Route::resource('grills', 'GrillController')->except([
        'update', 'destroy'
    ]);
    Route::get('grills/images/{name}', [
        'as'         => 'grills.show_image',
        'uses'       => 'GrillController@showImage'
   ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
