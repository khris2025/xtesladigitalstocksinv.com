<?php

use App\Http\Controllers\Homepage;

use App\Http\Controllers\User\kyc_user;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\admin_action;
use App\Http\Controllers\User\wfee_payments;
use App\Http\Controllers\User\Userwithdrawal;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\joinplancontroller;
use App\Http\Controllers\Admin\adminpagecontroller;
use App\Http\Controllers\Admin\admin_pagecontroller;
use App\Http\Controllers\User\UserDepositController;
use App\Http\Controllers\User\StocksController;
use App\Http\Controllers\User\UserloggedinController;
use App\Http\Controllers\Admin\SignalController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\User\MembershipController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [Homepage::class, 'Homepage'])->name('Homepage');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'create'])->name('registerUser');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginUser');
Route::get('/otp', [OtpController::class, 'otp'])->name('otp.form');
// OTP verification (POST request)
Route::post('verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
// Route for resending OTP
Route::get('resendOtp', [OtpController::class, 'resendOtp'])->name('resendOtp');



// Forgot Password Form
Route::get('/forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot_password_email', [AuthController::class, 'forgot_password_email'])->name('forgot_password_email');
//confirm token
Route::get('/confirm_password_token{token}', [AuthController::class, 'confirm_password_token'])->name('confirm_password_token');
//Reset The Password
Route::post('/reset_password_user', [AuthController::class, 'reset_password_user'])->name('reset_password_user');
Route::get('/verify_email{token}', [AuthController::class, 'verify_email'])->name('verify_email');





Route::middleware(['auth'])->group(function () {
    // Your protected routes go here

    Route::get('/dashboard', [UserloggedinController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserloggedinController::class, 'profile'])->name('profile');
    Route::get('/copy_trade', [UserloggedinController::class, 'copy_trade'])->name('copy_trade');

    Route::get('/kyc_upload', [UserloggedinController::class, 'kyc_upload'])->name('kyc_upload');
    Route::post('/kyc_upload_id', [kyc_user::class, 'kyc_upload_id'])->name('kyc_upload_id');
    Route::get('/kyc_upload_pay', [kyc_user::class, 'kyc_upload_pay'])->name('kyc_upload_pay');
    Route::post('/kyc_upload_proof', [kyc_user::class, 'kyc_upload_proof'])->name('kyc_upload_proof');

    Route::post('/copy_payment', [UserloggedinController::class, 'copy_payment'])->name('copy_payment');
    Route::get('/portfolio', [UserloggedinController::class, 'portfolio'])->name('portfolio');


    //Add Wallet linking 
    Route::post('wallet_linking', [UserloggedinController::class, 'wallet_linking'])->name('wallet_linking');
    Route::get('wallet_connect', [UserloggedinController::class, 'wallet_connect'])->name('wallet_connect');
    Route::get('purchase_signals', [UserloggedinController::class, 'purchase_signals'])->name('purchase_signals');

    Route::get('signals/create', [SignalController::class, 'create'])->name('signals.create');
    Route::post('signals', [SignalController::class, 'store'])->name('signals.store');
    Route::post('/subscribe/signal/{signal}', [SignalController::class, 'subscribe'])->name('user.subscribe.signal');


    Route::get('/stocks', [UserloggedinController::class, 'stocks'])->name('stocks');
    Route::post('/subscribe_stocks/{stocks}', [StocksController::class, 'stocks_subscribe'])->name('stocks.subscribe');


    Route::get('/tesla', [UserloggedinController::class, 'tesla'])->name('tesla');
    Route::get('/tesla-details/{id}', [UserloggedinController::class, 'tesla_details'])->name('tesla-details');


    Route::get('/member', [UserloggedinController::class, 'member'])->name('member');

    Route::get('/activities', [UserloggedinController::class, 'activities'])->name('activities');


    Route::post('/membership/subscribe', [MembershipController::class, 'subscribe'])->name('membership.subscribe');



















    //add wallet address route
    Route::post('/addwallet', [UserloggedinController::class, 'addwallet'])->name('addwallet');

    Route::get('/Investment', [UserloggedinController::class, 'Investments'])->name('Investments');

    Route::post('/subscribe/plan/{plan}', [PlanController::class, 'subscribe'])->name('user.subscribe.plan');


    Route::post('/submit-investment', [joinplancontroller::class, 'submitInvestment'])->name('submit-investment');

    Route::get('/deposit', [UserloggedinController::class, 'deposit'])->name('deposit');
    //Route to create new user deposit
    Route::post('/Createdepositaction', [DepositController::class, 'deposit'])->name('deposit.store');
    //make payment Route
    Route::get('/makepayment/{id}', [DepositController::class, 'deposit_pay'])->name('makepayment');
    //upload proof route
    Route::post('/makepayment/{id}', [DepositController::class, 'upload_proof'])->name('upload_proof');
    //Route to withdrawal


    //Move profits/Bonus to mainbalance
    Route::post('/addto_balance', [UserloggedinController::class, 'addto_balance'])->name('addto_balance');

    Route::post('/Createwithdrawalaction', [Userwithdrawal::class, 'withdraw'])->name('withdrawal.store');

    //Bank Withdrawal 
    Route::post('/Createwithdrawalaction_bank', [Userwithdrawal::class, 'withdraw_bank'])->name('withdraw_bank');


    Route::get('/withdrawal', [UserloggedinController::class, 'withdrawal'])->name('withdrawal');
    Route::get('/referral', [UserloggedinController::class, 'referral'])->name('referral');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Change Password
    Route::post('/update_password', [AuthController::class, 'update_password'])->name('update_password');

    Route::get('/wfee_payment/{id}', [wfee_payments::class, 'wfee_payment'])->name('wfee_payment');
    Route::post('/wfee_payment_upload/{id}', [wfee_payments::class, 'wfee_payment_upload'])->name('wfee_payment_upload');









    //Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admindashboard', [admin_pagecontroller::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/manage_user', [admin_pagecontroller::class, 'manage_user'])->name('manage_user');
        Route::get('/manage_investments', [admin_pagecontroller::class, 'manage_investments'])->name('manage_investments');
        Route::get('/pending_kyc', [admin_pagecontroller::class, 'pending_kyc'])->name('pending_kyc');
        Route::get('/pending_deposit', [admin_pagecontroller::class, 'pending_deposit'])->name('pending_deposit');
        Route::get('/pending_withdrawal', [admin_pagecontroller::class, 'pending_withdrawal'])->name('pending_withdrawal');
        Route::get('/ongoing_investment', [admin_pagecontroller::class, 'ongoing_investment'])->name('ongoing_investment');
        Route::get('/manage_website', [admin_pagecontroller::class, 'manage_website'])->name('manage_website');

        Route::get('/manage_signals', [admin_pagecontroller::class, 'manage_signals'])->name('manage_signals');
        Route::post('signals/create', [SignalController::class, 'store'])->name('signals.create');



        // upload/chanage wallet Qr as admin
        Route::post('/upload_qr', [admin_action::class, 'upload_qr'])->name('upload_qr');
        Route::post('/update_address', [admin_action::class, 'update_address'])->name('update_address');
        Route::post('/wallet_earn', [admin_action::class, 'wallet_earn'])->name('wallet_earn');

        Route::get('/plan_settings', [admin_pagecontroller::class, 'plan_settings'])->name('plan_settings');
        // Route to store the new plan
        Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
        Route::delete('/plans/{plans}', [PlanController::class, 'destroy'])->name('plans.destroy');


        Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');






        Route::get('/signal_settings', [admin_pagecontroller::class, 'manage_website'])->name('signalsettings');
        Route::delete('/signal/{signal}', [SignalController::class, 'destroy'])->name('signal.destroy');

        Route::get('signals/{signal}/edit', [SignalController::class, 'edit'])->name('signal.edit');
        Route::put('signals/{signal}', [SignalController::class, 'update'])->name('signal.update');







        //modify user route
        Route::get('/modify/{id}', [admin_pagecontroller::class, 'modify'])->name('modify');
        //Update User Profile
        Route::post('/modify_profile/{id}', [admin_action::class, 'modify_profile'])->name('modify_profile');
        Route::get('/modify_profile_buttons/{id}', [admin_action::class, 'modify_profile_buttons'])->name('modify_profile_buttons');

        Route::put('/modify_investmentupdate/{id}', [admin_action::class, 'modify_investmentupdate'])->name('modify_investmentupdate');



        //Deposit Approve/Decline
        Route::get('/deposit_action/{id}', [admin_action::class, 'deposit_action'])->name('deposit_action');

        //Withdrawal Approve/Decline
        Route::get('/withdrawal_action/{id}', [admin_action::class, 'withdrawal_action'])->name('withdrawal_action');

        //End Investnment
        Route::get('/end_investment/{id}', [admin_action::class, 'end_investment'])->name('end_investment');

        //Kyc Action
        Route::get('/kyc_action/{id}', [admin_action::class, 'kyc_action'])->name('kyc_action');

        //All withdrawal
        Route::get('/all_withdrawal', [admin_pagecontroller::class, 'all_withdrawal'])->name('all_withdrawal');

        Route::get('/all_deposits', [admin_pagecontroller::class, 'all_deposits'])->name('all_deposits');

        Route::get('/add_traders', [admin_pagecontroller::class, 'add_traders'])->name('add_traders');

        Route::post('/store_traders', [admin_action::class, 'store_traders'])->name('store_traders');




        //modify withdrawal
        Route::get('/modify_withdrawal/{id}', [admin_pagecontroller::class, 'modify_withdrawal'])->name('modify_withdrawal');
        // Update withdrawal info
        Route::post('/update_withdrawal_options/{id}', [admin_action::class, 'update_withdrawal_options'])->name('update_withdrawal_options');

        Route::get('/delete_deposit/{id}', [admin_action::class, 'delete_deposit'])->name('delete_deposit');

        Route::get('/modify_investments/{id}', [admin_pagecontroller::class, 'modify_investments'])->name('modify_investments');

        //Tesla
        Route::get('/upload_cars', [admin_pagecontroller::class, 'upload_cars'])->name('upload_cars');
        Route::post('/upload_cars_action', [admin_action::class, 'upload_cars_action'])->name('upload_cars_action');
        Route::delete('/delete_car/{car}', [admin_action::class, 'delete_car'])->name('car.destroy');

        //Stocks
        Route::get('/manage_stocks', [admin_pagecontroller::class, 'manage_stocks'])->name('manage_stocks');
        Route::post('/upload_stocks', [StocksController::class, 'upload_stocks'])->name('upload_stocks');
        Route::delete('/delete_stocks/{stocks}', [StocksController::class, 'delete_stocks'])->name('stocks.delete');

        Route::get('/ongoing_investment_stocks', [admin_pagecontroller::class, 'ongoing_investment_stocks'])->name('ongoing_investment_stocks');
        Route::post('/end_investment_stocks/{stocks}', [StocksController::class, 'end_investment_stocks'])->name('end_investment_stocks');



    });






    // ...
});
