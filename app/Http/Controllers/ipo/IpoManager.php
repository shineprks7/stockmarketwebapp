<?php

namespace App\Http\Controllers\ipo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



use App\Models\IpoCompany;

use App\Models\IpoDetail;
use App\Models\IpoLotInformation;
use App\Models\IpoTimeTable;

use App\Models\IpoCompanyLeadManager;





class IpoManager extends Controller
{

  public function createIpoCompany(Request $request)
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

          $ipocompany = IpoCompany::find($company_id);


          $ipocompany->company_name = $company_name;
          $ipocompany->about = $about;
          $ipocompany->status = 'active';

          $ipocompany->save();

          $ipocompanyid = $ipocompany->id;



          $querydata = array('companyid' => $ipocompanyid);



          $responsearray = ['success', $querydata];


          return response($responsearray);
        }
      } else {
        $ipocompany = new IpoCompany();

        $ipocompany->company_name = $company_name;
        $ipocompany->about = $about;
        $ipocompany->status = 'active';

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

  public function createIpoDetail(Request $request)
  {


    //basic Detail Creation


    /*
    required=['issue_type','open_date','close_date','face_value','issue_price']
    optional = ['issue_price_max','listing_at','offer_for_sale','qib_shares','retail_shares','nii_shares'];
  
  */

    //Requered Fields

    try {
      $query = $request->input('query');

      $issue_type = $request->input('issue_type');
      $open_date = $request->input('open_date');
      $close_date = $request->input('close_date');
      $face_value = $request->input('face_value');
      $issue_price = $request->input('issue_price');

      //Optional Fields
      $listing_at = $request->input('listing_at');
      $offer_for_sale = $request->input('offer_for_sale');
      $qib_shares = $request->input('qib_shares');
      $retail_shares = $request->input('retail_shares');
      $nii_shares = $request->input('nii_shares');


      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $exitipodetail = IpoDetail::where('ipo_company_id', '=', $company_id)->first();

          $exittimetable = IpoTimeTable::where('ipo_company_id', '=', $company_id)->first();

          if ($exitipodetail) {
            $ipodetail = IpoDetail::find($exitipodetail->id);
            $ipodetail->issue_type = $issue_type;
            $ipodetail->open_date = $open_date;
            $ipodetail->close_date = $close_date;
            $ipodetail->face_value = $face_value;
            $ipodetail->issue_price = $issue_price;


            if ($listing_at) {
              $ipodetail->listing_at = $listing_at;
            }

            if ($offer_for_sale) {
              $ipodetail->offer_for_sale = $offer_for_sale;
            }
            if ($qib_shares) {
              $ipodetail->qib_shares = $qib_shares;
            }
            if ($retail_shares) {
              $ipodetail->retail_shares = $retail_shares;
            }
            if ($nii_shares) {
              $ipodetail->nii_shares = $nii_shares;
            }



            $ipodetail->save();

            if ($exittimetable) {
              $ipotimetabe = IpoTimeTable::find($exittimetable->id);
              $ipotimetabe->close_date = $close_date;
              $ipotimetabe->open_date = $open_date;
              $ipotimetabe->status = 'active';

              $ipotimetabe->save();
            }


            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {



            $ipodetail = new IpoDetail();
            $ipodetail->issue_type = $issue_type;
            $ipodetail->open_date = $open_date;
            $ipodetail->close_date = $close_date;
            $ipodetail->face_value = $face_value;
            $ipodetail->issue_price = $issue_price;
            $ipodetail->ipo_company_id = $company_id;

            if ($listing_at) {
              $ipodetail->listing_at = $listing_at;
            }


            if ($offer_for_sale) {
              $ipodetail->offer_for_sale = $offer_for_sale;
            }
            if ($qib_shares) {
              $ipodetail->qib_shares = $qib_shares;
            }
            if ($retail_shares) {
              $ipodetail->retail_shares = $retail_shares;
            }
            if ($nii_shares) {
              $ipodetail->nii_shares = $nii_shares;
            }



            $ipodetail->save();

            if ($exittimetable) {
              $ipotimetabe = IpoTimeTable::find($exittimetable->id);
              $ipotimetabe->close_date = $close_date;
              $ipotimetabe->open_date = $open_date;
              $ipotimetabe->status = 'active';

              $ipotimetabe->save();
            } else {
              $ipotimetabe = new IpoTimeTable();
              $ipotimetabe->close_date = $close_date;
              $ipotimetabe->open_date = $open_date;
              $ipotimetabe->status = 'active';
              $ipotimetabe->ipo_company_id = $company_id;



              $ipotimetabe->save();
            }


            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);



            //end of else condition exist check
          }
          //end of if condition Company id

        }


        //end of if conditions query

      } else {

        return response('fail', 'Company Id is missing');
      }




      //end of try

    } catch (\Exception $e) {
      return $e->getMessage();
    }


    //end of function
  }

  public function createIpoLotsandSchedule(Request $request)
  {


    //basic Detail Creation


    /*
    required=['issue_type','open_date','close_date','face_value','issue_price']
    optional = ['issue_price_max','listing_at','offer_for_sale','qib_shares','retail_shares','nii_shares'];
  
  */

    //Requered Fields



    try {
      $query = $request->input('query');

      $lots = $request->input('lots');


      $min_lot = $request->input('min_lot');
      $max_lot = $request->input('max_lot');
      $min_shares = $request->input('min_shares');
      $max_shares = $request->input('max_shares');
      $min_cut_off = $request->input('min_cut_off');
      $max_cut_off = $request->input('max_cut_off');


      $allotment_date = $request->input('allotment_date');
      $refund_initiation = $request->input('refund_initiation');
      $shares_to_demat = $request->input('shares_to_demat');
      $listing_date = $request->input('listing_date');



      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existipolotinfo = IpoLotInformation::where('ipo_company_id', '=', $company_id)->first();

          $exittimetable = IpoTimeTable::where('ipo_company_id', '=', $company_id)->first();

          if ($existipolotinfo) {
            $ipolotinfo = IpoLotInformation::find($existipolotinfo->id);
            $ipolotinfo->lots = $lots;
            $ipolotinfo->status = 'active';

            if ($min_lot) {
              $ipolotinfo->min_lot = $min_lot;
            }
            if ($max_lot) {
              $ipolotinfo->max_lot = $max_lot;
            }
            if ($min_cut_off) {
              $ipolotinfo->min_cut_off = $min_cut_off;
            }
            if ($max_cut_off) {
              $ipolotinfo->max_cut_off = $max_cut_off;
            }
            if ($min_shares) {
              $ipolotinfo->min_shares = $min_shares;
            }
            if ($max_shares) {
              $ipolotinfo->max_shares = $max_shares;
            }


            $ipolotinfo->save();

            if ($exittimetable) {
              $ipotimetabe = IpoTimeTable::find($exittimetable->id);
              if ($allotment_date) {
                $ipotimetabe->allotment_date = $allotment_date;
              }
              if ($refund_initiation) {
                $ipotimetabe->refund_initiation = $refund_initiation;
              }
              if ($shares_to_demat) {
                $ipotimetabe->shares_to_demat = $shares_to_demat;
              }
              if ($listing_date) {
                $ipotimetabe->listing_date = $listing_date;
              }

              $ipotimetabe->save();
            }

            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $ipolotinfo = new IpoLotInformation();
            $ipolotinfo->lots = $lots;
            $ipolotinfo->status = 'active';
            $ipolotinfo->ipo_company_id = $company_id;


            if ($min_lot) {
              $ipolotinfo->min_lot = $min_lot;
            }
            if ($max_lot) {
              $ipolotinfo->max_lot = $max_lot;
            }
            if ($min_cut_off) {
              $ipolotinfo->min_cut_off = $min_cut_off;
            }
            if ($max_cut_off) {
              $ipolotinfo->max_cut_off = $max_cut_off;
            }
            if ($min_shares) {
              $ipolotinfo->min_shares = $min_shares;
            }
            if ($max_shares) {
              $ipolotinfo->max_shares = $max_shares;
            }


            $ipolotinfo->save();

            if ($exittimetable) {
              $ipotimetabe = IpoTimeTable::find($exittimetable->id);
              if ($allotment_date) {
                $ipotimetabe->allotment_date = $allotment_date;
              }
              if ($refund_initiation) {
                $ipotimetabe->refund_initiation = $refund_initiation;
              }
              if ($shares_to_demat) {
                $ipotimetabe->shares_to_demat = $shares_to_demat;
              }
              if ($listing_date) {
                $ipotimetabe->listing_date = $listing_date;
              }

              $ipotimetabe->save();
            }

            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);




            //end of else condition exist check
          }
          //end of if condition Company id

        }


        //end of if conditions query

      } else {

        return response('fail', 'Company Id is missing');
      }




      //end of try

    } catch (\Exception $e) {
      return $e->getMessage();
    }


    //end of function
  }


  public function IpoCompanyLogoUpload(Request $request)
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


            $existipocompany = IpoCompany::find($company_id);

            $existipocompany->logo_url = $tempurl;

            $existipocompany->save();




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


  public function createIpoCompanyAdditionalInfo(Request $request)
  {


    //basic Detail Creation
    try {

      $query = $request->input('query');

      $formname = $request->input('formname');

      $page = $request->input('page');


      $address = $request->input('address');
      $phone = $request->input('phone');
      $email = $request->input('email');
      $website = $request->input('website');

      $leadmanagerid = $request->input('leadmanagerid');



      if (count($query) > 1) {

        $company_id = $query['companyid'];


        if ($company_id) {

          $ipocompany = IpoCompany::find($company_id);

          if ($address) {
            $ipocompany->address = $address;
          }
          if ($phone) {
            $ipocompany->phone = $phone;
          }
          if ($email) {
            $ipocompany->email = $email;
          }
          if ($website) {
            $ipocompany->website = $website;
          }
          $ipocompany->save();

          if($leadmanagerid)
          {
           

          $existipoleadmanager = IpoCompanyLeadManager::where('ipo_company_id', '=', $ipocompany->id)->first();


          if($existipoleadmanager)
          {
            $ipoleadmanager = IpoCompanyLeadManager::find($existipoleadmanager->id);

            $ipoleadmanager->ipo_lead_manager_id = $leadmanagerid;

            $ipoleadmanager->save();

          }
          else
          {
            $ipoleadmanager = new IpoCompanyLeadManager();
            $ipoleadmanager->ipo_company_id = $ipocompany->id;

            $ipoleadmanager->ipo_lead_manager_id = $leadmanagerid;
            $ipoleadmanager->save();


          }
        }






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
