<?php

namespace App\Http\Controllers\User\Searching;

use App\Models\Credit;
use App\Models\Lidata;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\DownloadedList;
use App\Models\LidataUserModel;
use App\Exports\CustomAccountExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DownloadedCompanyList;
use Spatie\QueryBuilder\QueryBuilder;

class CompanySearch extends Controller
{
    protected $allData;
    protected $allDataIds;
    protected $getdownloadedId;

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
            ->whereIn('id', explode(',',implode(',',$ids)));
            //->whereNotIn('id', explode(',', $this->getdownloadedId));
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
    public function customExport(Request $request)
    {
        // dd($req uest->name);
        if ($request->company == null && $request->city == null && $request->state == null
        && $request->country == null && $request->industry == null ) {
            $this->countries = Country::all();
            $dataCount = QueryBuilder::for(PhoneList::class)
                ->select('id')
                ->count();
            return view('userDashboard.company', ['country' => $this->countries, 'count'=>$dataCount]);
        }
        $credit=Credit::where('userId',Auth::user()->id)->first();
        $this->allDataIds = DownloadedCompanyList::where('userId', Auth::user()->id)->get();
        if($request->age != null)
        {
            Credit::filterCredit();
        }
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds) {
            $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
        }
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
        $response_data = $this->filter_data($request, $organization_id);
        //$requestedData = $response_data->get();
            

        $this->allData = $response_data
                        ->whereNotIn('id', explode(',', $this->getdownloadedId))
                        ->get();

        if($request->limit != null)
        {
            $allDatas = $this->allData->pluck('id')->take($request->limit);
            $data_list =$this->allData->pluck('id')->take($request->limit);
        }
        else
        {
            $allDatas = $this->allData->pluck('id');
            $data_list =$this->allData->pluck('id');
        }
        $array = $allDatas->toArray();
        $preDownloaded = count($array);
        $preDownloaded2 = $preDownloaded - (count(array_intersect($allDatas->toArray(), explode(',',$getdownloadedIds ))));

        if ($credit->useableCredit >= $preDownloaded2)
        {
            Credit::allDataCradit($preDownloaded, $array);
            ExportHistori::allDataExportHistori($preDownloaded, $allDatas);
            DownloadedCompanyList::createAllNew($allDatas);
            CreditHistory::createAll($preDownloaded);
            LidataUserModel::updateUseAbleCredit($allDatas);

            return (new CustomAccountExport($data_list->toArray()))->download('lidata.xlsx');
        }
        else
        {
            return redirect('/settings/upgrade');
        }
    }

    public function downloadData(Request $request)
    {
        $credit = Credit::where('userId', Auth::user()->id)->first();
        $allDataIds = DownloadedCompanyList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($allDataIds as $dataIds) {
            $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
        }
        $preDownloaded = count($request->chk) - (count(array_intersect($request->chk, explode(',', $getdownloadedIds))));


        if ($credit->useableCredit >= $preDownloaded) {
            Credit::updateUserCradit($request);
            ExportHistori::newExportHistori($request);
            DownloadedCompanyList::createNew($request);
            CreditHistory::create($request);
            LidataUserModel::updateUseAbleCredit($request);

            return (new CustomAccountExport($request->chk))->download('lidata.xlsx');
        } else {
            return redirect('/settings/upgrade');
        }
    }
}