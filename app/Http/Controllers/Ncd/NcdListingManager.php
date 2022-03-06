<?php

namespace App\Http\Controllers\Ncd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NcdIssue;

use App\Models\NcdIssueDetail;
use App\Models\LotsAndAllotmentInfo;
use App\Models\NcdMoreInfo;

class NcdListingManager extends Controller
{
    //
    public function ncdListingByCompany(Request $request)
    {
        $query = $request->input('query');


        if (count($query) > 1) {
            if (array_key_exists('companyid', $query)) {
                $companyid = $query['companyid'];


                $ncddata = NcdIssue::where('id', '=', $companyid)->with('NcdIssueDetails')
                    ->with('LotsAndAllotmentInfos')
                    ->with('NcdMoreInfos')->first();


                return response(['success', $ncddata]);
            }
        }
    }
}
