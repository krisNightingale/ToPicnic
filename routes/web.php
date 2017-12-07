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

Route::get('/', 'PicnicController@getMyPicnicList')->middleware('auth');

Auth::routes();

Route::get('/home', function (){
    return redirect()->away('/');
});

Auth::routes();

Route::group(['prefix' => 'picnic', 'middleware' => 'auth'], function () {
    Route::get('/me', 'PicnicController@getMyPicnicList');
    Route::get('/add', 'PicnicController@addPicnic');
    Route::post('/', 'PicnicController@createPicnic');
    Route::get('/{id}', 'PicnicController@getItems');
    Route::get('/{id}/items', 'PicnicController@getItems');
    Route::get('/{id}/bills', 'PicnicController@getBills');
    Route::get('/{id}/members', 'PicnicController@getMembers');
    Route::get('/{id}/members/add', 'PicnicController@addMember');
    Route::post('/{id}/members', 'PicnicController@createMember');
    Route::get('/{id}/items/add', 'PicnicController@addItem');
    Route::post('/{id}/items', 'PicnicController@createItem');
    Route::get('/{id}/edit', 'PicnicController@editPicnic');
    Route::post('/{id}/edit', 'PicnicController@updatePicnic');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/me', 'UserController@getCurrentUser');
    Route::get('/edit', 'UserController@editCurrentUser');
    Route::post('/me', 'UserController@updateCurrentUser');
    Route::get('/bills', 'UserController@getMyBills');
    Route::get('/friends', 'UserController@getMyFriends');
    //Route::get('/invites', 'UserController@getMyInvitations');
    Route::get('/debtors', 'UserController@getMyDebtors');
    Route::get('/{id}', 'UserController@getUserById');
    Route::get('/{id}/friend', 'UserController@addToFriends');
    Route::get('/{id}/nonfriend', 'UserController@deleteFromFriends');
});

Route::group(['prefix' => 'item', 'middleware' => 'auth'], function () {
    Route::get('/{id}/subscribe', 'BillController@subscribeOnItem');
    Route::get('/{id}/unsubscribe', 'BillController@unsubscribeFromItem');
});

Route::group(['prefix' => 'bill', 'middleware' => 'auth'], function () {
    Route::get('/{id}/paid', 'BillController@setPaid');
});

Route::get('/users', 'UserController@getAll')->middleware('auth');