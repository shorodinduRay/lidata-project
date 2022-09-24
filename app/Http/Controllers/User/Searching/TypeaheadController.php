<?php

namespace App\Http\Controllers\User\Searching;

use App\Models\User;
use App\Models\Lidata;
use App\Models\PhoneList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;

class TypeaheadController extends Controller
{
    protected $data;
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Lidata::where('person_name', '=', $query)
            ->orWhere('person_first_name_unanalyzed', '=', $query)
            ->orWhere('person_last_name_unanalyzed', '=', $query)
            ->take(10)
            ->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->person_name;
        }
        return response()->json($data);

    }

    public function autocompletecompanySearch(Request $request)
    {   
        $nameList = Lidata::select('id', 'organization_name')
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



        $term = $request->get('term');
        $filterResultcompany = Lidata::whereIn('id', explode(',',implode(',',$organization_id)))
                                    ->where('organization_name', 'LIKE', '%'. $term. '%')
                                    ->take(10)
                                    ->get();
                                    
        $data = array();
        foreach ($filterResultcompany as $hsl)
        {
            $data[] = $hsl->organization_name;
        }
        return response()->json($data);
        

    }

    public function searchPeople($request)
    {
        $query = $request;
        $this->data = DB::table('phone_lists')
            ->where('name', 'like', $query.'%');
        return view('userDashboard.people', ['allData' => $this->data]);

    }
}
