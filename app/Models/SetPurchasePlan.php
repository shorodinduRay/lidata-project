<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPurchasePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan',
        'credit',
        'creditConvert',
        'dataViews',
        'dataViewsConvert',
        'dataFilter',
        'csvExport',
        'icon',
        'price',
    ];
}
