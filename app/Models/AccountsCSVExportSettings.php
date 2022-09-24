<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountsCSVExportSettings extends Model
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
        self::$csvExportColumn = new AccountsCSVExportSettings();
        self::$csvExportColumn->userId   = $request->id;
        self::$csvExportColumn->column  = 'organization_name,organization_domain,organization_phone,organization_num_current_employees,organization_industries,organization_hq_location_city,organization_hq_location_state,organization_hq_location_country';
        self::$csvExportColumn->save();
    }

    public static function customization($request)
    {
        $request = $request->toArray();
        unset($request["_token"]);
        $request = array_filter($request, function($request) {return $request !== "";});
        self::$csvExportColumn = AccountsCSVExportSettings::where('userId',Auth::user()->id)->first();
        self::$csvExportColumn->userId   = Auth::user()->id;
        self::$csvExportColumn->column  = implode(',',$request);
        self::$csvExportColumn->save();
    }
}
