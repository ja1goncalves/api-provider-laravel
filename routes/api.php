<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return redirect('/');
});

Route::group(['prefix' => 'provider'], function () {

    //Authentication Route

    Route::post('oauth/token',              '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');//Login de usuario.
    Route::get('activate/{token}',          'AuthController@signupActivate');//Ativação de usuario via token em email.


    //Password Manager
    Route::group(['prefix' => 'password'], function () {

        Route::post('email',        'PasswordResetController@create');//Envia solicitação de reset se senha.
        Route::get('find/{token}',  'PasswordResetController@find');//Valida Token recebido no email.
        Route::post('reset',        'PasswordResetController@reset');//Recebe os novos dados para o reset de senha.
    });


    //Pre-Providers
    Route::post('check-token',          'PreProvidersController@checkToken');//checa token do preprovider.
    Route::post('provider-Quotation',   'ProvidersController@store2');//Cadastro de provider com quotação.
    Route::post('provider-noQuotation', 'ProvidersController@store');//Cadastro de provider sem quotação.


    //Routes Autenticadas
    Route::group(['middleware' => ['auth:api']], function () {

        //Auth
        Route::get('auth-authenticated',        'AuthController@getUserAuthenticated');//Pega o usuario logado.
        Route::delete('oauth/tokens',           'AuthController@destroyToken');//Faz logoff no sistema invalidado o token.

        //Providers
        Route::put('update',                    'ProvidersController@update');// Atualiza Provider.
        Route::get('data',                      'ProvidersController@getProviderData');// Retorno todos os dados do Provider.

        //Quotations
        Route::get('quotations',                'QuotationsController@listQuotationsByProvider');// Lista as quotações de um provider.

        //Banks
        Route::get('banks',                     'BanksController@listAll');// Retorna os bancos.

        //Fidelities
        Route::get('fidelities',                'ProvidersController@getProviderFidelities');// Retorna os fidelidades do fornecedor.

        //Segments
        Route::get('bank/segments/{bank_id}',   'SegmentsController@listByBank');// Retorna um banco.
        Route::resource('segments',             'SegmentsController');// Retorna um banco.

        //Programs
        Route::get('programs',                  'ProgramsController@index');// Retorna os Programs.
        Route::get('programs/{id}',             'ProgramsController@show');// Retorna um Program.

        //Orders
        Route::resource('orders',               'OrdersController', ['except' => ['edit', 'delete', 'index']]);// Crud de orders

        //PaymentForms
        Route::resource('payment-forms',        'PaymentFormsController', ['except' => ['edit', 'delete', 'store']]);
    });
});

