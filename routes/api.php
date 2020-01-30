<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
//Route::resource('customers', 'API\CustomerController');
Route::post('/customers', 'API\CustomerController@store');
Route::get('/getAccountBalance', 'API\AccountTransactionsController@getAccountBalance');
Route::post('/accountDeposit', 'API\AccountTransactionsController@accountDeposit');
Route::post('/accountWithdraw', 'API\AccountTransactionsController@accountWithdraw');
Route::post('/balanceTransfer', 'API\AccountTransactionsController@balanceTransfer');
Route::get('/customerAccountList', 'API\CustomerController@customerAccountList');
Route::get('/AccountTransactions', 'API\AccountTransactionsController@AccountTransactions');

Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'API\ProductController');
});
