<?php

namespace App\Exports;

use App\Models\Lidata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountsCSVExportSettings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomAccountExport implements FromQuery , WithHeadings
{
    use Exportable;
    protected $ids;
    protected $z;
    protected $exports;
    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function query()
    {
        $this->exports = AccountsCSVExportSettings::where('userId', Auth::user()->id)->first();
    
        return DB::table('lidata')
                ->select(explode(',',$this->exports->column))
                //->explode(',',$this->exports->column)
                ->whereIn('id',$this->ids)
                ->orderBy('id', 'asc');
        //return DB::table('lidata')->whereIn('id',$this->ids)->orderBy('id', 'desc');
        //return Phonelist::whereIn('id',$this->ids)('id',$this->ids)->orderBy('id', 'desc');
    }
    public function headings() :array
    {
        $this->exports = AccountsCSVExportSettings::where('userId', Auth::user()->id)->first();
        return [
            explode(',',$this->exports->column)
        ];
        /*return [
            'id',
            'person_email',
            'person_first_name_unanalyzed',
            'person_last_name_unanalyzed',
            'person_sanitized_phone',
            'person_title',
            'person_functions',
            'person_detailed_function',
            'person_seniority',
            'person_location_city',
            'person_location_state',
            'person_location_country',
            'person_location_postal_code',
            'person_linkedin_url',
            'organization_name',
            'organization_domain',
            'organization_phone',
            'organization_facebook_url',
            'organization_linkedin_numerical_urls',
            'organization_twitter_url',
            'organization_website_url',
            'organization_angellist_url',
            'organization_founded_year',
            'organization_hq_location_city',
            'organization_hq_location_postal_code',
            'organization_hq_location_state',
            'organization_hq_location_country',
            'organization_num_current_employees',
            'organization_languages',
            'organization_industries',


        ];*/
    }
}
