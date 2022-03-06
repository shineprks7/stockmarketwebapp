<?php

namespace App\Http\Controllers\sessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FormSessionManager extends Controller
{
    //

    public function CreateFormSession(Request $request)
    {
       $formname = $request->input('formname');

       $pages = $request->input('pages');

       $formname = 'ipocreatorform';

       $pages = 3;

       $page_status =[];

       if($pages)
       {
           
           for($i=0;$i<$pages;$i++)
           {
               
               $createdpage = $formname."_page_".($i+1);


               $request->session()->put($createdpage, 'initiated');



           }
       }

       $data = $request->session()->all();

       return response($data);




    }

    public function PageSessionCreation(Request $request)
    {
       $formname = $request->input('formname');

       $page = $request->input('page');

      

       $updatepages =[];

       if($page)
       {
           
              $createdpage = $formname."_page_".$page;

               
              $request->session()->put($createdpage, 'created');
         

           
       }

       $responsearr = ['success'];

       return response($responsearr);




    }
    public function GetFormSessions(Request $request)
    {

        $formname = $request->input('formname');

        $pages = $request->input('pages');
   


        $updatepages =[];
        try
        {

        if($pages)
        {
            
            for($i=0;$i<$pages;$i++)
            {
                
                $createdpage = $formname."_page_".($i+1);

                if ($request->session()->has($createdpage)) {
                    //

                    $value = $request->session()->get($createdpage);

                    if($value=="created")
                    {
                        array_push($updatepages,($i+1));
                    }



                }
 
 
 
 
 
            }
        }

        $responsearr = ['success',$updatepages];

        return response($responsearr);

      }
      catch(\Exception $e)
      {
        return $e->getMessage();

       }



    }

    public function DeleteFormSession(Request $request)
    {
       $formname = $request->input('formname');

       $pages = $request->input('pages');
       $formname ="ipocreator";

       $pages = 3;

       $page_status =[];

       if($pages)
       {
             for($i=0;$i<$pages;$i++)
             {
               $createdpage = $formname."_page_".($i+1);


               $request->session()->forget($createdpage);


           }
       }

       return response("successfully Deleted");



    }

    
    


    
}
