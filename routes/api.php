<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/register', 'Api\Auth\LoginController@register');
Route::post('/forgot', 'Api\Auth\ForgotController@forgot' );
Route::post('/reset', 'Api\Auth\ForgotController@reset');
Route::apiResources([
    'users' => 'Api\User\UserController',
    'corporativos' => 'Api\CorporateController',
    'empresas_corporativos' => 'Api\CorporateCompanyController',
    'contactos_corporativos' => 'Api\CorporateContactController',
    'contratos_corporativos' => 'Api\CorporateContractController',
    'documentos' => 'Api\DocumentController',
    'documentos_corporativos' => 'Api\CorporateDocumentController'
]);
