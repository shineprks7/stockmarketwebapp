<?php

namespace App\Http\Controllers\Rights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Models\RightsIssue;

use App\Models\RightIssueDetail;
use App\Models\RightsAllotDetail;
use App\Models\RightMoreInfo;

class RightsManager extends Controller
{
  //
  public function createRightsIssue(Request $request)
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

          $rightissue = RightsIssue::find($company_id);


          $rightissue->company_name = $company_name;
          $rightissue->about = $about;
          $rightissue->status = 'active';

          $rightissue->save();

          $rightissueid = $rightissue->id;



          $querydata = array('companyid' => $rightissueid);



          $responsearray = ['success', $querydata];


          return response($responsearray);
        }
      } else {
        $rightissue = new RightsIssue();

        $rightissue->company_name = $company_name;
        $rightissue->about = $about;
        $rightissue->status = 'active';

        $rightissue->save();

        $rightissueid = $rightissue->id;



        $querydata = array('companyid' => $rightissueid);



        $responsearray = ['success', $querydata];

        $createdpage = $formname . "_page_" . $page;


        session($createdpage, 'created');



        return response($responsearray);
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function createRightIssueDetails(Request $request)
  {


    //basic Detail Creation
    /*
       $table->string('security_name')->nullable();
            $table->float('issue_size_shares')->nullable();
            $table->float('issue_size_amount')->nullable();
            $table->date('open_date')->nullable();

            $table->date('close_date')->nullable();

            $table->float('face_value')->nullable();

            $table->float('issue_price')->nullable();

            $table->string('listing_at')->nullable();

            $table->unsignedBigInteger('rights_issue_id');


      */



    //Requered Fields

    try {
      $query = $request->input('query');

      $security_name = $request->input('security_name');

      $open_date = $request->input('open_date');
      $close_date = $request->input('close_date');
      $face_value = $request->input('face_value');
      $issue_price = $request->input('issue_price');

      $issue_size_shares = $request->input('issue_size_shares');

      $issue_size_amount = $request->input('issue_size_amount');


      //Optional Fields
      $listing_at = $request->input('listing_at');



      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $exitrightsdetail = RightIssueDetail::where('rights_issue_id', '=', $company_id)->first();


          if ($exitrightsdetail) {
            $rightissue = RightIssueDetail::find($exitrightsdetail->id);


            if ($open_date) {
              $rightissue->open_date = $open_date;
            }
            if ($close_date) {
              $rightissue->close_date = $close_date;
            }
            if ($face_value) {
              $rightissue->face_value = $face_value;
            }
            if ($issue_price) {
              $rightissue->issue_price = $issue_price;
            }

            if ($security_name) {
              $rightissue->security_name = $security_name;
            }

            if ($listing_at) {
              $rightissue->listing_at = $listing_at;
            }

            if ($issue_size_shares) {
              $rightissue->issue_size_shares = $issue_size_shares;
            }
            if ($issue_size_amount) {
              $rightissue->issue_size_amount = $issue_size_amount;
            }



            $rightissue->save();




            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {



            $rightissue = new RightIssueDetail();

            $rightissue->rights_issue_id = $company_id;
            if ($open_date) {
              $rightissue->open_date = $open_date;
            }
            if ($close_date) {
              $rightissue->close_date = $close_date;
            }
            if ($face_value) {
              $rightissue->face_value = $face_value;
            }
            if ($issue_price) {
              $rightissue->issue_price = $issue_price;
            }

            if ($security_name) {
              $rightissue->security_name = $security_name;
            }

            if ($listing_at) {
              $rightissue->listing_at = $listing_at;
            }

            if ($issue_size_shares) {
              $rightissue->issue_size_shares = $issue_size_shares;
            }
            if ($issue_size_amount) {
              $rightissue->issue_size_amount = $issue_size_amount;
            }

            $rightissue->save();


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

  public function createRightsAllotmentData(Request $request)
  {


    //basic Detail Creation


    /*
        $table->integer('market_lot')->nullable();
            $table->integer('lots')->nullable();
            $table->float('lot_size')->nullable();
            $table->string('terms_payment')->nullable();
            $table->string('entitlement')->nullable();

            $table->date('record_date')->nullable();
            $table->date('date_of_allotment')->nullable();
            $table->date('renunciation_date')->nullable();

    */

    //Requered Fields



    try {
      $query = $request->input('query');

      $lots = $request->input('lots');


      $market_lot = $request->input('market_lot');

      $terms_payment = $request->input('terms_payment');
      $entitlement = $request->input('entitlement');
      $record_date = $request->input('record_date');
      $date_of_allotment = $request->input('date_of_allotment');

      $renunciation_date = $request->input('renunciation_date');




      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existsrightsallot = RightsAllotDetail::where('rights_issue_id', '=', $company_id)->first();


          if ($existsrightsallot) {
            $rightallot = RightsAllotDetail::find($existsrightsallot->id);

            if ($lots) {
              $rightallot->lots = $lots;
            }
            if ($market_lot) {
              $rightallot->market_lot = $market_lot;
            }
            if ($terms_payment) {
              $rightallot->terms_payment = $terms_payment;
            }
            if ($entitlement) {
              $rightallot->entitlement = $entitlement;
            }
            if ($record_date) {
              $rightallot->record_date = $record_date;
            }
            if ($date_of_allotment) {
              $rightallot->date_of_allotment = $date_of_allotment;
            }
            if ($renunciation_date) {
              $rightallot->renunciation_date = $renunciation_date;
            }

            $rightallot->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $rightallot = new RightsAllotDetail();

            $rightallot->rights_issue_id = $company_id;

            if ($lots) {
              $rightallot->lots = $lots;
            }
            if ($market_lot) {
              $rightallot->market_lot = $market_lot;
            }
            if ($terms_payment) {
              $rightallot->terms_payment = $terms_payment;
            }
            if ($entitlement) {
              $rightallot->entitlement = $entitlement;
            }
            if ($record_date) {
              $rightallot->record_date = $record_date;
            }
            if ($date_of_allotment) {
              $rightallot->date_of_allotment = $date_of_allotment;
            }
            if ($renunciation_date) {
              $rightallot->renunciation_date = $renunciation_date;
            }
            $rightallot->save();

            $rightallot->save();



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





  public function RightsCompanyLogoUpload(Request $request)
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


            $existncdcompany = RightsIssue::find($company_id);

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


  public function createRightsCompanyAdditionalInfo(Request $request)
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

          $rightissue = RightsIssue::find($company_id);

          if ($address) {
            $rightissue->address = $address;
          } else {
            $rightissue->address = null;
          }
          if ($phone) {
            $rightissue->phone = $phone;
          } else {
            $rightissue->phone = null;
          }
          if ($email) {
            $rightissue->email = $email;
          } else {
            $rightissue->email = null;
          }
          if ($website) {
            $rightissue->website = $website;
          } else {
            $rightissue->website = null;
          }
          $rightissue->save();





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



  public function createRightsReview(Request $request)
  {


    //basic Detail Creation


    /*
       $table->text('review')->nullable();
            $table->text('subscription_details')->nullable();
            $table->text('objective_of_issue')->nullable();
            $table->text('company_financials')->nullable();



    */

    //Requered Fields



    try {
      $query = $request->input('query');



      $review = $request->input('review');





      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existingrightsmore = RightMoreInfo::where('rights_issue_id', '=', $company_id)->first();


          if ($existingrightsmore) {
            $rightsmoreinfo = RightMoreInfo::find($existingrightsmore->id);

            if ($review) {
              $rightsmoreinfo->review = $review;
            }



            $rightsmoreinfo->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $rightsmoreinfo = new RightMoreInfo();

            $rightsmoreinfo->rights_issue_id = $company_id;
            if ($review) {
              $rightsmoreinfo->review = $review;
            }



            $rightsmoreinfo->save();


            $rightsmoreinfo->save();



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

  public function createRightsSubsriptionDetail(Request $request)
  {


    //basic Detail Creation


    /*
       $table->text('review')->nullable();
            $table->text('subscription_details')->nullable();
            $table->text('objective_of_issue')->nullable();
            $table->text('company_financials')->nullable();



    */

    //Requered Fields



    try {
      $query = $request->input('query');



      $subscription_details = $request->input('subscription_details');





      if ($query) {

        $company_id = $query['companyid'];

        if ($company_id) {

          $existingrightsmore = RightMoreInfo::where('rights_issue_id', '=', $company_id)->first();


          if ($existingrightsmore) {
            $rightsmoreinfo = RightMoreInfo::find($existingrightsmore->id);

            if ($subscription_details) {
              $rightsmoreinfo->subscription_details = $subscription_details;
            }



            $rightsmoreinfo->save();



            $querydata = array('companyid' => $company_id);


            $responsearray = ['success', $querydata];


            return response($responsearray);
            //end of if condition Exist check

          } else {
            $rightsmoreinfo = new RightMoreInfo();

            $rightsmoreinfo->rights_issue_id = $company_id;
            if ($subscription_details) {
              $rightsmoreinfo->review = $subscription_details;
            }



            $rightsmoreinfo->save();


            $rightsmoreinfo->save();



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
