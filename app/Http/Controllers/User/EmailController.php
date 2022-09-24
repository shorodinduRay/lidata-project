<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\LidataUserModel;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function handleEmailCallback(Request $request)
    {
        $isUser = LidataUserModel::where('email', $request->email)->first();

        if($isUser){
            return redirect()->route('user.login');
        }else{
            $this->country = Country::all();
            return view('user.userEmailRegister', ['newUserData'=>$request->email, 'countries'=> $this->country]);
        }

    }
}
