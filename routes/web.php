<?php

use Laravel\Scout\Searchable;
use App\Mychats;
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
if (env('APP_ENV') === 'production') {
    \URL::forceScheme('https');
}
use App\User;
Route::get('/', function () {
    return view('layouts/index');
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

Route::get('/search', [
    'as' => 'api.search',
    'uses' => 'AppSearchController@Search'
]);

Route::get('/globalChat', 'MessageController@Gchat');

Route::get('/chat/{with}', 'MessageController@chat');

Route::post('/areaMessage', 'AppSearchController@SendareaMessage');
Route::post('/sendMessage', 'MessageController@sendMessage');

Route::post('/updateLoc', function(){

    $user = Auth::user();
    User::where('id','=', $user->id)->update(
    [   'cor_Y' => request()->cor_Y,
        'cor_X' => request()->cor_X    
    ]);

    $user->searchable();

        return ['status' => 'New Chat Added!'];
    
});
Route::post('/newChat', 'MessageController@newChat');

