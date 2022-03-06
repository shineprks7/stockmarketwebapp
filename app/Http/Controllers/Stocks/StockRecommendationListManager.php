<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;



use App\Models\StockRecommendation;


class StockRecommendationListManager extends Controller
{
    //
    public function genericRecommendations(Request $request)
    {

    $tabname = $request->input('tabname');
    $subtablist = $request->input('subtablist');


    $allsubtabs = [];


    try{

    if($subtablist)
    {
        $i = -1;
        foreach($subtablist as $index)
        {
            $i++;
            $subtabname = $index['aname'];

            array_push($allsubtabs, $subtabname);

            
        }

       
    }
    
    if($tabname=='intraday' || $tabname=='futuresandoptions' )
     {
     $recommendations = StockRecommendation::orderBy('recommendationdate')
                        ->where('tabname','=',$tabname)
                        ->whereIn('subtabname',$allsubtabs)->get();

     }
     else
     {
        
        $recommendations = StockRecommendation::orderBy('recommendationdate')
                           ->where('tabname','=',$tabname)->get();

     }

    
    


    $resultarray = ["success",$recommendations];

    return response($resultarray);

     }
     catch(\Exception $e)
    {
        return $e->getMessage();

    }






    }
    public function allRecommendations(Request $request)
    {
        
        $recommendations = StockRecommendation::orderBy('recommendationdate')->get();


        return response($recommendations);



    }
    public function shorttimeRecommendations(Request $request)
    {
        $recommendations = StockRecommendation::orderBy('recommendationdate')->where('tabname','=','shorttime')->get();


        return response($recommendations);



    }
    public function intradayAllRecommendations(Request $request)
    {
        $recommendations = StockRecommendation::orderBy('recommendationdate')->where('tabname','=','intraday')->get();


        return response($recommendations);



    }
    public function futuresAllRecommendations(Request $request)
    {
        $recommendations = StockRecommendation::orderBy('recommendationdate')->where('tabname','=','futuresandoptions')->get();


        return response($recommendations);



    }
}
