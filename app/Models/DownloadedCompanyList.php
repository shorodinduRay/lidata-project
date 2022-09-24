<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownloadedCompanyList extends Model
{
    use HasFactory;
    protected static $list;
    protected static $lists;
    protected $fillable = [
        'userId',
        'downloadedIds',
    ];
    public static function createNew($request)
    {
        self::$list = new DownloadedCompanyList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds         = implode(',',$request->chk) ;
        self::$list->save();
    }
    public static function createAllNew($request)
    {
        self::$list = new DownloadedCompanyList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds         = implode(',',$request->toArray()) ;
        self::$list->save();
    }
    public static function createForOne($request)
    {
        self::$list = new DownloadedCompanyList();
        self::$list->userId         = Auth::user()->id;
        self::$list->downloadedIds  = $request->id;
        self::$list->save();
    }
    public static function deleteUser($id){
        self::$lists = DownloadedCompanyList::where('userId', $id)->get();
        foreach(self::$lists as self::$list)
        {
            self::$list->delete();
        }
    }
}
