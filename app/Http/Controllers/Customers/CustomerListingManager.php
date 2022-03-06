<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;





use App\Models\User;

class CustomerListingManager extends Controller
{
    //
    public function allcustomerslist(Request $request)
    {
        
        $customerlist = User::where('role','=','customer')->orderBy('created_at')->get();


        return response($customerlist);



    }
}
