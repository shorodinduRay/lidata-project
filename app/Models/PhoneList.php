<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhoneList extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'email',
        'uid',
        'first_name',
        'last_name',
        'name',
        'gender',
        'country',
        'location',
        'hometown',
        'relationship_status',
        'education_last_year',
        'work',
    ];
    protected static $phoneList;
    protected $table = "phone_lists";
    protected static $facebookDirectory;
    protected static $userId;
    protected static $facebookUserId;
    protected static $facebookId;
    protected static $nameList;




    public static function newPhoneList($request)
    {
        self::$phoneList = new PhoneList();
        self::$phoneList->phone                     = $request->phone;
        self::$phoneList->uid                       = $request->uid;
        self::$phoneList->email                     = $request->email;
        self::$phoneList->first_name                = $request->first_name;
        self::$phoneList->last_name                 = $request->last_name;
        self::$phoneList->name                      = $request->first_name.' '.$request->last_name;
        self::$phoneList->gender                    = $request->gender;
        self::$phoneList->country                   = $request->country;
        self::$phoneList->location                  = $request->location;
        self::$phoneList->hometown                  = $request->hometown;
        self::$phoneList->relationship_status       = $request->relationship_status;
        self::$phoneList->education_last_year       = $request->education_last_year;
        self::$phoneList->work                      = $request->work;
        self::$phoneList->save();
    }

    public static function updatePhoneList($request)
    {
        self::$phoneList = PhoneList::find($request->id);
        self::$phoneList->phone                     = $request->phone;
        self::$phoneList->uid                       = $request->uid;
        self::$phoneList->email                     = $request->email;
        self::$phoneList->first_name                = $request->first_name;
        self::$phoneList->last_name                 = $request->last_name;
        self::$phoneList->gender                    = $request->gender;
        self::$phoneList->country                   = $request->country;
        self::$phoneList->location                  = $request->location;
        self::$phoneList->hometown                  = $request->hometown;
        self::$phoneList->relationship_status       = $request->relationship_status;
        self::$phoneList->education_last_year       = $request->education_last_year;
        self::$phoneList->work                      = $request->work;
        self::$phoneList->save();
    }



}
