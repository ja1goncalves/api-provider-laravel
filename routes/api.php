<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return redirect('/');
});
//Authentication Route
Route::post('authentication','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

//Route::post('password/email',   'UsersController@forgotPassword');
//Route::post('password/reset',   'UsersController@confirmPasswordReset');
//Route::post('confirm-register', 'UsersController@confirmSignUp');

////Pre-Providers
Route::post('check-token',       'PreProvidersController@checkToken');
Route::post('provider-register', 'ProvidersController@store');

Route::group(['middleware' => ['api']], function () {

    //Users
//    Route::get('user-authenticated',     'UsersController@getUserAuthenticated');

    //Providers
//    Route::get('provider-quotations',    'QuotationsController@listQuotationsByProvider');
//    Route::put('provider-update',        'ProvidersController@update');
//    Route::get('/provider',               'ProvidersController@getProviderData');

    //Banks
    Route::get('banks',                  'BanksController@listAll');
    Route::get('segments/{bank_id}',     'SegmentsController@listByBank');

    //Programs
    Route::get('programs',               'ProgramsController@index');

    //Orders
//    Route::resource('orders',   'OrdersController', ['except' => ['edit', 'delete', 'index']]);
});
