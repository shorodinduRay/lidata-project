<?php

namespace App\Http\Controllers\Payment;

use Stripe;
use Exception;
use Stripe\Token;
use Carbon\Carbon;
use App\Models\Card;
use App\Models\Credit;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use App\Models\InvoiceHistory;
use App\Models\LidataUserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Stripe\Invoice;
use Victorybiz\LaravelCryptoPaymentGateway\LaravelCryptoPaymentGateway;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        return LaravelCryptoPaymentGateway::callback();
    }

    protected $newUser;
    protected static $user;
    protected static $card;
    protected static $invoiceNum;
    protected static $plan;
    /*
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function stripe()
    {
        return view('stripe');
    }*/

    /**
     * success response method.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function stripeAccess(Request $request)
    {
        $data = Card::where('userId', Auth::user()->id)->first();
        if($data)
        {
            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripeToken = Token::create(array(
                    "card" => array(
                        "number"    =>$data->creditCardNumber,
                        "exp_month" =>intval(str_before($data->expirationDate, '/')),
                        "exp_year"  =>intval(str_after($data->expirationDate, '/')),
                        "cvc"       => $data->cvc,
                        "name"      => $data->firstName . " " . $data->lastName
                    )
                ));

                Stripe\Charge::create ([
                    "amount" => ($request->price) * 100,
                    "currency" => "usd",
                    "source" => $stripeToken,
                    "description" => "This payment is tested purpose phpcodingstuff.com"
                ]);

                PurchasePlan::createNewOne($request);
                Credit::updateCredit($request);
                LidataUserModel::updatePlanAndCredit($request);


                $invoice = self::invoice($request);
                


                Session::flash('success', 'Payment successful!');
                return redirect('/settings/plans');

            }catch (Exception $e){
                dd($e);
                return redirect('/settings/billing')->with('message', $e->getMessage());
            }

        }
        else
        {
            $data = Card::where('userId', Auth::user()->id)->get();
            return view('userDashboard.settings.plans.billing',['userCardInfo' => $data,'amount'=>$request]);
        }

    }
    public function payNow(Request $request)
    {
        $description = $request->dataFilter . ' ' . $request->phoneNumber . ' phone numbers.';
        $price = $request->price;

        $user = Auth::user();
        $callbackUrl = $this->getCallbackurl($price);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-sandbox.nowpayments.io/v1/payment',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "price_amount": ' . $price . ',
            "price_currency": "usd",
            "pay_currency": "btc",
            "ipn_callback_url": "' . $callbackUrl . '",
            "order_id": "RGDBP-21314",
            "order_description": "' . $description . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: HKA2W76-QJ44HDE-K1SHGSP-00FENBS',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        self::$plan = PurchasePlan::createNewOne($request);
        Credit::updateCreditByBTC($request);
        LidataUserModel::updatePlanAndCreditByBTC($request);
        $invoice = self::invoice($request);

        $response = json_decode($response);

        

        //TODO store response in database....
        //dd($response);
        return view('userDashboard.settings.plans.payment-success');

        // dd($response);
        //return Redirect::to($response->ipn_callback_url);
    }

    private function getCallbackurl($price)
    {
        if ($price == 100) {
            return "https://sandbox.nowpayments.io/payment/?iid=4323803483";
        } elseif ($price == 190) {
            return "https://sandbox.nowpayments.io/payment/?iid=5297634833";
        } elseif ($price == 400) {
            return "https://sandbox.nowpayments.io/payment/?iid=4345302541";
        } elseif ($price == 1000) {
            return "https://sandbox.nowpayments.io/payment/?iid=5039006412";
        } elseif ($price == 1500) {
            return "https://sandbox.nowpayments.io/payment/?iid=5256332987";
        }
    }

    public static function invoice($request)
    {
        self::$user = LidataUserModel::where('id', $request->userId)->get();
        self::$card = Card::where('userId', $request->userId)->first();
        self::$invoiceNum = InvoiceHistory::latest("invoiceId")->first();
        foreach (self::$user as $userInfo){
            $data["name"] = $userInfo->firstName.' '.$userInfo->lastName;
            $data["email"] = $userInfo->email;
            $data["country"]= $userInfo->country;
            $data["date"]= Carbon::now()->toString();
            $data["paidBy"]= $request->paidBy;
            $data["amount"]= $request->price;
            $data["credit"]= $request->credit;
            $data["phoneNumber"]= $request->phoneNumber;
            $data["dataFilter"]= $request->dataFilter;
            $data["csvExport"]= $request->csvExport;


            $data["total"]= $request->price;
        }

        if (self::$card)
        {
            $data["address"]= self::$card->address;
            $data["city"]= self::$card->city;
            $data["state"]= self::$card->state;
        }

        if( self::$invoiceNum == null )
        {
            $data["invoiceNum"] = "1001";
        }
        else{
            $data["invoiceNum"] = (int) self::$invoiceNum->invoiceId + 1;
        }
        
        //$data["plan"] = self::$plan->plan;

        $data["title"] = "From lidata.io";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('myTestMail', $data)->setOptions(['defaultFont' => 'sans-serif']);
        InvoiceHistory::createInvoice($pdf, $request, "stripe");

        Mail::send('myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
        
        // InvoiceHistory::create ([
        //     "userId" => Auth::user()->id,
        //     "paidBy" => "stripe",
        //     "amount" => $request->price,
        //     "pdf" => saveFileForOne($request),
        // ]);
    }

}
