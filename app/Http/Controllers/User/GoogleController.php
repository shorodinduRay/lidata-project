<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Credit;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\LidataUserModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\AccountsCSVExportSettings;
use App\Models\ContactsCSVExportSettings;
use Illuminate\Support\Facades\Validator;

class GoogleController extends Controller
{
    protected $newUser;
    protected $exportHistory;
    protected $purchasePlan;
    CONST DRIVER_TYPE = 'google';

    public function handleGoogleRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver(static::DRIVER_TYPE)->user();

            $userExisted = LidataUserModel::where('email', $user->email)->first();

            if( $userExisted ) {

                $saveUser = LidataUserModel::where('email', $user->email)->first();


                //return redirect('loggedInUser');

            }else {
                $splitName = explode(' ', $user->getName(), 2);
                $firstname = $splitName[0];
                $lastname = !empty($splitName[1]) ? $splitName[1] : '';
                return view('user.userGoogleRegister', ['newUserData'=>$user, 'lastname' => $lastname, 'firstname' => $firstname]);
            }
            Auth::loginUsingId($saveUser->id);
            $this->creditHistory = CreditHistory::where('userId',Auth::user()->id)->get();
            $this->purchasePlan = PurchasePlan::where('userId',Auth::user()->id)->get();
            $i=0;
            $dataPurchase = [];
            foreach ($this->creditHistory as $history)
            {
                $dataPurchase [$i] = $history->dataPurchase;
                $i++;
            }
            $j=0;
            $creditPurchase = [];
            foreach ($this->purchasePlan as $plan)
            {
                $creditPurchase [$j] = $plan->credit;
                $j++;
            }
            return redirect('loggedInUser');



        } catch (Exception $e) {
            //dd($e);
            return redirect('/user-login')->with('message',$e);
        }

    }
    public function googleNewUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:lidata_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone'=>'required|unique:lidata_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect("/user-login")->with('message', 'phone number is invalid');
        } 
            $check = $this->create($data);
            PurchasePlan::create($check);
            Credit::create([
                'userId' => $check->id,
                'useableCredit' => 20,
            ]);
            CreditHistory::createNew($check);
            ContactsCSVExportSettings::create($check);
            AccountsCSVExportSettings::create($check);
            return redirect("/user-login")->with('message', 'data Updated Successfully');
    }
    public function create(array $data)
    {
        return LidataUserModel::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'name' => $data['firstName'].' '.$data['lastName'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'purchasePlan' => 'Free',
            'useAbleCredit' => 20,
            'google_id' => $data['google_id'],
            //'is_email_verified' => 1	
        ]);
    }
    
    public function handleGoogleCallbackRegister()
    {
        return view('user.userGoogleRegister');
    }
}
