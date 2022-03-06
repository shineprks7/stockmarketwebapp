<?php

namespace App\Http\Controllers\ipo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


use App\Models\IpoCompany;

use App\Models\IpoDetail;
use App\Models\IpoLotInformation;
use App\Models\IpoTimeTable;

use Carbon\Carbon;



use App\Models\StockRecommendation;

class IpoLisingManager extends Controller
{

    public function ipoListingByCompany(Request $request)
    {
        $query = $request->input('query');


        if (count($query) > 1) {
            if (array_key_exists('companyid', $query)) {
                $companyid = $query['companyid'];


                $ipodata = IpoCompany::where('id', '=', $companyid)->with('IpoDetails')
                    ->with('IpoLotInformations')
                    ->with('IpoTimeTables')->first();


                return response(['success', $ipodata]);
            }
        }
    }
    public function ipoListingAllArray(Request $request)
    {


        $currentyear =  Carbon::now()->format('Y');

        $currenttime =  Carbon::now();

        $nextyear = $currentyear + 1;


        $start_currentyear = Carbon::create($currentyear, 1, 1);

        $end_currenttyear = Carbon::create($currentyear, 12, 31);
        $start_nextyear = Carbon::create($nextyear, 1, 1);

        $end_nextyear = Carbon::create($nextyear, 12, 31);

        $ipotime = $request->input('ipotime');

        try {


            if ($ipotime == "upcomingipos") {

                $ipodata = IpoCompany::whereHas('IpoDetails', function ($query)  use ($currenttime) {
                    $query->where('open_date', '>', $currenttime)
                        ->orWhere('open_date', '=', 'null');
                })->with('IpoDetails')
                    ->with('IpoLotInformations')
                    ->with('IpoTimeTables')->get();


                return response(['success', $ipodata]);
            } else if ($ipotime == "pastipos") {
                $ipodata = IpoCompany::whereHas('IpoDetails', function ($query) use ($currenttime) {
                    $query->where('open_date', '<', $currenttime);
                })->with('IpoDetails')
                    ->with('IpoLotInformations')
                    ->with('IpoTimeTables')->get();


                return response(['success', $ipodata]);
            } else if ($ipotime == "currentyearipos") {
                $ipodata = IpoCompany::whereHas('IpoDetails', function ($query) use ($start_currentyear, $end_currenttyear) {
                    $query->where('open_date', '>=', $start_currentyear)
                        ->where('open_date', '<=', $end_currenttyear);
                })->with('IpoDetails')
                    ->with('IpoLotInformations')
                    ->with('IpoTimeTables')->get();


                return response(['success', $ipodata]);
            } else if ($ipotime == "nextyearipos") {
                $ipodata = IpoCompany::whereHas('IpoDetails', function ($query) use ($start_nextyear, $end_nextyear) {
                    $query->where('open_date', '>=', $start_nextyear)
                        ->where('open_date', '<=', $end_nextyear);
                })->with('IpoDetails')
                    ->with('IpoLotInformations')
                    ->with('IpoTimeTables')->get();


                return response(['success', $ipodata]);
            } else {
                return response(['fail', 'realmadrid']);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    //
}
