<?php

use App\Http\Controllers\UserAuth\ForgotPasswordController;
use App\Http\Controllers\User\Searching\TypeaheadController;
use App\Http\Controllers\User\SocialController;
use App\Http\Controllers\Front\LidataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/add-lidata',[LidataController::class,'addLidata']);
Route::get('/admin-dashboard',[LidataController::class,'importForm']);
Route::post('/import',[LidataController::class,'import'])->name('employee.import');
                 // end update

                //  Start people page Show data & Delete  
Route::get('/lidata',[LidataController::class,'getLidata']);
Route::get('/delete_post/{id}',[LidataController::class,'deletePost'])->name('delete.data');
                //  End people page Show data & Delete 

                // Start Company Page
Route::get('lidata_company',[LidataController::class,'companyLidata']);
Route::get('/delete_lidata/{id}',[LidataController::class,'deletePost_company'])->name('delete.company.data');
                // end Company Page



                // home page


Route::get('/',[
        'uses' => 'App\Http\Controllers\Front\LidataController@index',
        'as' => '/',
        ]);


// route category

Route::get('/company/{id}',[
    'uses' => '\App\Http\Controllers\Front\LidataController@category_company',
    'as'   => 'category-company',
    ]);

Route::get('/people/{id}',[
    'uses' => '\App\Http\Controllers\Front\LidataController@category',
    'as'   => 'category',
    ]);

Route::get('/userSearch',[
    'uses' => '\App\Http\Controllers\Front\LidataController@userSearch',
    'as'   => 'userSearch',
    ]);

Route::get('/company-search',[
    'uses' => '\App\Http\Controllers\Front\LidataController@companySearch',
    'as'   => 'company.search',
    ]);

Route::get('/user/{id}/{name}', [
    'uses' => '\App\Http\Controllers\Front\LidataController@user',
    'as'   => 'user',
    ]);

Route::get('/user-company/{id}/{name}', [
    'uses' => '\App\Http\Controllers\Front\LidataController@company_user',
    'as'   => 'user-company',
        ]);


    // route term of service

    Route::get('/terms-of-service',[
        'uses' => '\App\Http\Controllers\Front\LidataController@termsOfService',
        'as'   => 'terms-of-service',
        ]);

    // route privecy police

Route::get('/privacy-policy',[
    'uses' => '\App\Http\Controllers\Front\LidataController@privacyPolicy',
    'as'   => 'privacy-policy',
    ]);





// route product

Route::get('/product',[
    'uses' => '\App\Http\Controllers\Front\LidataController@product',
    'as'   => 'product',
    ]);




// route refound

Route::get('/refund',[
    'uses' => '\App\Http\Controllers\Front\LidataController@refund',
    'as'   => 'refund',
        ]);





Route::get('/user-register',[
    'uses' => 'App\Http\Controllers\User\UserController@userRegister',
    'as' => 'user.register',
]);
Route::post('/add-new-user',[
    'uses' => 'App\Http\Controllers\User\UserController@newUser',
    'as' => 'add.new.user',
]);
Route::get('/user-login',[
    'uses' => 'App\Http\Controllers\User\UserController@userLogin',
    'as' => 'user.login',
]);
Route::post('/user-login-auth',[
    'uses' => 'App\Http\Controllers\User\UserController@userAuth',
    'as' => 'user.login.auth',
]);
/** terms and services*/
// Route::get('/terms-of-service',[
//     'uses' => 'App\Http\Controllers\User\FooterController@termsAndServices',
//     'as' => 'termsAndServices',
// ]);
/** privacy policy*/
// Route::get('/privacy_policy',[
//     'uses' => 'App\Http\Controllers\User\FooterController@privacyPolicy',
//     'as' => 'privacyPolicy',
// ]);
/** refund policy*/
// Route::get('/refund',[
//     'uses' => 'App\Http\Controllers\User\FooterController@refund',
//     'as' => 'refund',
// ]);





/** Google OAuth routes */
Route::get('/auth/google',[
    'uses' => 'App\Http\Controllers\User\GoogleController@handleGoogleRedirect',
    'as' => '/auth/google',
]);
Route::get('auth/google/callback',[
    'uses' => 'App\Http\Controllers\User\GoogleController@handleGoogleCallback',
    'as' => 'auth/google/callback',
]);
Route::post('google/new/user',[
    'uses' => 'App\Http\Controllers\User\GoogleController@googleNewUser',
    'as' => 'google.new.user',
]);
// Route::get('/loginWithGoogle{id}',[
//     'uses' => 'App\Http\Controllers\User\GoogleController@handleGoogleCallbackRegister',
//     'as' => '/loginWithGoogle',
// ]);

/** Email OAuth routes */
Route::post('/user/email/callback',[
    'uses' => 'App\Http\Controllers\User\EmailController@handleEmailCallback',
    'as' => '/user/email/callback',
]);


/** Facebook OAuth routes */
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

/** search routes */
Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
Route::get('/autocomplete-company-search', [TypeaheadController::class, 'autocompletecompanySearch']);


// Route::get('searchPeople{id}',[
//     'uses' => 'App\Http\Controllers\User\Searching\TypeaheadController@searchPeople',
//     'as'   => 'searchPeople',
// ]);

            //import-export Admin Dashboard


// Route::get('/welcome',[
//     'uses' => 'App\Http\Controllers\PublicController@index',
//     'as' => 'public.Dashboard',
// ]);
// Route::get('/file-import-export', [
//     'uses' => '\App\Http\Controllers\AdminController@fileImportExport',
//     'as' => 'file-import-export'
//     ]);
 Route::post('/file-import', [
     'uses' => '\App\Http\Controllers\AdminController@fileImport',
    'as' => 'file-import'
 ]);
Route::get('/file-export', [
    'uses' => '\App\Http\Controllers\AdminController@fileExport',
    'as' => 'file-export'
]);
// Route::get('/customExport', [
//     'uses' => '\App\Http\Controllers\AdminController@customExport',
//     'as' => 'customExport'
// ]);
Route::get('/customExport', [
    'uses' => '\App\Http\Controllers\User\Searching\DataSearch@customExport',
    'as' => 'customExport'
]);
Route::get('/download-data', [
    'uses' => '\App\Http\Controllers\User\Searching\DataSearch@downloadData',
    'as' => 'download-data'
]);

Route::get('/custom-company-export', [
    'uses' => '\App\Http\Controllers\User\Searching\CompanySearch@customExport',
    'as' => 'custom.company.export'
]);
Route::get('/download-company-data', [
    'uses' => '\App\Http\Controllers\User\Searching\CompanySearch@downloadData',
    'as' => 'download.company.data'
]);

Route::get('/cumpanyExport', [
    'uses' => '\App\Http\Controllers\AdminController@cumpanyExport',
    'as' => 'cumpanyExport'
]);

Route::get('/selected-file-export{id}', [
    'uses' => '\App\Http\Controllers\AdminController@selectedfileExport',
    'as' => 'selected-file-export'
]);

// Route::get('/convert-to-json', function () {
//     return App\Models\PhoneList::paginate(5);
// });


            



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//

Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');
// Route::get('admin/home', '\App\Http\Controllers\HomeController@handleAdmin')->name('admin.route')->middleware('admin');



/** reset password */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

/**verify email and reset password */
Route::get('reset-email/{token}', [ForgotPasswordController::class, 'showResetEmailPasswordForm'])->name('reset.email.get');
Route::post('reset-email', [ForgotPasswordController::class, 'submitResetEmailPasswordForm'])->name('reset.email.post');

/** product page */
// Route::get('/product',[
//     'uses' => '\App\Http\Controllers\Product\ProductController@product',
//     'as'   => 'product',
// ]);
/** packages page */
Route::get('/pricing/packages',[
    'uses' => '\App\Http\Controllers\Packages\PackagesController@packages',
    'as'   => 'packages',
]);
/** careers page */
 Route::get('/career',[
     'uses' => '\App\Http\Controllers\Careers\CareersController@careers',
     'as'   => 'career',
 ]);

/** contact  page */

Route::get('/contact',[
    'uses' => '\App\Http\Controllers\Contact\ContactController@contact',
    'as'   => 'contact',
]);

/** contact form */
Route::post('/contact/form', [\App\Http\Controllers\Contact\ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');

/** about us page */
Route::get('/aboutUS',[
     'uses' => '\App\Http\Controllers\Contact\ContactController@aboutUS',
     'as'   => 'about',
 ]);


/** user Dashboard */
Route::group(['middleware' => ['auth:sanctum', 'verified', 'is_verify_email']], function (){


    Route::get('loggedInUser',[
        'uses' => '\App\Http\Controllers\User\UserController@dashboard',
        'as'   => 'loggedInUser',
    ]);

    Route::get('people',[
        'uses' => '\App\Http\Controllers\User\UserController@people',
        'as'   => 'people',
    ]);


    Route::post('/people/fetch_data', '\App\Http\Controllers\User\UserController@peopleDataHistory')->name('peopleDataHistory');

    //searching people


  /*  Route::get('peopleSearch',[
        'uses' => '\App\Http\Controllers\User\UserController@peopleSearch',
        'as'   => 'peopleSearch',
    ]);*/
    Route::get('people-search',[
        'uses' => '\App\Http\Controllers\User\Searching\Combination@peopleSearchCombination',
        'as'   => 'people.search.combination',
    ]);

    Route::get('people-name-search',[
        'uses' => '\App\Http\Controllers\User\UserController@nameSearch',
        'as'   => 'people.search',
    ]);

    Route::get('company-name-search',[
        'uses' => '\App\Http\Controllers\User\UserController@companyNameSearch',
        'as'   => 'company.name.search',
    ]);


    // route company

    Route::get('company',[
        'uses' => '\App\Http\Controllers\User\UserController@company',
        'as'   => 'company',
    ]);

    Route::post('/company/fetch_data', '\App\Http\Controllers\User\UserController@companyDataHistory')->name('companyDataHistory');

    Route::get('company-search-combination',[
        'uses' => '\App\Http\Controllers\User\Searching\Company@companySearchCombination',
        'as'   => 'company.search.combination',
    ]);


    Route::get('/settings/account',[
        'uses' => '\App\Http\Controllers\User\UserController@account',
        'as'   => 'account',
    ]);
    Route::get('/settings/plans',[
        'uses' => '\App\Http\Controllers\User\UserController@managePlan',
        'as'   => 'managePlan',
    ]);
    Route::get('/settings/billing',[
        'uses' => '\App\Http\Controllers\User\UserController@billing',
        'as'   => 'billing',
    ]);
    Route::get('/settings/billing/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@billingRequest',
        'as'   => 'billingRequest',
    ]);
    



    //custom csv Export
    Route::post('custom-csv-settings',[
        'uses' => '\App\Http\Controllers\User\UserController@customCsvSettings',
        'as'   => 'custom.csv.settings',
    ]);
    Route::post('custom-account-csv-settings',[
        'uses' => '\App\Http\Controllers\User\UserController@customAccountCsvSettings',
        'as'   => 'custom.account.csv.settings',
    ]);

    // start custom export and import in User Dashboarrd


    Route::get('/settings/exports',[
        'uses' => '\App\Http\Controllers\User\UserController@exports',
        'as'   => 'exports',
    ]);
    Route::get('/settings/csv-export-settings',[
        'uses' => '\App\Http\Controllers\User\UserController@csvExportSettings',
        'as'   => 'csv-export-settings',
    ]);
    Route::get('reDownloadFile/{file_name}', [
        'uses' => '\App\Http\Controllers\User\UserController@reDownloadFile',
        'as' => 'reDownloadFile'
    ]);

    Route::get('/settings/accounts',[
        'uses' => '\App\Http\Controllers\User\UserController@accounts',
        'as'   => 'accounts',
    ]);
    Route::get('/settings/contacts',[
        'uses' => '\App\Http\Controllers\User\UserController@contacts',
        'as'   => 'contacts',
    ]);
    Route::post('/contactimport',[LidataController::class,'contactimport'])->name('employee.contactimport');


    // end custom export in User Dashboard



    // start Update User Info
    Route::post('/settings/updateUserFirstName/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserFirstName',
        'as'   => 'updateUserFirstName',
    ]);
    Route::post('/settings/updateUserLastName/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserLastName',
        'as'   => 'updateUserLastName',
    ]);
    Route::post('/settings/updateUserTitle',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserTitle',
        'as'   => 'updateUserTitle',
    ]);
    Route::post('/settings/updateUserPhone/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserPhone',
        'as'   => 'updateUserPhone',
    ]);
    Route::post('/settings/updateUserAddress',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserAddress',
        'as'   => 'updateUserAddress',
    ]);
    Route::get('/settings/updateUserCountry/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserCountry',
        'as'   => 'updateUserCountry',
    ]);
    Route::post('/settings/updateUserEmail/{id}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserEmail',
        'as'   => 'updateUserEmail',
    ]);

    Route::get('/settings/updateUserInfo/{array}',[
        'uses' => '\App\Http\Controllers\User\UserController@updateUserInfo',
        'as'   => 'updateUserInfo',
    ]);
    // end Update User Info


    Route::get('/settings/credits/current',[
        'uses' => '\App\Http\Controllers\User\UserController@current',
        'as'   => 'current',
    ]);
    Route::get('/settings/credits/history',[
        'uses' => '\App\Http\Controllers\User\UserController@history',
        'as'   => 'history',
    ]);
    Route::post('/daterange/fetch_data', '\App\Http\Controllers\User\UserController@historyDate')->name('historyDate');

    Route::get('/settings/upgrade',[
        'uses' => '\App\Http\Controllers\User\UserController@upgradeUser',
        'as'   => 'upgrade',
    ]);
    //add Card Info
    Route::post('addCardInfo',[
        'uses' => '\App\Http\Controllers\User\UserController@addCardInfo',
        'as'   => 'addCardInfo',
    ]);
    Route::post('updateCardInfo',[
        'uses' => '\App\Http\Controllers\User\UserController@updateCardInfo',
        'as'   => 'updateCardInfo',
    ]);
    Route::get('removeCard',[
        'uses' => '\App\Http\Controllers\User\UserController@removeCard',
        'as'   => 'removeCard',
    ]);


});

Route::get('re-download-invoice/{file}', [
    'uses' => '\App\Http\Controllers\User\UserController@reDownloadInvoice',
    'as' => 're.download.invoice'
]);

Route::get('email/verify/{token}', [\App\Http\Controllers\User\UserController::class, 'verifyEmail'])->name('email.verify'); 
Route::get('account/verify/{token}', [\App\Http\Controllers\User\UserController::class, 'verifyAccount'])->name('user.verify');

Route::post('/settings/updateUserPassword/{id}',[
    'uses' => '\App\Http\Controllers\User\UserController@updateUserPassword',
    'as'   => 'updateUserPassword',
]);

Route::get('userLogout',[
    'uses' => '\App\Http\Controllers\User\UserController@logout',
    'as'   => 'userLogout',
]);

//stripe payment

//Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe',[
    'uses' => '\App\Http\Controllers\Payment\PaymentController@stripeAccess',
    'as'   => 'stripe',
]);

// routes/web.php

// You can protect the 'payments.crypto.pay' route with `auth` middleware to allow access by only authenticated user
Route::match(['get', 'post'], '/payments/crypto/pay', Victorybiz\LaravelCryptoPaymentGateway\Http\Controllers\CryptoPaymentController::class)
    ->name('payments.crypto.pay');

// You you need to create your own callback controller and define the route below
// The callback route should be a publicly accessible route with no auth
// However, you may also exclude the route from CSRF Protection by adding their URIs to the $except property of the VerifyCsrfToken middleware.
Route::post('/payments/crypto/callback', [App\Http\Controllers\Payment\PaymentController::class, 'callback'])
    ->withoutMiddleware(['web', 'auth']);
Route::post('/crypto/pay-now', [App\Http\Controllers\Payment\PaymentController::class, 'payNow'])->name('crypto.now-pay')
->withoutMiddleware(['web', 'auth']);


/** Sitemap routes........ */
Route::get('/sitemap-files', [
    'uses' => 'App\Http\Controllers\SitemapController@sitemapFileList',
    'as'   => 'sitemap-file-list',
]);
Route::get('/file-details/{file_name}', [
    'uses' => 'App\Http\Controllers\SitemapController@sitemapFileDetails',
    'as'   => 'sitemap-file-details',
]);
Route::get('/generate-site-map', '\App\Http\Controllers\SitemapController@generateSiteMap')->name('sitemap.generate');


/** Admin Panel --------------------------- */
Route::prefix('admin')->group(function() {
    Route::get('/login','\App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', '\App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');


    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', '\App\Http\Controllers\Auth\AdminController@index')->name('admin.dashboard');

        //view all
        Route::get('/view-all', '\App\Http\Controllers\AdminController@manageData')->name('view.all');
        Route::get('/view-all-company', '\App\Http\Controllers\AdminController@manageCompanyData')->name('view.all.company');
        Route::post('/edit-lidata-data', '\App\Http\Controllers\AdminController@editLiData')->name('edit.lidata.data');
        Route::get('/people-search-by-admin', '\App\Http\Controllers\AdminController@peopleSearch')->name('people.search.by.admin');


        //user details
        Route::get('/view-all-user', '\App\Http\Controllers\AdminController@manageUser')->name('view.all.user');
        Route::get('/delete-user-data/{id}', '\App\Http\Controllers\AdminController@deleteUserData')->name('delete.user.data');
     
        //add new user
        Route::get('/add-new-user-by-admin', '\App\Http\Controllers\AdminController@addNewUser')->name('add.new.user.by.admin');
        Route::post('/add-new-user-by-admin', '\App\Http\Controllers\AdminController@addNewUserByAdmin')->name('add.new.user.by.admin');
        Route::get('/credit-transfer', '\App\Http\Controllers\AdminController@creditTransfer')->name('transfer.user.credit');
        Route::post('/reset/user/password', '\App\Http\Controllers\AdminController@resetUserPassword')->name('reset.user.password');

        //user data import
        Route::get('/user-data-import', '\App\Http\Controllers\AdminController@user_data_import')->name('user.data.import');

        //order history
        Route::get('/user-order-history', '\App\Http\Controllers\AdminController@user_order_history')->name('user.order.history');
        Route::get('invoice-search-by-admin', '\App\Http\Controllers\AdminController@invoiceSearch')->name('invoice.search.by.admin');

        //credit history
        Route::get('/user-credit-history', '\App\Http\Controllers\AdminController@user_credit_history')->name('user.credit.history');
        Route::get('invoice-search-by-credit', '\App\Http\Controllers\AdminController@creditSearch')->name('invoice.search.by.credit');

        

        //update user credit/plan
        Route::post('/update-user-credit', '\App\Http\Controllers\AdminController@updateUserCredit')->name('update.user.credit');
        Route::get('/update-user-plan/{planId}/{id}', '\App\Http\Controllers\AdminController@updatePlan')->name('update.user.plan');

        //payment settings
        Route::get('/user-payment-settings', '\App\Http\Controllers\AdminController@user_payment_settings')->name('user.payment.settings');

        Route::get('/generate-site-map', '\App\Http\Controllers\AdminController@generateSiteMap')->name('sitemap.generate');
   });


}) ; 