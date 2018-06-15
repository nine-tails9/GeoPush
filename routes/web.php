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
use App\User;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/chat', 'MessageController@index');

Route::get('/fetch', 'MessageController@fetch');

Route::get('/findUser', function(){
    $data = User::all()->where('id', '!=', Auth::user()->id);
    return $data;
});


Route::get('/activeChats', function(){
    $user = Auth::user();
    $data = $user->mychats()->get();
    return $data;
});

Route::get('/chat/{with}', 'MessageController@chat');
Route::post('/sendMessage', 'MessageController@sendMessage');


Route::post('/newChat', 'MessageController@newChat');

