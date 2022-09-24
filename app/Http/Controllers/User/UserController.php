<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Card;
use App\Models\Credit;
use App\Models\Lidata;
use App\Models\Contact;
use App\Models\Country;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Imports\ContactImport;
use App\Models\DownloadedList;
use App\Models\LidataUserModel;
use App\Models\SetPurchasePlan;
use App\Models\LiDataUserVerify;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DownloadedCompanyList;
use Illuminate\Support\Facades\Session;
use App\Models\AccountsCSVExportSettings;
use App\Models\ContactsCSVExportSettings;
use App\Models\InvoiceHistory;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    protected $email;
    protected $password;
    protected $emailAuth;
    protected $passwordAuth;
    protected $data;
    protected $id;
    protected $user;
    protected $allData;
    protected $country;
    protected $package;
    protected $credit;
    protected $creditHistory;
    protected $exportHistory;
    protected $purchasePlan;
    protected $creditHistorydate;
    protected $allDataIds;
    protected $allDataIds2;
    protected $countries;
    protected $dataAll;


    public function dashboard()
    {
        // to handle -1 error in credit
        $this->dataAll = DB::table('lidata')
                            ->whereNotNull('person_email')
                            ->count();
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        if ($this->credit->useableCredit == -1)
        {
            Credit::errorCredit();
        }
        $this->creditHistory = CreditHistory::where('userId',Auth::user()->id)->orderBy('id', 'desc')->get();
        $this->purchasePlan = PurchasePlan::where('userId',Auth::user()->id)->orderBy('start', 'desc')->get();
        //$this->creditHistorydate = CreditHistory::where('userId',Auth::user()->id)->orderBy('date', 'desc')->get();
        $findCredits = CreditHistory::select(
                                        "userId" ,
                                        DB::raw("(sum(dataPurchase)) as total_dataPurchase"),
                                        DB::raw("date as _date")
                                        )
                                        ->where('userId',Auth::user()->id)
                                        ->orderBy('date', 'desc')
                                        ->groupBy( "userId", DB::raw("date"))
                                        ->get();
        $i=0;
        $dataPurchase = [];
        $date = [];
        foreach ($findCredits as $history)
        {
            if( $i < 7)
            {
                $dataPurchase [$i] = $history->total_dataPurchase;
                $date [$i] = $history->_date;
                $i++;
            }

        }
        //dd($date);

        // 7 days history
        $j=0;
        $creditPurchase = [];
        foreach ($this->purchasePlan as $plan)
        {
            if( $j < 1)
            {
                if($date[$j] == $plan->start)
                {
                    $creditPurchase [$j] = $plan->credit;
                }
                else
                {
                    $creditPurchase [$j] = 0;
                }

                $j++;
            }
        }
        return view('userDashboard.userDashboard',['userHistory'=> $this->creditHistory, 'person_email'=> $this->dataAll ])->with('data',json_encode($dataPurchase,JSON_NUMERIC_CHECK))->with('credit',json_encode($creditPurchase,JSON_NUMERIC_CHECK))->with('day',json_encode($date,JSON_NUMERIC_CHECK));
        /*if(Auth::check()){*/
            //return view('userDashboard.userDashboard');
        /*}
        return redirect('user-login')->with('message','Oppes! You have entered invalid credentials');*/

    }


    public function userRegister()
    {
        $this->country = Country::all();
        return view('user.userRegister', ['countries'=> $this->country]);
    }


    public function newUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:lidata_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone'=>'required|min:11|numeric|unique:lidata_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            return redirect()->back()->with('message1', 'The email or phone number has already been taken');
        } 
        
        else {
            $check = $this->create($data);
            $newUser = LidataUserModel::where('email', $data['email'])->first();
            PurchasePlan::createNew($newUser);
            // return $newUser;
            Credit::create([
                'userId' => $newUser->id,
                'useableCredit' => 50,
            ]);  
            CreditHistory::createNew($check);
            ContactsCSVExportSettings::create($check);
            AccountsCSVExportSettings::create($check);

            $token = Str::random(64);
            LiDataUserVerify::create([
                'user_id' => $check->id, 
                'token' => $token
            ]);
    
            Mail::send('email.emailForEmailVerification', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            return redirect("loggedInUser")->with('message2', 'data Updated Successfully');
        }
    }

    public function create(array $data)
    {
        if (isset($data['fb_id']))
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
                'useAbleCredit' => 50,
                'fb_id' => $data['fb_id']
            ]);
        }
        elseif (isset($data['google_id']))
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
                'useAbleCredit' => 50,
                'google_id' => $data['google_id']
            ]);
        }
        else
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
                'useAbleCredit' => 50,
                'fb_id' => null
            ]);

        }

    }

    public function verifyEmail($token)
    {
        $verifyUser = LiDataUserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('user.login')->with('message', $message);
    }


    /** start updating user information*/
    public function updateUserFirstName(Request $request, $id)
    {
        $this->user = LidataUserModel::where('id', $id)->update(['firstName' => $request->firstName]);
        return redirect()->back();

    }
    public function updateUserLastName(Request $request, $id)
    {
        $this->user = LidataUserModel::where('id', $id)->update(['lastName' => $request->lastName]);
        return redirect()->back();

    }
    public function updateUserTitle(Request $request)
    {
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['title' => $request->title]);
        return redirect()->back();

    }
    public function updateUserPhone(Request $request, $id)
    {
        $this->user = LidataUserModel::where('id', $id)->update(['phone' => $request->phone]);
        return redirect()->back();

    }
    public function updateUserAddress(Request $request)
    {
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['address' => $request->address]);
        return redirect()->back();

    }
    public function updateUserCountry(Request $request, $id)
    {
        $this->user = LidataUserModel::where('id', $id)->update(['country' => $request->country]);
        return redirect()->back();
    }
    public function updateUserEmail(Request $request, $id)
    {
        $user = LidataUserModel::find(Auth::user()->id);
        
        if ($user->email == $request->email)
        {
            return redirect()->route('account')->with('message', 'New Email is required' );
        }
        else
        {
            $token = Str::random(64);
            UserVerify::create([
              'user_id' => $id, 
              'token' => $token,
              'email' => $request->email
            ]);
            if ($user->google_id != null)
            {
                Mail::send('email.emailVerificationEmailWithPassword', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail to ');
                });
                return redirect()->back()->with('message', 'Pending confirmation to change email to '.$request->email );
            }
            else
            {
                Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail to ');
                });
                return redirect()->back()->with('message', 'Pending confirmation to change email to '.$request->email );
            }
            //$this->user = PhoneListUserModel::where('id', $id)->update(['email' => $request->email]);
            
        }
        //$this->user = LidataUserModel::where('id', $id)->update(['email' => $request->email]);
        //return redirect()->back();
    }
    public function updateUserPassword(Request $request, $id)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return redirect()->back();

    }
    public function updateUserInfo($array)
    {


        $myArray = explode(',', $array);
        $address = array_slice($myArray,5);
        $myAddress = implode(',', $address);


        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['firstName' => $myArray[1]]);
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['lastName' => $myArray[2]]);
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['title' => $myArray[3]]);
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['phone' => $myArray[4]]);
        $this->user = LidataUserModel::where('id', Auth::user()->id)->update(['address' => $myAddress]);
        return redirect()->route('account');

    }
    /** end updating user information*/

    /** start add/updating user billing information*/

    public function addCardInfo(Request $request)
    {
        Card::create([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function updateCardInfo(Request $request)
    {
        Card::where('id', $request->cardId)->update([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function removeCard()
    {
        Card::where('userId', Auth::user()->id)->delete();
        return redirect()->route('billing');
    }

    /** end add/updating user billing information*/

  

    public function userLogin()
    {
        return view('user.userLogin');
    }
    public function userLoginAuth(Request $request)
    {
        return view('user.userLogin');
    }


    public function userAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $result = $request->email;
            $this->data = LidataUserModel::where('email', '=', $result )->get();
            return redirect('loggedInUser')
                ->with( ['userData' => $this->data] )
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("user-login")->with('message','Oppes! You have entered invalid credentials');


    }

    public function handleGoogleRegister($userArray)
    {
        $this->data = $userArray;
        return view('user.', ['newUserData'=>$this->data]);
    }

    public function people()
    {
        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $dataCount = count(lidata::all());
        $this->allData = lidata::whereNotIn('id', explode(',',$getdownloadedIds))
            /*->orderBy('person_name', 'ASC')*/
            ->simplePaginate(15);
        return view('userDashboard.people', ['allData' => $this->allData, 'count' => $dataCount]);

    }

    public function peopleDataHistory(Request $request)
    {
        if($request->ajax())
        {
            $credit=Credit::where('userId', Auth::user()->id)->first();
            if ($credit->useableCredit >= 1)
            { 
                Credit::updateUserCreditForOne($request);
                LidataUserModel::updateUseAbleCreditForOne($request, Auth::user()->id);
                DownloadedList::createForOne($request);
                ExportHistori::newExportHistoriForOne($request);
                CreditHistory::createForOne($request);
                $data = DB::table('lidata')
                    ->where('id', '=', $request->id)
                    ->get();
                echo json_encode($data);
            }

        }
    }




    public function peopleSearch(Request $request)
    {
        $result = $request->name;
        $this->allData = DB::table('lidata')
        ->where('person_name', 'like', '%'.$result.'%')
            ->paginate(15);
        return view('userDashboard.peopleSearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }


    public function nameSearch(Request $request)
    {
        $credit=Credit::where('userId',Auth::user()->id)->first();
        if($credit->useableCredit == 0 )
            return view('userDashboard.settings.upgrade');
        if($credit->useableCredit >= 1 && $request->searchPeopleName != null && $request->page == null)
            Credit::filterCredit();
        $this->countries = Country::all();
        $this->allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $this->allData = DB::table('lidata')
            ->whereNotIn('id', explode(',',$getdownloadedIds))
            ->where('person_first_name_unanalyzed', '=',  $request->searchPeopleName)
            ->orWhere('person_last_name_unanalyzed', '=',  $request->searchPeopleName)
            ->orWhere('person_name', '=',  $request->searchPeopleName)
            ->orderBy('person_name', 'ASC')
            ->paginate(15);
        $dataCount =DB::table('lidata')
            ->where('person_first_name_unanalyzed', '=',  $request->searchPeopleName)
            ->orWhere('person_last_name_unanalyzed', '=',  $request->searchPeopleName)
            ->orWhere('person_name', '=',  $request->searchPeopleName)
            ->count();
        return view('userDashboard.people', ['allData' => $this->allData,
            'searchPeopleName' => $request->searchPeopleName, 'count' => $dataCount]);
    }

    public function companyNameSearch(Request $request)
    {
        $credit=Credit::where('userId',Auth::user()->id)->first();
        if($credit->useableCredit == 0 )
            return view('userDashboard.settings.upgrade');
        if($credit->useableCredit >= 1 && $request->searchPeopleName != null && $request->page == null)
            Credit::filterCredit();
        $this->countries = Country::all();
        $this->allDataIds = DownloadedCompanyList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $nameList = Lidata::select('id', 'organization_name')
                                ->whereNotIn('id', explode(',',$getdownloadedIds))
                                ->get();
        
        $organization = array();
        foreach ($nameList as $list)
        {
            $organization[$list->id] = $list->organization_name;
        }
        $organization = array_unique($organization, SORT_REGULAR);

        $organization_id = array();
        foreach ($organization as $i => $value) {
            $organization_id[] = $i;
        }
        $this->allData = Lidata::whereIn('id', explode(',',implode(',',$organization_id)))
                                ->whereNotIn('id', explode(',',$getdownloadedIds))
                                ->where('organization_name', '=',  $request->name)
                                ->paginate(15);
        $dataCount = lidata::whereIn('id', explode(',',implode(',',$organization_id)))
                                    ->whereNotIn('id', explode(',',$getdownloadedIds))
                                    ->where('organization_name', '=',  $request->name)
                                    ->count();
        return view('userDashboard.company', ['allData' => $this->allData, 'name' => $request->name,
        'country' => $this->countries, 'count' => $dataCount]);
    }
    // company controller

    public function company()
    {
        $this->countries = Country::all();
        $this->allDataIds = DownloadedCompanyList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($this->allDataIds as $dataIds)
        {
            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        //$dataCount = count(lidata::all());
        // $this->allData = lidata::whereNotIn('id', explode(',',$getdownloadedIds))
        //     //->orderBy('person_name', 'ASC')
        //     ->paginate(15);

        $nameList = lidata::select('id', 'organization_name')
                                ->whereNotIn('id', explode(',',$getdownloadedIds))
                                ->get();
        
        $organization = array();
        foreach ($nameList as $list)
        {
            $organization[$list->id] = $list->organization_name;
        }
        $organization = array_unique($organization, SORT_REGULAR);

        $organization_id = array();
        foreach ($organization as $i => $value) {
            $organization_id[] = $i;
        }

        //dd(implode(',',$organization_id));
        $this->allData = lidata::whereIn('id', explode(',',implode(',',$organization_id)))
                                ->whereNotIn('id', explode(',',$getdownloadedIds))
                                ->simplePaginate(15);
        $dataCount = lidata::whereIn('id', explode(',',implode(',',$organization_id)))
                                    ->whereNotIn('id', explode(',',$getdownloadedIds))
                                    ->count();
        return view('userDashboard.company', ['allData' => $this->allData, 'country' => $this->countries, 'count' => $dataCount]);
        /*$this->allData = lidata::paginate(15);
        return view('userDashboard.company', ['allData' => $this->allData]);*/
    }

    public function companyDataHistory(Request $request)
    {
        if($request->ajax())
        {
            $credit=Credit::where('userId', Auth::user()->id)->first();
            if ($credit->useableCredit >= 1)
            { 
                Credit::updateUserCreditForOne($request);
                LidataUserModel::updateUseAbleCreditForOne($request, Auth::user()->id);
                DownloadedCompanyList::createForOne($request);
                ExportHistori::newExportHistoriForOne($request);
                CreditHistory::createForOne($request);
                $data = DB::table('lidata')
                    ->where('id', '=', $request->id)
                    ->get();
                echo json_encode($data);
            }

        }
    }

    public function companySearch(Request $request)
    {
        $result = $request->name;
        $this->allData = DB::table('lidata')
            ->where('organization_name', 'like','%'.$result.'%')
            ->paginate(15);
        return view('userDashboard.companySearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }


    public function account()
    {
        $email_verification = UserVerify::where('user_id', Auth::user()->id)->first();
        $this->country = Country::all();
        //dd($email_verification->email);
        if (is_null($email_verification))
        {
            return view('userDashboard.settings.account', ['countries'=> $this->country]);
        }
        else
        {
            return view('userDashboard.settings.account',['countries'=> $this->country,'messages' => 'Pending confirmation to change email to '.$email_verification->email]);
        }
    }

    public function managePlan()
    {
        //  return (Auth::user()->id);
        $data = PurchasePlan::where('userId', Auth::user()->id)->get();

        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $items[0] = $data->last()->plan;
        $items[1] = $this->credit->useableCredit;
        $items[2] = $this->credit->useableCredit;
        // return $items[2] ;
        $items[3] = $data->last()->price;

        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[4] = $monthName; $items[5] = $year; $items[6] = $day;
        //$date2 = Carbon::createFromFormat('Y-m-d', $data->last()->end);
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[7] = $monthName2; $items[8] = $day2; $items[9] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[10] = 0;
        $items[11] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[10]= $items[10]+$credithistory->usedCredit;
        }

        return view('userDashboard.settings.plans.managePlan', ['userPurchasePlan' => $items]);
    }


    public function billing(Request $request)
    {
        $data = Card::where('userId', Auth::user()->id)->get();
        $invoice = InvoiceHistory::where('userId', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(2);
        if( $invoice!= null )
        {
            return view('userDashboard.settings.plans.billing', ['userCardInfo' => $data, 'invoices'=> $invoice]);
        }
        return view('userDashboard.settings.plans.billing', ['userCardInfo' => $data]);
    }

    public function billingRequest($id)
    {
        $plan = SetPurchasePlan::find($id);
        $data = Card::where('userId', Auth::user()->id)->get();
        $invoice = InvoiceHistory::where('userId', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(2);
        if( $invoice!= null )
        {
            return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$plan, 'invoices'=>$invoice]);
        }
        return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$plan]);
    }
    public function reDownloadInvoice($file)
    {
        $data = InvoiceHistory::where('invoiceId',$file)->first();
        return response()->download('storage/app/'. $data->pdf,'invoice.pdf');

    }




    public function exports()
    {
        $data = ExportHistori::where('userId',Auth::user()->id)->orderBy('createdOn', 'desc')->simplePaginate(6);
        return view('userDashboard.settings.imports&exports.exports', ['exportHistory' => $data]);
    }

    public function customCsvSettings(Request $request)
    {
        ContactsCSVExportSettings::customization($request);
        $data = ContactsCSVExportSettings::where('userId', Auth::user()->id)->first();
        $account_data = AccountsCSVExportSettings::where('userId', Auth::user()->id)->first();
        return view('userDashboard.settings.imports&exports.csv-export-settings', ['csvSettings'=> $data->column, 'accountsCSVSettings'=> $account_data->column]);
    }

    public function customAccountCsvSettings(Request $request)
    {
        AccountsCSVExportSettings::customization($request);
        $data = ContactsCSVExportSettings::where('userId', Auth::user()->id)->first();
        $account_data = AccountsCSVExportSettings::where('userId', Auth::user()->id)->first();
        return view('userDashboard.settings.imports&exports.csv-export-settings', ['csvSettings'=> $data->column, 'accountsCSVSettings'=> $account_data->column]);
    }

    public function reDownloadFile($file_name)
    {
        $data = ExportHistori::find($file_name);
        return response()->download('storage/app/'. $data->file,'lidata.xlsx');

    }
    public function csvExportSettings()
    {
        $data = ContactsCSVExportSettings::where('userId', Auth::user()->id)->first();
        $account_data = AccountsCSVExportSettings::where('userId', Auth::user()->id)->first();
        return view('userDashboard.settings.imports&exports.csv-export-settings', ['csvSettings'=> $data->column, 'accountsCSVSettings'=> $account_data->column]);
    }
   
    public function current()
    {
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }

        return view('userDashboard.settings.credits.current', ['userPurchasePlan' => $items]);
    }
    public function history()
    {
        //$this->creditHistory = ExportHistori::where('userId', Auth::user()->id)->get();
        //dd($this->creditHistory);
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }
        return view('userDashboard.settings.credits.history', ['userPurchasePlan' => $items]);
    }

    public function accounts()
    {
        return view('userDashboard.settings.imports&exports.accounts');
    }
    public function contacts()
    {
        return view('userDashboard.settings.imports&exports.contacts');
    }
    public function contactimport(Request $Request){
        Excel::contactimport(new ContactImport,$Request->file);
        return "Record are imported successfully!";
    }

    public function historyDate(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = DB::table('credit_histories')
                    ->whereBetween('date', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('credit_histories')->orderBy('date', 'desc')->get();
            }
            echo json_encode($data);
        }
    }

    public function upgradeUser()
    {
        $this->package = SetPurchasePlan::all();
        return view('userDashboard.settings.upgrade', [ 'packages' => $this->package ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
