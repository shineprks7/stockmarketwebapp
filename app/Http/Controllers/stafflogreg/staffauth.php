<?php

namespace App\Http\Controllers\stafflogreg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class staffauth extends Controller
{
    //     public function authenticate(Request $request)
   
    public function logout(Request $request)
       {
          Auth::logout();

          $request->session()->invalidate();

          $request->session()->regenerateToken();

           return response('success');
       }
       public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $email = $request->input('email');

        $password = $request->input('password');      
        

       
        if (Auth::check()) 
        {
                            
            
            $username = Auth::user()->name;
                
             return response('success');
        }

        $userdata = User::select('*')
        ->where('email', '=', $email)
        ->where('password', '=', $password)
        ->first();

        if($userdata)
        {
            auth()->login($userdata);


        
            return response('success');
        }


         return response("fail");
                

        
        

       
    }
    public function currentuser(Request $request)
       {
          
        if (Auth::check()) {
            $username = Auth::user()->name;

            $userrole = Auth::user()->role;

            $resultarray = ['success',$username,$userrole];
    
            return response($resultarray);
        }
        $resultarray = ['guest','guest','guest'];

           return response('guest');
       }
}
