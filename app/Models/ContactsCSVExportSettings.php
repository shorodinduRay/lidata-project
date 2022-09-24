<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactsCSVExportSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'column',
    ];
    protected static $csvExportColumn;
    protected static $credit;

    public static function create($request)
    {
        self::$csvExportColumn = new ContactsCSVExportSettings();
        self::$csvExportColumn->userId   = $request->id;
        self::$csvExportColumn->column  = 'person_first_name_unanalyzed,person_last_name_unanalyzed,person_title,organization_name,person_email,person_sanitized_phone,person_location_city,person_location_state,person_location_country,organization_num_current_employees,organization_industries,organization_hq_location_city,organization_hq_location_state,organization_hq_location_country';
        self::$csvExportColumn->save();
    }

    public static function customization($request)
    {
        $request = $request->toArray();
        unset($request["_token"]);
        $request = array_filter($request, function($request) {return $request !== "";});
        self::$csvExportColumn = ContactsCSVExportSettings::where('userId',Auth::user()->id)->first();
        self::$csvExportColumn->userId   = Auth::user()->id;
        self::$csvExportColumn->column  = implode(',',$request);
        self::$csvExportColumn->save();
    }
}
