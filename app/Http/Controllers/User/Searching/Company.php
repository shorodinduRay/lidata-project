<?php

namespace App\Http\Controllers\User\Searching;

use DB;
use App\Models\Credit;
use App\Models\Lidata;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\DownloadedList;
use App\Models\LidataUserModel;
use App\Models\SetPurchasePlan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DownloadedCompanyList;
use Spatie\QueryBuilder\QueryBuilder;

class Company extends Controller
{
    protected $allData;
    protected $allDataIds;
    protected $countries;


    public function filter_data($request, $ids)
    {
        if ($request->age != null) {
            $validated = $request->validate([
                'age' => 'required|digits:4',
            ]);
            $ages = $validated['age'];
        }

        // $query = DB::table('phone_lists')
        $query = QueryBuilder::for(Lidata::class)
            ->whereIn('id', explode(',',implode(',',$ids)))
            ->whereNotIn('id', explode(',', $this->getdownloadedId));

        if ($request->company != null) {
            $query =  $query ->where('organization_name', '=', $request->company);
        }
        if ($request->city != null) {
            $query =  $query ->where('organization_hq_location_city', '=', $request->city);
            
        }
        if ($request->state != null) {
            $query =  $query->where('organization_hq_location_state', '=', $request->state);
        }
        if ($request->country != null) {
            $query =  $query ->where('organization_hq_location_country', '=', $request->country);
        }
        if ($request->industry != null) {
            $query =  $query->where('organization_industries', '=', $request->industry);
        }

        $results = $query->orderBy('organization_name', 'ASC');
        return $results;
    }
    public function companySearchCombination(Request $request)
    {
        $credit=Credit::where('userId',Auth::user()->id)->first();
        $this->package = SetPurchasePlan::all();
        if($credit->useableCredit == 0 )
            return view('userDashboard.settings.upgrade', [ 'packages' => $this->package ]);
        if($credit->useableCredit <= -1 ){
            Credit::where('userId',Auth::user()->id)->update(['useAbleCredit' => 0 ]);
            LidataUserModel::find(Auth::user()->id)->update(['useAbleCredit' => 0]);
            return view('userDashboard.settings.upgrade', [ 'packages' => $this->package ]);
        }
        if($credit->useableCredit >= 1 && $request->company != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->city != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->state != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->country != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->industry != null && $request->page == null)
            Credit::filterCredit();

        $this->countries = Country::all();
        $this->allDataIds = DownloadedCompanyList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $result = $request->name;
        $this->getdownloadedId = $getdownloadedIds;

        $nameList = Lidata::select('id', 'organization_name')
                                //->whereNotIn('id', explode(',',$getdownloadedIds))
                                ->get();
        
        $organization = array();
        foreach ($nameList as $list)
        {
            $organization[$list->id] = $list->organization_name;
        }
        $organization = array_unique($organization, SORT_REGULAR);

        $organization_id = array();
        foreach ($organization as $i => $value) {
            $organization_id[] = $i;
        }
        if ($request->company == null && $request->city == null && $request->state == null
        && $request->country == null && $request->industry == null)
        {
            $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
            $getdownloadedIds = 0;
            foreach ($this->allDataIds as $dataIds)
            {
                $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
            }
            $dataCount = count(lidata::all());
            $this->allData = lidata::whereNotIn('id', explode(',',$getdownloadedIds))
                /*->orderBy('person_name', 'ASC')*/
                ->simplePaginate(15);
            return view('userDashboard.company', ['allData' => $this->allData, 'country' => $this->countries, 'count' => $dataCount]);
        }
        $response_data = $this->filter_data($request, $organization_id);
        // $this->allData = $response_data->paginate(15);
        $this->allData = $response_data->simplePaginate(15)->withQueryString();
        $dataCount = $response_data->select('id')->count();
        //dd($this->allData);
        if($this->allData->isEmpty())
        {
            return view('userDashboard.company', [
                'allData' => $this->allData, 'country' => $this->countries,
                'company' => $request->company, 'city' => $request->city,
                'state' => $request->state, 'countries' => $request->country,
                'industry' => $request->industry, 'count' => $dataCount, 'message' => 'No Data Found'
            ]);
        }
            
            return view('userDashboard.company', [
                'allData' => $this->allData, 'country' => $this->countries,
                'company' => $request->company, 'city' => $request->city,
                'state' => $request->state, 'countries' => $request->country,
                'industry' => $request->industry, 'count' => $dataCount
            ]);
    }
}
