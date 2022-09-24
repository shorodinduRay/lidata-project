<?php

namespace App\Http\Controllers;
use File;
use App\Models\Card;
use App\Models\Credit;
use App\Models\Lidata;
use App\Models\Country;
use App\Models\PhoneList;
use Spatie\Sitemap\Sitemap;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use App\Exports\CustomExport;
use App\Imports\LidataImport;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\DownloadedList;

use App\Models\InvoiceHistory;
use App\Models\LidataUserModel;
use App\Models\SetPurchasePlan;
use App\Exports\PhoneListExport;
use App\Imports\PhoneListImport;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Sitemap\SitemapGenerator;
use App\Models\DownloadedCompanyList;
use Illuminate\Support\Facades\Response;
use App\Models\AccountsCSVExportSettings;
use App\Models\ContactsCSVExportSettings;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    protected $data;
    protected $allData;
    protected $credit;
    protected $plan;
    protected $purchasePlan;
    protected $user;
    protected static $phoneList;
    protected static $invoices;
    protected static $credits_used;
    protected static $countRow;
    protected static $total_credit;
    protected static $total_credit_by_card;
    protected static $total_credit_by_crypto;


    // view admin Dashboard

    public function index()
    {
        return view('admin.dashboard');
    }

    //  admin Dashboard file upload



    public function fileImportExport()
    {
        //return view('file-import');
    }




    public function fileImport(Request $request)
    {
        Excel::import(new LidataImport(), $request->file('file')->store('temp'));
        return back()->with('message', 'file imported Successfully');
    }





    public function fileExport()
    {
        return Excel::download(new PhoneListExport, 'phoneList-collection.xlsx');
    }



    public function customExport(Request $request)
    {

        $credit=Credit::where('userId', Auth::user()->id)->first();
        $allDataIds = DownloadedList::where('userId', Auth::user()->id)->get();
        $getdownloadedIds = 0;
        foreach ($allDataIds as $dataIds)
        {

            $getdownloadedIds = $getdownloadedIds.','.$dataIds->downloadedIds;
        }
        $preDownloaded = count($request->chk) - (count(array_intersect($request->chk, explode(',',$getdownloadedIds ))));

        if ($credit->useableCredit >= $preDownloaded)
        {
            Credit::updateUserCradit($request);
            ExportHistori::newExportHistori($request);
            DownloadedList::createNew($request);
            CreditHistory::create($request);
            LidataUserModel::updateUseAbleCredit($request);

            return (new CustomExport($request->chk))->download('lidata.xlsx');
        }
        else
        {
            return redirect('/settings/upgrade');
        }
    }


    public function cumpanyExport(Request $request)
    {
        return (new CustomExport($request->chk))->download('phoneList.xlsx');
    }




    //  admin Dashboard view all data // data edit update delete


    public function manageData(){
        $this->allData = Lidata::paginate(10);
        $rowCount = Lidata::count();
        return view('admin.manage-data', ['allData' => $this->allData, 'rowcount' => $rowCount]);
    }
    public function manageCompanyData(){
        $this->allData = Lidata::paginate(10);
        $rowCount = Lidata::count();
        return view('admin.manage-company-data', ['allData' => $this->allData, 'rowcount' => $rowCount]);
    }

    /*public function getData(){
        $employees = Employee::
        return view('home', compact('employees'));
    }*/
    public function editData($id){
        $this->data = PhoneList::find($id);
        //return view('admin.edit-data', ['data'=>$this->data]);
    }
    public function editLiData(Request $request)
    {
        Lidata::updateLiData($request);
        $this->allData = Lidata::paginate(10);
        return redirect(route('view.all'))->with('message', 'Successfully updated data!');
    }
    public function peopleSearch(Request $request)
    {
        //dd($request->search);
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $this->allData = DB::table('lidata')
                            ->where('person_first_name_unanalyzed', '=',  $result)
                            ->orWhere('person_last_name_unanalyzed', '=',  $result)
                            ->orWhere('person_name', '=',  $result)
                            ->orWhere('person_email', '=',  $result)
                            ->orWhere('person_sanitized_phone', '=',  $result)
                            ->orderBy('person_name', 'ASC')
                            ->paginate(15);
        $rowCount = DB::table('lidata')
                        ->where('person_first_name_unanalyzed', '=',  $result)
                        ->orWhere('person_last_name_unanalyzed', '=',  $result)
                        ->orWhere('person_name', '=',  $result)
                        ->orWhere('person_email', '=',  $result)
                        ->orWhere('person_sanitized_phone', '=',  $result)
                        ->count();
            
        if($this->allData->isEmpty())
        {
            return view('admin.manage-data', ['allDataName' => $this->allData, 
                            'res' => $result, 'rowcount' => $rowCount, 'notFound' => "No Data Found"]);
        }
        return view('admin.manage-data', ['allDataName' => $this->allData, 'res' => $result, 'rowcount' => $rowCount]);
    }
    public function manageUser()
    {
        //dd('hello');
        $this->allData = LidataUserModel::paginate(10);
        return view('admin.manage-user', ['allData' => $this->allData]);
    }


    // public function updateData(Request $request){
    //     data::updatedata($request);
    //     return redirect('/manage-data')->with('message', 'data Updated Successfully');
    // }
    public function deleteUserData($id)
    {
        $this->data = LidataUserModel::find($id);
        $this->data->delete();
        /*$this->data = Card::where('userId',$id)->first();
        if($this->data != null)
            $this->data->delete();
        
        $this->data = Credit::where('userId',$id)->first();
        $this->data->delete();
        CreditHistory::deleteUser($id);
        //$this->data = CSVExportSettings::where('userId',$id)->first();
        $this->data->delete();
        DownloadedList::deleteUser($id);
        DownloadedCompanyList::deleteUser($id);
        ExportHistori::deleteUser($id);
        PurchasePlan::deleteUser($id);*/
        return redirect(route('view.all.user'))->with('message', 'Successfully deleted data!');
    }

    public function addNewUser()
    {
        $this->countries = Country::all();
        return view('admin.newUser', ['country' => $this->countries]);
    }

    public function addNewUserByAdmin(Request $request)
    {
        $this->countries = Country::all();
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:lidata_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required|min:11|numeric|unique:lidata_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            //return redirect()->route('admin.login')->with('message', 'Email and/or password do not match with any of our records.'); 
            view('admin.newUser', ['country' => $this->countries, 'message' => 'The email or phone number has already been taken!']);
            //return redirect()->back()->with('message', 'The email or phone number has already been taken')->with(['country' => $this->countries]);
        } else {
            $check = $this->create($data);
            //$newUser = LidataUserModel::where('email', $data['email'])->first();
            PurchasePlan::createNew($check);
            Credit::create([
                'userId' => $check->id,
                'useableCredit' => 50,
            ]);
            CreditHistory::createNew($check);
            ContactsCSVExportSettings::create($check);
            AccountsCSVExportSettings::create($check);
        }

        //return redirect()->back()->with('message', 'Successfully added user!')->with(['country' => $this->countries]);
        return view('admin.newUser', ['country' => $this->countries, 'message' => 'Successfully added user!']);
    }
    public function resetUserPassword(Request $request)
    {
        $this->countries = Country::all();
        $user = LidataUserModel::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return view('admin.newUser', ['country' => $this->countries, 'message' => 'Successfully updated password!']);
    }

    public function create(array $data)
    {
        return LidataUserModel::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'name' => $data['firstName'] . ' ' . $data['lastName'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'purchasePlan' => 'Free',
            'useAbleCredit' => 20,
        ]);
    }

    public function creditTransfer()
    {
        $this->allData = LidataUserModel::paginate(10);
        return view('admin.creditTransfer', ['userData' => $this->allData]);
    }
    public function updatePlan($planId, $id)
    {

        $this->plan = SetPurchasePlan::find($planId);
        Credit::updateCreditByAdmin($this->plan, $id);
        LidataUserModel::updatePlanAndCreditByAdmin($this->plan, $id);

        PurchasePlan::createNewByAdmin($this->plan, $id);




        $this->allData = LidataUserModel::paginate(10);

        return redirect(route('transfer.user.credit'))->with(['userData' => $this->allData]);
    }

    public function user_data_import()
    {
        return view('admin.user_data_import');
    }

    public function user_order_history()
    {
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();
        self::$countRow = self::$invoices->count();

        self::$total_credit = 0;
        self::$total_credit_by_card = 0;
        self::$total_credit_by_crypto = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->amount ;
            if($credits->paidBy == "stripe")
            {
                self::$total_credit_by_card = self::$total_credit_by_card + $credits->amount;
            }
            if($credits->paidBy == "USDD")
            {
                self::$total_credit_by_crypto = self::$total_credit_by_crypto + $credits->amount;
            }
        }

        return view('admin.user_order_history', ['orders'=> self::$invoices->simplePaginate(5), 'total_sales'=> self::$total_credit, 'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 'count'=> self::$countRow ]);
    }
    public function invoiceSearch(Request $request)
    {
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();
        self::$countRow = self::$invoices->count();

        self::$total_credit = 0;
        self::$total_credit_by_card = 0;
        self::$total_credit_by_crypto = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->amount ;
            if($credits->paidBy == "stripe")
            {
                self::$total_credit_by_card = self::$total_credit_by_card + $credits->amount;
            }
            if($credits->paidBy == "USDD")
            {
                self::$total_credit_by_crypto = self::$total_credit_by_crypto + $credits->amount;
            }
        }
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $foundInvoices = DB::table('invoice_histories')
            ->where('invoiceId', '=',  $result)
            ->orderBy('invoiceId', 'DESC')
            ->paginate(5);
            
        if($foundInvoices->isEmpty())
        {
            return view('admin.user_order_history', ['orders'=> $foundInvoices, 'total_sales'=> self::$total_credit, 
            'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 
            'count'=> self::$countRow, 'notFound' => "No Data Found", 'res' => $result,]);
        }
        return view('admin.user_order_history', ['orders'=> $foundInvoices, 'total_sales'=> self::$total_credit, 
        'card_total'=> self::$total_credit_by_card, 'now_pay_total'=>self::$total_credit_by_crypto, 
        'count'=> self::$countRow, 'res' => $result ]);
    }

    public function user_credit_history()
    {
        $days = 7;
        $format = "Y-m-d";
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = '' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '';
        }
        // dd($dateArray);
        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = LidataUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = LidataUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }
        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();

        self::$total_credit = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->credit ;
        }
        return view('admin.user_credit_history', ['dates' => $dateArray, 'customers' => $newCustomerArray,'orders'=> self::$invoices->simplePaginate(5), 'credit_earned'=> self::$total_credit]);
    }
    public function creditSearch(Request $request)
    {
        $days = 7;
        $format = "Y-m-d";
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = '' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '';
        }
        // dd($dateArray);
        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = LidataUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        $newCustomerArray = [];
        foreach ($dateArray as $key => $date) {
            $customer = LidataUserModel::where('date', $date)->count();
            array_push($newCustomerArray, $customer);
        }

        self::$invoices = InvoiceHistory::orderBy('updated_at', 'desc');
        self::$credits_used = self::$invoices->get();

        self::$total_credit = 0;
        foreach(self::$credits_used as $credits)
        {
            self::$total_credit = self::$total_credit + $credits->credit ;
        }
        if ($request->search == null) {
            return redirect()->back()->with('message', 'Search is Empty');
        }
        $result = $request->search;
        $foundInvoices = DB::table('invoice_histories')
            ->where('invoiceId', '=',  $result)
            ->orderBy('invoiceId', 'DESC')
            ->paginate(5);
            
        if($foundInvoices->isEmpty())
        {
            return view('admin.user_credit_history', ['dates' => $dateArray, 'customers' => $newCustomerArray,
            'orders'=> $foundInvoices, 'credit_earned'=> self::$total_credit , 
            'notFound' => "No Data Found", 'res' => $result,]);
        }
        return view('admin.user_credit_history', ['dates' => $dateArray, 'customers' => $newCustomerArray,
        'orders'=> $foundInvoices, 'credit_earned'=> self::$total_credit, 'res' => $result]);
    }


    public function updateUserCredit(Request $request)
    {
        $this->user = LidataUserModel::find($request->id);
        $this->credit = Credit::where('userId', $request->id);
        $this->user->update([
            'useAbleCredit' => $request->useAbleCredit,
        ]);
        $this->credit->update([
            'useableCredit' => $request->useAbleCredit,
        ]);
        return redirect()->back()->with('message', 'Successfully updated credit!');
    }

    public function user_payment_settings()
    {
        return view('admin.user_payment_settings');
    }

    public function generateSiteMap()
    {
        $countries = Country::select('id', 'countryname')->get();
        $sitemap = SitemapGenerator::create('https://lidata.io')->getSitemap();
        foreach ($countries as $key => $country) {
            $sitemap->add(Url::create("/country/{$country->countryname}"));
        }
        $sitemap->add(Url::create("/people/male"));
        $sitemap->add(Url::create("/people/female"));
        $sitemap->writeToFile(public_path('main_sitemap.xml'));


        $phone = Lidata::select('id', 'person_first_name_unanalyzed', 'person_last_name_unanalyzed')->get(); //->take(56000)
        $sitemap = Sitemap::create();
        $count = 0;
        $number = 1;
        foreach ($phone as $key => $value) {
            $sitemap->add(Url::create("/people/{$value->id}/{$value->person_first_name_unanalyzed}-{$value->person_last_name_unanalyzed}"));

            $count += 1;
            if ($count == 10000) {
                $sitemap->writeToFile(public_path('sitemap' . $number . '.xml'));

                $sitemap = Sitemap::create();
                $count = 0;
                $number++;
            }
        }
        $sitemap->writeToFile(public_path('sitemap_last_data.xml'));

        return redirect()->back()->with('message', 'Sitemap Generated Successfully!');
    }


    // public function generateSiteMap()
    // {
    //     $countries = Country::select('id', 'countryname')->get();
    //     $sitemap = SitemapGenerator::create('https://lidata.io')->getSitemap();
    //     // $sitemap = Sitemap::create();
    //     foreach ($countries as $key => $country) {
    //         $sitemap->add(Url::create("/country/{$country->countryname}"));
    //     }
    //     $sitemap->add(Url::create("/people/male"));
    //     $sitemap->add(Url::create("/people/female"));
    //     $sitemap->writeToFile(public_path('main_sitemap.xml'));


    //     $phone = PhoneList::select('id', 'first_name', 'last_name')->get(); //->take(56000)
    //     $sitemap = Sitemap::create();
    //     $count = 0;
    //     $number = 1;
    //     foreach ($phone as $key => $value) {
    //         $sitemap->add(Url::create("/people/{$value->id}/{$value->first_name}-{$value->last_name}"));

    //         $count += 1;
    //         if ($count == 10000) {
    //             $sitemap->writeToFile(public_path('sitemap' . $number . '.xml'));

    //             $sitemap = Sitemap::create();
    //             $count = 0;
    //             $number++;
    //         }
    //     }
    //     $sitemap->writeToFile(public_path('sitemap_last_data.xml'));

    //     return redirect()->back()->with('message', 'Sitemap Generated Successfully!');
    // }

    // public function sitemapFileList()
    // {
    //     $files = File::files(public_path());
    //     date_default_timezone_set("Asia/Dhaka");

    //     $fileName = [];
    //     foreach ($files as $key => $file) {
    //         $full_name = $file->getFileName();
    //         $lastModified = date("Y-m-d H:i A", filemtime($file));

    //         $name = explode('.', $full_name);
    //         if (isset($name[1]) && $name[1] == 'xml') {
    //             $single_file = [
    //                 'name' => $full_name,
    //                 'modified' => $lastModified,
    //             ];

    //             array_push($fileName, $single_file);
    //         }
    //     }
    //     return view('sitemap.file-list', ['files' => $fileName]);
    // }

    // public function sitemapFileDetails($file_name)
    // {
    //     date_default_timezone_set("Asia/Dhaka");
    //     $xmlDataString = file_get_contents(public_path($file_name));
    //     $xmlObject = simplexml_load_string($xmlDataString);

    //     $json = json_encode($xmlObject);
    //     $xmlFileArray = json_decode($json, true);

    //     // echo "<pre>"; 
    //     // print_r($xmlFileArray);
    //     // exit();

    //     return view('sitemap.file-details', ['fileData' => $xmlFileArray, 'file_name' => $file_name]);
    // }
}
