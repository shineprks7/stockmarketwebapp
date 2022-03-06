<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sessions\FormSessionManager;
use App\Http\Controllers\stafflogreg\staffauth;

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


Route::view('/dashboard', 'dalaldashboard');

Route::group(['prefix'=>'', ['middleware' => ['verifytokenkey']], 'namespace'=>'Api'], function(){




    Route::get('/CreateFormSession', [FormSessionManager::class,'CreateFormSession']);

    Route::post('/GetFormSessions', [FormSessionManager::class,'GetFormSessions']);

    Route::get('/DeleteFormSession', [FormSessionManager::class,'DeleteFormSession']);

    
    

    });

    Route::group(['prefix'=>'', ['middleware' => ['verifytokenkey']], 'namespace'=>'Api'], function(){

        Route::post('/loginstaff', [staffauth::class,'authenticate']);
        Route::get('/getcurrentuserstaff', [staffauth::class,'currentuser']);
        Route::get('/logoutstaff', [staffauth::class,'logout']);


    });
     
