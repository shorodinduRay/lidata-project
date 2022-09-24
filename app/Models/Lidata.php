<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lidata extends Model
{
    use HasFactory;
    protected $table = "lidata";
    protected static $liData;
    protected $fillable = [
    'person_email',
    'person_name',
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
    'organization_industries'];
    public static function getLidata(){
        $records = DB::table('lidata')->select('id',
        'person_email',
        'person_name',
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
        'organization_industries')->get()->toArray();
        return $records;
    }

    public static function updateLiData($request)
    {
        self::$liData = Lidata::find($request->liDataUserid)
        ->update([
            'person_name' => $request->person_name,
            'person_title' => $request->person_title,
            'organization_name' => $request->organization_name,
            'person_email' => $request->person_email,
            'person_sanitized_phone' => $request->person_sanitized_phone,
            'person_functions' => $request->person_functions,
            'person_detailed_function' => $request->person_detailed_function,
            'person_seniority' => $request->person_seniority,
            'person_location_city' => $request->person_location_city,
            'person_location_state' => $request->person_location_state,
            'person_location_country' => $request->person_location_country,
            'person_location_postal_code' => $request->person_location_postal_code,
            'person_linkedin_url' => $request->person_linkedin_url,
        ]);
        // self::$liData->person_name                              = $request->person_name;
        // self::$liData->person_title                             = $request->person_title;
        // self::$liData->organization_name                        = $request->organization_name;
        // self::$liData->person_email                             = $request->person_email;
        // self::$liData->person_sanitizd_phone                    = $request->person_sanitizd_phone;
        // self::$liData->person_functions                         = $request->person_functions;
        // self::$liData->person_detailed_function                 = $request->person_detailed_function;
        // self::$liData->person_seniority                         = $request->person_seniority;
        // self::$liData->person_location_city                     = $request->person_location_city;
        // self::$liData->person_location_state                    = $request->person_location_state;
        // self::$liData->person_location_country                  = $request->person_location_country;
        // self::$liData->person_location_postal_code              = $request->person_location_postal_code;
        // self::$liData->person_linkedin_url                      = $request->person_linkedin_url;
        // self::$liData->save();
    }
    
}
