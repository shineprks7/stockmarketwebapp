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

use App\Models\CashScripNameList;


class StockRecommendationCsvManager extends Controller
{
    //

    public function createcashscripnames(Request $request)
    {
        $scriplistcash = new CashScripNameList();


        $scriplistcash->scripname = "scriptname";
        $scriplistcash->scriptype = "eqcash";

        $scriplistcash->save();

        return response("Success");

    }
    
    public function csvuploadscripcashnames(Request $request)
    {

        ini_set('max_execution_time', 300);

        try{
        if ($request->hasFile('csvfile')) {
            //  Let's do everything here


        
            if ($request->file('csvfile')->isValid()) {
                 
                $originalname = $request->csvfile->getClientOriginalName();

                $extension = $request->csvfile->extension();

                $file = fopen($request->csvfile,"r");
            
                $result = fgetcsv($file,1000,",");

                $row= 1;

                $dataarray=[];
                $deleterow = CashScripNameList::where('scriptype','=','eqcash')->delete();                    


                while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    /*
                    echo "<p> $num fields in line $row: <br /></p>\n";
                    */
                    $row++;

                    $secondcolumn = $data[1];

                    

                    if($secondcolumn == "EQ")
                    {
                        array_push($dataarray,$data[0]);

                    }


                    $scriplistcash = new CashScripNameList();


                    $scriplistcash->scripname = $data[0];
                    $scriplistcash->scriptype = "eqcash";

                    $scriplistcash->save();
                    


                    /*
                    for ($c=0; $c < $num; $c++) {

                    }
                    */
                }

                return response($dataarray);

            }

            return response("The Csv file is not valid");


        }
       
       
      
     }
     catch(\Exception $e)
     {
         return $e->getMessage();
 
     }
 




    }

    public function csvdownload(Request $request)
    {

        ini_set('max_execution_time', 300);

        try{
        if ($request->hasFile('csvfile')) {
            //  Let's do everything here


        
            if ($request->file('csvfile')->isValid()) {
                 
                $originalname = $request->csvfile->getClientOriginalName();

                $extension = $request->csvfile->extension();

                $file = fopen($request->csvfile,"r");
            
                $result = fgetcsv($file,1000,",");

                $row= 1;

                $dataarray=[];
                $deleterow = CashScripNameList::where('scriptype','=','eqcash')->delete();                    


                while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    /*
                    echo "<p> $num fields in line $row: <br /></p>\n";
                    */
                    $row++;

                    $secondcolumn = $data[1];

                    

                    if($secondcolumn == "EQ")
                    {
                        array_push($dataarray,$data[0]);

                    }


                   
                    


                    /*
                    for ($c=0; $c < $num; $c++) {

                    }
                    */
                }

                return response($dataarray);

            }

            return response("The Csv file is not valid");


        }
       
       
      
     }
     catch(\Exception $e)
     {
         return $e->getMessage();
 
     }
 




    }
}
