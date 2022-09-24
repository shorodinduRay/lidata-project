<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\LidataUserModel;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use Exception;
use Auth;

class SocialController extends Controller
{
    protected $country;
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        $this->country = Country::all();
        try {

            $user = Socialite::driver('facebook')->user();
            //dd($user);
            $isUser = LidataUserModel::where('fb_id', $user->id)->first();
            if($isUser){
                $saveUser = LidataUserModel::where('fb_id', $user->id)->first();
                //return redirect()->route('loggedInUser');
            }else{
                $splitName = explode(' ', $user->name, 2);
                $firstname = $splitName[0];
                $lastname = !empty($splitName[1]) ? $splitName[1] : '';
                return view('user.userFacebookRegister', ['newUserData'=>$user,
                    'countries' => $this->country, 'lastName' => $lastname, 'firstName' => $firstname]);
            }
            Auth::loginUsingId($saveUser->id);
            return redirect('loggedInUser');

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


}
