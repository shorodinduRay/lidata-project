<?php

namespace App\Http\Controllers\User\Searching;

use App\Models\Credit;
use Illuminate\Http\Request;
use App\Exports\CustomExport;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\DownloadedList;
use App\Models\LidataUserModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class DataSearch extends Controller
{
    protected $allData;
    protected $allDataIds;
    protected $getdownloadedId;

    public function filter_data($request)
    {
        $query = DB::table('lidata');
        //$query = QueryBuilder::for(Lidata::class);
            //->whereNotIn('id', explode(',', $this->getdownloadedId));

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
            $query =  $query->where('gender', '=', $request->state);
        }
        if ($request->industry != null) {
            $query =  $query->where('organization_industries', '=', $request->industry);
        }
        // if ($request->age != null) {
        //     $query =  $query->where('age', 'like', '%/' . $ages);
        // }

        $results = $query->orderBy('person_name', 'ASC');
        return $results;
    }
    public function customExport(Request $request)
    {
         //dd($request->limit);
            $credit=Credit::where('userId',Auth::user()->id)->first();
            $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
            $getdownloadedIds = 0;
            foreach ($this->allDataIds as $dataIds) {
                $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
            }
            if($request->age != null)
            {
                Credit::filterCredit();
            }
            $response_data = $this->filter_data($request);
            $requestedData = $response_data->get();
            $getdownloadedIds = 0;
            foreach ($this->allDataIds as $dataIds) {
                $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
            }
            $this->getdownloadedId = $getdownloadedIds;
            $this->allData = $response_data
                            ->whereNotIn('id', explode(',', $this->getdownloadedId))
                            ->get();

            
            if($request->limit != null)
            {
                $allDatas = $this->allData->pluck('id')->take($request->limit);
                $data_list =$requestedData->pluck('id')->take($request->limit);
            }
            else
            {
                $allDatas = $this->allData->pluck('id');
                $data_list =$requestedData->pluck('id');
            }
            $array = $allDatas->toArray();
            $preDownloaded = count($array);
            $preDownloaded2 = $preDownloaded - (count(array_intersect($allDatas->toArray(), explode(',',$getdownloadedIds ))));

            if ($credit->useableCredit >= $preDownloaded2)
            {
                Credit::allDataCradit($preDownloaded, $array);
                ExportHistori::allDataExportHistori($preDownloaded, $allDatas);
                DownloadedList::createAllNew($allDatas);
                CreditHistory::createAll($preDownloaded);
                LidataUserModel::updateUseAbleCredit($allDatas);
                return (new CustomExport($data_list->toArray()))->download('lidata.xlsx');
            }
            else
            {
                return redirect('/settings/upgrade');
            }
    }

    public function downloadData(Request $request)
    {
        $credit = Credit::where('userId', Auth::user()->id)->first();
        $allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($allDataIds as $dataIds) {
            $getdownloadedIds = $getdownloadedIds . ',' . $dataIds->downloadedIds;
        }
        $preDownloaded = count($request->chk) - (count(array_intersect($request->chk, explode(',', $getdownloadedIds))));


        if ($credit->useableCredit >= $preDownloaded) {
            Credit::updateUserCradit($request);
            ExportHistori::newExportHistori($request);
            DownloadedList::createNew($request);
            CreditHistory::create($request);
            LidataUserModel::updateUseAbleCredit($request);

            return (new CustomExport($request->chk))->download('lidata.xlsx');
        } else {
            return redirect('/settings/upgrade');
        }
    }
}
