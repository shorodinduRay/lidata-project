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
use Spatie\QueryBuilder\QueryBuilder;

class Combination extends Controller
{
    public function filter_data($request)
    {
        if ($request->age != null) {
            $validated = $request->validate([
                'age' => 'required|digits:4',
            ]);
            $ages = $validated['age'];
        }

        // $query = DB::table('phone_lists')
        $query = QueryBuilder::for(Lidata::class)
            ->whereNotIn('id', explode(',', $this->getdownloadedId));

        if ($request->name != null) {
            $query =  $query->where(function ($query) use ($request) {
                $query->where('person_first_name_unanalyzed', '=',  $request->name)
                ->orWhere('person_last_name_unanalyzed', '=',  $request->name)
                ->orWhere('person_name', '=',  $request->name);
            });
        }
        if ($request->jobTitle != null) {
            $query =  $query->where(function ($query) use ($request) {
                $query->where('person_title', '=', $request->jobTitle)
                ->orWhere('person_functions', '=', $request->jobTitle)
                ->orWhere('person_detailed_function', '=',$request->jobTitle)
                ->orWhere('person_seniority', '=', ' '.$request->jobTitle);
            });
            
        }
        if ($request->company != null) {
            $query->where('organization_name', '=', $request->company);
        }
        if ($request->city != null) {
            $query =  $query->where('person_location_city', '=', $request->city);
        }
        if ($request->state != null) {
            $query =  $query->where('person_location_state', '=', $request->state);
        }
        if ($request->industry != null) {
            $query =  $query->where('organization_industries', '=', $request->industry);
        }
        if ($request->age != null) {
            $query =  $query->where('age', 'like', '%/' . $ages);
        }

        $results = $query->orderBy('person_name', 'ASC');
        return $results;
    }
    public function peopleSearchCombination(Request $request)
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
        if($credit->useableCredit >= 1 && $request->name != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->jobTitle != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->company != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->city != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->state != null && $request->page == null)
            Credit::filterCredit();
        if($credit->useableCredit >= 1 && $request->industry != null && $request->page == null)
            Credit::filterCredit();

        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $this->getdownloadedId = $getdownloadedIds;


        if ($request->name == null && $request->jobTitle == null && $request->company == null
        && $request->city == null && $request->state == null && $request->industry == null
        /*&& $request->age == null*/) {
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
                return view('userDashboard.people', ['allData' => $this->allData, 'count' => $dataCount]);
        }
        $response_data = $this->filter_data($request);
        // $this->allData = $response_data->paginate(15);
        $this->allData = $response_data->simplePaginate(15)->withQueryString();
        $dataCount = $response_data->select('id')->count();

        if($this->allData->isEmpty())
        {
            return view('userDashboard.people', [
                'allData' => $this->allData,
                'name' => $request->name, 'jobTitle' => $request->jobTitle,
                'company' => $request->company, 'city' => $request->city,
                'state' => $request->state, 'industry' => $request->industry,
                /*'age' => $request->age,*/ 'count' => $dataCount, 'message' => 'No Data Found'
            ]);
        }
            
            return view('userDashboard.people', [
                'allData' => $this->allData,
                'name' => $request->name, 'jobTitle' => $request->jobTitle,
                'company' => $request->company, 'city' => $request->city,
                'state' => $request->state, 'industry' => $request->industry,
                /*'age' => $request->age,*/ 'count' => $dataCount
            ]);
    }
}
