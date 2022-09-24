<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credit extends Model
{
    use HasFactory;
    protected static $credit;
    protected static $allDataIds;
    protected $fillable = [
        'userId',
        'useableCredit'
    ];

    public static function updateUserCradit($request)
    {
        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach (self::$allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }



        $preDownloaded = (count(array_intersect($request->chk, explode(',',$getdownloadedIds ))));




        self::$credit = Credit::where('userId', $request->userId)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit-count($request->chk)+$preDownloaded;
        self::$credit->save();
    }
    public static function allDataCradit($request, $array)
    {

        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach (self::$allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }



        $preDownloaded = (count(array_intersect($array, explode(',',$getdownloadedIds ))));

        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         =  Auth::user()->id;
        self::$credit->useableCredit  = $usableCredit-$request+$preDownloaded;
        self::$credit->save();
    }
    public static function updateUserCreditForOne($request)
    {
        self::$allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach (self::$allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }

        $preDownloaded = (count(array_intersect($request->toArray(), explode(',',$getdownloadedIds ))));

        self::$credit = Credit::where('userId', Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = Auth::user()->id;
        self::$credit->useableCredit  = $usableCredit-1+$preDownloaded;
        self::$credit->save();
    }
    public static function updateCredit($request)
    {
        self::$credit = Credit::where('userId', Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        self::$credit->save();
    }
    public static function updateCreditByBTC($request)
    {
        self::$credit = Credit::where('userId', $request->userId)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        self::$credit->save();
    }
    public static function updateCreditByAdmin($request, $id)
    {
        self::$credit = Credit::find($id);
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $id;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        self::$credit->save();
    }
    public static function filterCredit()
    {
        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId = Auth::user()->id;
        self::$credit->useableCredit = $usableCredit - 1;
        self::$credit->save();

        $user = LidataUserModel::find(Auth::user()->id);
        $user->update([
            'useAbleCredit' => self::$credit->useableCredit,
        ]);
    }
    public static function errorCredit()
    {
        self::$credit = Credit::where('userId',Auth::user()->id)->first();
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId = Auth::user()->id;
        self::$credit->useableCredit = 0;
        self::$credit->save();

        $user = LidataUserModel::find(Auth::user()->id);
        $user->update([
            'useAbleCredit' => 0,
        ]);
    }
}
