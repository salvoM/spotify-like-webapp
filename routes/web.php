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
use App\Http\Middleware\CheckIfBelongsToUser;
use App\User;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'CollectionController@index');
Route::resource('collection', 'CollectionController')->middleware('auth');
Route::get('collection/{collection}', 'CollectionController@show')->middleware('auth','App\Http\Middleware\CheckIfBelongsToUser');
Route::get('search', 'SearchController@show')->middleware('auth');
Route::post('track', 'TrackController@store')->middleware('auth');
Route::post('do_search', 'SearchController@do_search');
Route::delete('track/{track}/{collection}', 'TrackController@deleteTrackFromCollection');
Route::get('users/check/{username}',
    function($username){
        if(User::where('username', $username)->get()->isEmpty())    return 'not taken';
        else    return 'taken';
});
// Route::get('/get_collections', 'CollectionController@getCollections');
