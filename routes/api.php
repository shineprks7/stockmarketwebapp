<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Stocks\StockRecommendationManager;

use App\Http\Controllers\Stocks\StockRecommendationListManager;

use App\Http\Controllers\Stocks\StockRecommendationCsvManager;




use App\Http\Controllers\Customers\CustomerListingManager;

use App\Http\Controllers\Rights\RightsManager;

use App\Http\Controllers\Rights\RightsListingManager;

use App\Http\Controllers\Ncd\NcdManager;

use App\Http\Controllers\Ncd\NcdListingManager;

use App\Http\Controllers\ipo\IpoManager;

use App\Http\Controllers\ipo\IpoLisingManager;

use App\Http\Controllers\ipo\IpoLeadManagerController;




use App\Http\Controllers\sessions\FormSessionManager;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {




    Route::post('/createrecommendation', [StockRecommendationManager::class, 'createGenericRecommendation']);

    Route::get('/updaterecommendation', [StockRecommendationManager::class, 'updateGenericRecommendation']);

    Route::post('/updatestatus', [StockRecommendationManager::class, 'updateStatus']);

    Route::post('/updaterecommendationaction', [StockRecommendationManager::class, 'updateAction']);

    Route::post('/updaterecommendationvalues', [StockRecommendationManager::class, 'updateValues']);

    Route::post('/updaterecommendationtabs', [StockRecommendationManager::class, 'updateTabs']);
    Route::post('/updaterecommendationdate', [StockRecommendationManager::class, 'updateRecommendationDate']);
});

Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {

    Route::get('/getallrecommendations', [StockRecommendationListManager::class, 'allRecommendations']);

    Route::get('/getshorttimerecommendations', [StockRecommendationListManager::class, 'shorttimeRecommendations']);

    Route::get('/getintradayallrecommendations', [StockRecommendationListManager::class, 'intradayAllRecommendations']);
    Route::get('/getfuturesallrecommendations', [StockRecommendationListManager::class, 'futuresAllRecommendations']);

    Route::post('/getrecommendationlistgeneral', [StockRecommendationListManager::class, 'genericRecommendations']);
});

Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {




    Route::post('/csvuploadscripcashnames', [StockRecommendationCsvManager::class, 'csvuploadscripcashnames']);

    Route::get('/listCashScriptNames', [StockRecommendationCsvManager::class, 'listCashScriptNames']);

    Route::post('/pullcashscriptnames', [StockRecommendationCsvManager::class, 'listCashScriptNames']);

});


Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {




    Route::get('/allcustomerslist', [CustomerListingManager::class, 'allcustomerslist']);
});

Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {




    Route::post('/createIpoCompany', [IpoManager::class, 'createIpoCompany']);
    Route::post('/createIpoDetail', [IpoManager::class, 'createIpoDetail']);
    Route::post('/createIpoLotsandSchedule', [IpoManager::class, 'createIpoLotsandSchedule']);
    Route::post('/ipocompanylogoupload', [IpoManager::class, 'IpoCompanyLogoUpload']);

    Route::post('/createIpoCompanyAdditionalInfo', [IpoManager::class, 'createIpoCompanyAdditionalInfo']);




    //Listing
    Route::post('/ipoListingByCompany', [IpoLisingManager::class, 'ipoListingByCompany']);

    Route::post('/ipoListingAll', [IpoLisingManager::class, 'ipoListingAllArray']);

    Route::post('/getleadmanagerbyid', [IpoLisingManager::class, 'leadManagerListById']);


    Route::get('/testlistipos', [IpoLisingManager::class, 'testlistipos']);


    Route::post('/listallleadmanagers', [IpoLisingManager::class, 'listAllLeadManagers']);

        

    
});
Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {

    Route::post('/createipoleadmanager', [IpoLeadManagerController::class, 'createLeadManager']);

    Route::post('/createipoleadmanagerinfo', [IpoLeadManagerController::class, 'createLeadManagerAdditionalInfo']);

    Route::post('/ipoleadmanagerlogoupload', [IpoLeadManagerController::class, 'LeadManagerLogoUpload']);



    
});


Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {




    Route::post('/createNcdCompany', [NcdManager::class, 'createNcdCompany']);
    Route::post('/createNcdDetails', [NcdManager::class, 'createNcdIssueDetail']);

    Route::post('/createNcdAllotmentData', [NcdManager::class, 'createNcdAllotmentData']);

    Route::post('/createNcdAllotmentInformation', [NcdManager::class, 'createNcdAllotmentInformation']);

    Route::post('/ncdcompanylogoupload', [NcdManager::class, 'NcdCompanyLogoUpload']);

    Route::post('/createNcdCompanyAdditionalInfo', [NcdManager::class, 'createNcdCompanyAdditionalInfo']);


    Route::post('/createNcdReview', [NcdManager::class, 'createNcdReview']);
    Route::post('/createNcdSubscriptionDetail', [NcdManager::class, 'createSubscriptionDetails']);

    Route::post('/ncdListingByCompany', [NcdListingManager::class, 'ncdListingByCompany']);
});

Route::group(['prefix' => '', ['middleware' => ['XSS']], 'namespace' => ''], function () {

    Route::post('/createRightsCompany', [RightsManager::class, 'createRightsIssue']);
    Route::post('/createRightsDetails', [RightsManager::class, 'createRightIssueDetails']);

    Route::post('/createRightsAllotmentData', [RightsManager::class, 'createRightsAllotmentData']);


    Route::post('/rightscompanylogoupload', [RightsManager::class, 'RightsCompanyLogoUpload']);

    Route::post('/createRightsCompanyAdditionalInfo', [RightsManager::class, 'createRightsCompanyAdditionalInfo']);


    Route::post('/createRightsReview', [RightsManager::class, 'createRightsReview']);

    Route::post('/rightsListingByCompany', [RightsListingManager::class, 'rightsListingByCompany']);
});
