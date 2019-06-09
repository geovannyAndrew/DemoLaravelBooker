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

Route::group(['middleware' => ['web','auth']], function(){
    Route::get('grills/images/{name}', [
        'as'         => 'grills.show_image',
        'uses'       => 'GrillController@showImage'
   ]);
    Route::get('grills/{id}', [
        'as'         => 'grills.show',
        'uses'       => 'GrillController@show'
    ]);
   
});

Route::group(['prefix'=>'renter','middleware' => ['web','auth']], function(){
    Route::resource('grills', 'GrillController',
        ['as' => 'renter']
    )->except([
        'update', 'destroy'
    ]);
    
    Route::resource('bookings', 'BookingController',
        ['as' => 'renter']
    )->only([
        'show', 'index'
    ]);
});

Route::group(['prefix'=>'user','middleware' => ['web','auth']], function(){
    Route::get('grills_near',
        ['as' => 'user.grills_near', 'uses'=>'GrillController@indexNear']
    );
    Route::get('bookings',
        ['as' => 'user.bookings', 'uses'=>'BookingController@index']
    );
    Route::post('grills/{id}/book', [
        'as'         => 'user.grills.book',
        'uses'       => 'GrillController@book'
    ]);
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
