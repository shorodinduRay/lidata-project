<?php

namespace App\Http\Controllers\Packages;

use App\Http\Controllers\Controller;
use App\Models\SetPurchasePlan;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    protected $package;
    public function packages()
    {
        $this->package = SetPurchasePlan::all();
        return view('front.pricing.package', [ 'packages' => $this->package ]);
    }
}
