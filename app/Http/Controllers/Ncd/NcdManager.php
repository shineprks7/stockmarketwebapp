<?php

namespace App\Http\Controllers\Ncd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



use App\Models\NcdIssue;

use App\Models\NcdIssueDetail;
use App\Models\LotsAndAllotmentInfo;
use App\Models\NcdMoreInfo;



class NcdManager extends Controller
{
  //
  public function createNcdCompany(Request $request)
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

          $ncdissue = NcdIssue::find($company_id);


          $ncdissue->company_name = $company_name;
          $ncdissue->about = $about;
          $ncdissue->status = 'active';

          $ncdissue->save();

          $ncdissueid = $ncdissue->id;



          $querydata = array('companyid' => $ncdissueid);



          $responsearray = ['success', $querydata];


          return response($responsearray);
        }
      } else {
        $ncdissue = new NcdIssue();

        $ncdissue->company_name = $company_name;
        $ncdissue->about = $about;
        $ncdissue->status = 'active';

        $ncdissue->save();

        $ncdissueid = $ncdissue->id;



        $querydata = array('companyid' => $ncdissueid);



        $responsearray = ['success', $querydata];

        $createdpage = $formname . "_page_" . $page;


        session($createdpage, 'created');



        return response($responsearray);
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function createNcdIssueDetail(Request $request)
  {


    //basic Detail Creation



    //Requered Fields

    try {
      $query = $request->input('query');

      $security_type = $request->input('security_type');
      $security_name = $request->input('security_name');

      $open_date = $request->input('open_date');
      $close_date = $request->input('close_date');
      $face_value = $request->input('face_value');
      $issue_price = $request->input('issue_price');

      $issue_size_base = $request->input('issue_size_base');

      $issue_size_shelf = $request->input('issue_size_shelf');

      $credit_rating = $request->input('credit_rating');

      //Optional Fields
      $listing_at = $request->input('listing_at');



      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $exitncddetail = NcdIssueDetail::where('ncd_issue_id', '=', $company_id)->first();

          //   $exittimetable = IpoTimeTable::where('ncd_issue_id', '=', $company_id)->first();

          if ($exitncddetail) {
            $ncddetail = NcdIssueDetail::find($exitncddetail->id);
            $ncddetail->security_type = $security_type;
            $ncddetail->security_name = $security_name;

            $ncddetail->open_date = $open_date;
            $ncddetail->close_date = $close_date;
            $ncddetail->face_value = $face_value;
            $ncddetail->issue_price = $issue_price;


            if ($listing_at) {
              $ncddetail->listing_at = $listing_at;
            }
            if ($issue_size_base) {
              $ncddetail->issue_size_base = $issue_size_base;
            }
            if ($issue_size_shelf) {
              $ncddetail->issue_size_shelf = $issue_size_shelf;
            }
            if ($credit_rating) {
              $ncddetail->credit_rating = $credit_rating;
            }



            $ncddetail->save();




            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {



            $ncddetail = new NcdIssueDetail();

            $ncddetail->ncd_issue_id = $company_id;

            $ncddetail->security_name = $security_name;

            $ncddetail->open_date = $open_date;
            $ncddetail->close_date = $close_date;
            $ncddetail->face_value = $face_value;
            $ncddetail->issue_price = $issue_price;

            if ($security_type) {
              $ncddetail->security_type = $security_type;
            }

            if ($listing_at) {
              $ncddetail->listing_at = $listing_at;
            }
            if ($issue_size_base) {
              $ncddetail->issue_size_base = $issue_size_base;
            }
            if ($issue_size_shelf) {
              $ncddetail->issue_size_shelf = $issue_size_shelf;
            }
            if ($credit_rating) {
              $ncddetail->credit_rating = $credit_rating;
            }
            $ncddetail->save();



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

  public function createNcdAllotmentData(Request $request)
  {


    //basic Detail Creation


    /*
      

    */

    //Requered Fields



    try {
      $query = $request->input('query');

      $minimum_lot = $request->input('minimum_lot');


      $maximum_lots = $request->input('maximum_lots');

      $qib_allocation_ratio = $request->input('qib_allocation_ratio');
      $nii_allocation_ratio = $request->input('nii_allocation_ratio');
      $hni_allocation_ratio = $request->input('hni_allocation_ratio');
      $rii_allocation_ratio = $request->input('rii_allocation_ratio');

      $qib_offered = $request->input('qib_offered');
      $nii_offered = $request->input('nii_offered');
      $hni_offered = $request->input('hni_offered');
      $rii_offered = $request->input('rii_offered');

      $basis_of_allotment = $request->input('basis_of_allotment');





      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existncdallotments = LotsAndAllotmentInfo::where('ncd_issue_id', '=', $company_id)->first();


          if ($existncdallotments) {
            $ncdallotment = LotsAndAllotmentInfo::find($existncdallotments->id);

            if ($minimum_lot) {
              $ncdallotment->minimum_lot = $minimum_lot;
            }
            if ($maximum_lots) {
              $ncdallotment->maximum_lots = $maximum_lots;
            }
            if ($qib_allocation_ratio) {
              $ncdallotment->qib_allocation_ratio = $qib_allocation_ratio;
            }
            if ($nii_allocation_ratio) {
              $ncdallotment->nii_allocation_ratio = $nii_allocation_ratio;
            }
            if ($hni_allocation_ratio) {
              $ncdallotment->hni_allocation_ratio = $hni_allocation_ratio;
            }
            if ($rii_allocation_ratio) {
              $ncdallotment->rii_allocation_ratio = $rii_allocation_ratio;
            }
            if ($qib_offered) {
              $ncdallotment->qib_offered = $qib_offered;
            }
            if ($nii_offered) {
              $ncdallotment->nii_offered = $nii_offered;
            }
            if ($hni_offered) {
              $ncdallotment->hni_offered = $hni_offered;
            }
            if ($rii_offered) {
              $ncdallotment->rii_offered = $rii_offered;
            }
            if ($basis_of_allotment) {
              $ncdallotment->basis_of_allotment = $basis_of_allotment;
            }


            $ncdallotment->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $ncdallotment = new LotsAndAllotmentInfo();

            $ncdallotment->ncd_issue_id = $company_id;

            if ($minimum_lot) {
              $ncdallotment->minimum_lot = $minimum_lot;
            }
            if ($maximum_lots) {
              $ncdallotment->maximum_lots = $maximum_lots;
            }
            if ($qib_allocation_ratio) {
              $ncdallotment->qib_allocation_ratio = $qib_allocation_ratio;
            }
            if ($nii_allocation_ratio) {
              $ncdallotment->nii_allocation_ratio = $nii_allocation_ratio;
            }
            if ($hni_allocation_ratio) {
              $ncdallotment->hni_allocation_ratio = $hni_allocation_ratio;
            }
            if ($rii_allocation_ratio) {
              $ncdallotment->rii_allocation_ratio = $rii_allocation_ratio;
            }
            if ($qib_offered) {
              $ncdallotment->qib_offered = $qib_offered;
            }
            if ($nii_offered) {
              $ncdallotment->nii_offered = $nii_offered;
            }
            if ($hni_offered) {
              $ncdallotment->hni_offered = $hni_offered;
            }
            if ($rii_offered) {
              $ncdallotment->rii_offered = $rii_offered;
            }
            if ($basis_of_allotment) {
              $ncdallotment->basis_of_allotment = $basis_of_allotment;
            }


            $ncdallotment->save();



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


  public function createNcdAllotmentInformation(Request $request)
  {


    //basic Detail Creation


    /*
         $table->string('allotment_status')->nullable();
            $table->text('allotment_comments')->nullable();


    */

    //Requered Fields



    try {
      $query = $request->input('query');



      $allotment_status = $request->input('allotment_status');

      $allotment_comments = $request->input('allotment_comments');




      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existncdallotments = LotsAndAllotmentInfo::where('ncd_issue_id', '=', $company_id)->first();


          if ($existncdallotments) {
            $ncdallotment = LotsAndAllotmentInfo::find($existncdallotments->id);

            if ($allotment_status) {
              $ncdallotment->allotment_status = $allotment_status;
            }
            if ($allotment_comments) {
              $ncdallotment->allotment_comments = $allotment_comments;
            }


            $ncdallotment->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $ncdallotment = new LotsAndAllotmentInfo();

            $ncdallotment->ncd_issue_id = $company_id;
            if ($allotment_status) {
              $ncdallotment->allotment_status = $allotment_status;
            }
            if ($allotment_comments) {
              $ncdallotment->allotment_comments = $allotment_comments;
            }


            $ncdallotment->save();



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



  public function NcdCompanyLogoUpload(Request $request)
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


            $existncdcompany = NcdIssue::find($company_id);

            $existncdcompany->logo_url = $tempurl;

            $existncdcompany->save();




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


  public function createNcdCompanyAdditionalInfo(Request $request)
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




      if (count($query) > 1) {

        $company_id = $query['companyid'];


        if ($company_id) {

          $ncdissue = NcdIssue::find($company_id);

          if ($address) {
            $ncdissue->address = $address;
          }
          if ($phone) {
            $ncdissue->phone = $phone;
          }
          if ($email) {
            $ncdissue->email = $email;
          }
          if ($website) {
            $ncdissue->website = $website;
          }
          $ncdissue->save();





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



  public function createNcdReview(Request $request)
  {


    //basic Detail Creation


    /*
    


    */

    //Requered Fields



    try {
      $query = $request->input('query');



      $ncd_review = $request->input('ncd_review');





      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existncdmoreinfo = NcdMoreInfo::where('ncd_issue_id', '=', $company_id)->first();


          if ($existncdmoreinfo) {
            $ncdmoreinfo = LotsAndAllotmentInfo::find($existncdmoreinfo->id);

            if ($ncd_review) {
              $ncdmoreinfo->ncd_review = $ncd_review;
            }



            $ncdmoreinfo->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $ncdmoreinfo = new NcdMoreInfo();

            $ncdmoreinfo->ncd_issue_id = $company_id;
            if ($ncd_review) {
              $ncdmoreinfo->ncd_review = $ncd_review;
            }



            $ncdmoreinfo->save();


            $ncdmoreinfo->save();



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


  public function createSubscriptionDetails(Request $request)
  {


    //basic Detail Creation


    /*
        


    */

    //Requered Fields



    try {
      $query = $request->input('query');



      $subscription_details = $request->input('subscription_details');

      $subscription_link = $request->input('subscription_link');




      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existncdmoreinfo = NcdMoreInfo::where('ncd_issue_id', '=', $company_id)->first();


          if ($existncdmoreinfo) {
            $ncdmoreinfo = LotsAndAllotmentInfo::find($existncdmoreinfo->id);

            if ($subscription_details) {
              $ncdmoreinfo->subscription_details = $subscription_details;
            }
            if ($subscription_link) {
              $ncdmoreinfo->subscription_link = $subscription_link;
            }



            $ncdmoreinfo->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $ncdmoreinfo = new NcdMoreInfo();

            $ncdmoreinfo->ncd_issue_id = $company_id;
            if ($subscription_details) {
              $ncdmoreinfo->subscription_details = $subscription_details;
            }
            if ($subscription_link) {
              $ncdmoreinfo->subscription_link = $subscription_link;
            }



            $ncdmoreinfo->save();


            $ncdmoreinfo->save();



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
}
