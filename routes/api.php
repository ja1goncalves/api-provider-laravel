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
Route::post('authentication','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->Middleware('checkEmailVerrification');//Login de usuario
Route::get('provider/activate/{token}','AuthController@signupActivate');//Ativação de usuario via token em email.


//Password Manager
Route::group([
    'prefix' => 'password'
], function () {
    Route::post('/email', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});


////Pre-Providers
Route::post('check-token',       'PreProvidersController@checkToken');
Route::post('provider-register', 'ProvidersController@store2');//Cadastro de provider com quotação
Route::post('providerRegister', 'ProvidersController@store');//Cadastro de provider sem quotação


//Routes Autenticadas
Route::group(['middleware' => ['auth:api']], function () {

    //Users
    Route::get('user-authenticated',     'AuthController@getUserAuthenticated');
    Route::get('logout', 'AuthController@logout');

    //Providers
    Route::get('provider-quotations',    'QuotationsController@listQuotationsByProvider');
    Route::put('provider-update',        'ProvidersController@update');
    Route::get('/provider',               'ProvidersController@getProviderData');

    //Banks
    Route::get('banks',                  'BanksController@listAll');
    Route::get('segments/{bank_id}',     'SegmentsController@listByBank');

    //Programs
    Route::get('programs',               'ProgramsController@index');

    //Orders
    Route::resource('orders',   'OrdersController', ['except' => ['edit', 'delete', 'index']]);
});


