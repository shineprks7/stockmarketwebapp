<?php

namespace App\Http\Controllers\ipo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\IpoLeadManager;

class IpoLeadManagerController extends Controller
{
    //
    
  public function createLeadManager(Request $request)
  {


    //basic Detail Creation
    try {

      $query = $request->input('query');

      $formname = $request->input('formname');

      $page = $request->input('page');


      $company_name = $request->input('companyname');
      $about = $request->input('about');



      if (count($query) > 1) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $ipocompany = IpoLeadManager::find($company_id);


          $ipocompany->company_name = $company_name;
         
          $ipocompany->status = 'active';

          $ipocompany->save();

          $ipocompanyid = $ipocompany->id;



          $querydata = array('companyid' => $ipocompanyid);



          $responsearray = ['success', $querydata];


          return response($responsearray);
        }
      } else {
        $ipocompany = new IpoLeadManager();

        $ipocompany->company_name = $company_name;

        $ipocompany->save();

        $ipocompanyid = $ipocompany->id;



        $querydata = array('companyid' => $ipocompanyid);



        $responsearray = ['success', $querydata];

        $createdpage = $formname . "_page_" . $page;


        session($createdpage, 'created');



        return response($responsearray);
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  
  public function LeadManagerLogoUpload(Request $request)
  {

    ini_set('max_execution_time', 120);




    try {

      $uuid = Str::uuid()->toString();

      $company_id = $request->input('companyid');



      if ($company_id) {


        if ($request->hasFile('imageicon')) {
          //  Let's do everything here



          if ($request->file('imageicon')->isValid()) {

            $validated = $request->validate([
              'imageicon' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:6000',
            ]);


            $extension = $request->imageicon->extension();

            $originalname = $request->imageicon->getClientOriginalName();


            $imagename = $uuid . "." . $extension;
            $url = Storage::url($uuid . "." . $extension);


            $request->imageicon->storeAs('/public', $url);


            $tempurl = "/storage/" . $url;


            $leadmanager = IpoLeadManager::find($company_id);

            $leadmanager->logo_url = $tempurl;

            $leadmanager->save();




            return response(['success', $tempurl]);







            //end of -has image icon if
          }


          //end of -has company id if
        }


        //end of try

      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  public function createLeadManagerAdditionalInfo(Request $request)
  {


    //basic Detail Creation
    try {

      $query = $request->input('query');

      $formname = $request->input('formname');

      $page = $request->input('page');


      $address = $request->input('address');
      $phone = $request->input('phone');
      $contact_email = $request->input('contact_email');
      $contact_person = $request->input('contact_person');
      $website = $request->input('website');

      $validity = $request->input('validity');

      

      if (count($query) > 1) {

        $company_id = $query['companyid'];


        if ($company_id) {

          $ipocompany = IpoLeadManager::find($company_id);

          if ($address) {
            $ipocompany->address = $address;
          }
          else
          {
            $ipocompany->address = null;
   
          }
          if ($phone) {
            $ipocompany->phone = $phone;
          }
          else
          {
            $ipocompany->phone = null;
   
          }
          if ($contact_email) {
            $ipocompany->contact_email = $contact_email;
          }
          else
          {
            $ipocompany->contact_email = null;
   
          }
          if ($contact_person) {
            $ipocompany->contact_person = $contact_email;
          }
          else
          {
            $ipocompany->contact_person = null;
   
          }
          if ($website) {
            $ipocompany->wesite = $website;
          }
          else
          {
            $ipocompany->website = null;
   
          }
          if ($validity) {
            $ipocompany->validity = $validity;
          }
          else
          {
            $ipocompany->validity = null;
   
          }

          
          $ipocompany->save();

      
          $querydata = array('companyid' => $company_id);



          $responsearray = ['success', $querydata];


          return response($responsearray);
        } else {
          return response(['fail', 'Company Id is Required']);
        }
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}
