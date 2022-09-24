<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LidataUserModel extends Authenticatable
{
    use HasFactory;

    protected static $credit;
    protected static $user;

    protected $fillable = [
        'email',
        'password',
        'firstName',
        'lastName',
        'phone',
        'country',
        'google_id',
        'title',
        'address',
        'purchasePlan',
        'useAbleCredit',
        'fb_id',
        'google_id',
        'is_email_verified',
        'date',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public static function updatePlanAndCredit($request)
    {

        self::$user = LidataUserModel::find($request->userId);
        self::$credit = Credit::where('userId', Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$user->update([
            'purchasePlan' => $request->plan,
            'useAbleCredit' => $usableCredit,
        ]);
    }
    public static function updatePlanAndCreditByBTC($request)
    {

        self::$user = LidataUserModel::find($request->userId);
        self::$credit = Credit::where('userId', $request->userId)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$user->update([
            'purchasePlan' => $request->plan,
            'useAbleCredit' => $usableCredit,
        ]);
    }
    public static function updateUseAbleCredit($request)
    {

        self::$user = LidataUserModel::find(Auth::user()->id);
        self::$credit = Credit::where('userId', Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$user->update([
            'useAbleCredit' => $usableCredit,
        ]);
    }
    public static function updateUseAbleCreditForOne($request, $id)
    {
        self::$user = LidataUserModel::find(Auth::user()->id);
        self::$credit = Credit::where('userId', Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$user->update([
            'useAbleCredit' => $usableCredit,
        ]);
    }

    public static function updatePlanAndCreditByAdmin($request, $id)
    {

        self::$user = LidataUserModel::find($id);
        self::$credit = Credit::find($id);
        $usableCredit = self::$credit->useableCredit;
        self::$user->update([
            'purchasePlan' => $request->plan,
            'useAbleCredit' => $usableCredit,
        ]);
    }
}
