<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;



use App\Models\User;



use App\Models\StockRecommendation;


class StockRecommendationManager extends Controller
{

    public function createGenericRecommendation(Request $request)
    {
        
    

    $scrip = $request->input('scrip');
    $action = $request->input('action');
    $entryprice = $request->input('entryprice');
    $target1 = $request->input('target1');
    $target2 = $request->input('target2');
    $stoploss = $request->input('stoploss');
    $status = $request->input('status');



    $lotsize = $request->input('lotsize');
    $tabname = $request->input('tabname');
    $subtabname = $request->input('subtabname');
    $recommendationdate = $request->input('recommendationdate');

    
    $strtotime = strtotime($recommendationdate);

    $date = date("Y-m-d",$strtotime);
    


    try{

    $recommendation = new StockRecommendation();

       if(!$scrip)
       {
           return response("Scrip Field is required");
       }
       if(!$action)
       {
           return response("Action Field is required");
       }

       if(!$entryprice)
       {
           return response("Entry Price Field is required");
       }
       if(!$target1)
       {
           return response("Target 1  Field is required");
       }
       if(!$target2)
       {
           return response("Target 2  Field is required");
       }
       if(!$stoploss)
       {
           return response("Stop Loss  Field is required");
       }

       $recommendation->action = $action;


       $recommendation->scrip = $scrip;
       $recommendation->entryprice = $entryprice;
       $recommendation->target1 = $target1;
       $recommendation->target2 = $target2;

       $recommendation->stoploss = $stoploss;
       
       $recommendation->status = $status;

       if($lotsize)
       {
        $recommendation->lotsize = $lotsize;
      
       }
       if($tabname)
       {
       $recommendation->tabname = $tabname;
       }
       if($subtabname)
       {
       $recommendation->subtabname = $subtabname;
       }
       
       if($recommendationdate)
       {
          
           $recommendation->recommendationdate = $date;
           
       }
       
       $recommendation->save();


       $resultarray = ['success'];
       return response($resultarray);

    }
    catch(\Exception $e)
    {
        return $e->getMessage();

    }
    
    



    }

    
    public function updateValues(Request $request)
    {
        
    
        $id = $request->input('id');

       $scrip = $request->input('scrip');
       $entryprice = $request->input('entryprice');
       $target1 = $request->input('target1');
       $target2 = $request->input('target2');
       $stoploss = $request->input('stoploss');
       $lotsize = $request->input('lotsize');



  
    

       try{

      $recommendation = StockRecommendation::find($id);

       if($scrip)
       {
            $recommendation->scrip = $scrip;
       }
     

       if($entryprice)
       {
          $recommendation->entryprice = $entryprice;
       }
       if($target1)
       {
        $recommendation->target1 = $target1;
       }
       if($target2)
       {
           $recommendation->target2 = $target2;
       }
       if($stoploss)
       {
        $recommendation->stoploss = $stoploss;
       }

          

       if($lotsize)
       {
        $recommendation->lotsize = $lotsize;
      
       }
       
       $recommendation->save();
       $resultarray = ['success'];
       return response($resultarray);

    }
    catch(\Exception $e)
    {
        return $e->getMessage();

    }


       
    
    



    }

    public function updateTabs(Request $request)
    {
        
    
        $id = $request->input('id');

       $tabname = $request->input('tabname');
       $subtabname = $request->input('subtabname');
        
    

       try{

      $recommendation = StockRecommendation::find($id);

       if($tabname)
       {
            $recommendation->tabname = $tabname;
       }
     

       if($subtabname)
       {
          $recommendation->subtabname = $subtabname;
       }
     
       
       $recommendation->save();
       $resultarray = ['success'];
       return response($resultarray);

    }
    catch(\Exception $e)
    {
        return $e->getMessage();

    }

    



    }
    //
    public function updateStatus(Request $request)
    {
        
    

    $id = $request->input('id');
    $status = $request->input('status');
    try
    {

        if($status && $id)
        {
        $recommendation = StockRecommendation::find($id);

        $recommendation->status = $status;
        $recommendation->save();

        }

        $resultarray = ['success'];

        return response($resultarray);

    }

    catch(\Exception $e)
    {
        return $e->getMessage();

    }



    }

    public function updateAction(Request $request)
    {
        
    

    $id = $request->input('id');
    $action = $request->input('action');
    try
    {

        if($action && $id)
        {
        $recommendation = StockRecommendation::find($id);

        $recommendation->action = $action;
        $recommendation->save();

        }

        $resultarray = ['success'];

        return response($resultarray);

    }

    catch(\Exception $e)
    {
        return $e->getMessage();

    }



    }

    

    public function updateRecommendationDate(Request $request)
    {
        
    

    $id = $request->input('id');
    $recommendationdate = $request->input('recommendationdate');

    
    $strtotime = strtotime($recommendationdate);

    $date = date("Y-m-d",$strtotime);

    try
    {

        if($date && $id)
        {
        $recommendation = StockRecommendation::find($id);

        $recommendation->recommendationdate = $date;
        $recommendation->save();

        }

        $resultarray = ['success'];

        return response($resultarray);

    }

    catch(\Exception $e)
    {
        return $e->getMessage();

    }



    }

    


}
