<?php

namespace App\Http\Controllers\Rights;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RightsIssue;

use App\Models\RightIssueDetail;
use App\Models\RightsAllotDetail;
use App\Models\RightMoreInfo;

class RightsListingManager extends Controller
{
    //
    public function rightsListingByCompany(Request $request)
    {
        $query = $request->input('query');


        if (count($query) > 1) {
            if (array_key_exists('companyid', $query)) {
                $companyid = $query['companyid'];


                $ncddata = RightsIssue::where('id', '=', $companyid)->with('RightIssueDetails')
                    ->with('RightsAllotDetails')
                    ->with('RightMoreInfos')->first();


                return response(['success', $ncddata]);
            }
        }
    }
}
