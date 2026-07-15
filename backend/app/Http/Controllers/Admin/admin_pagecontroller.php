<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Adminwallet;
use App\Models\Userdeposit;
use App\Models\Userwithdraw;
use App\Models\kyc_verification;
use App\Models\Signal;
use App\Models\Plan;
use App\Models\Stock;
use App\Models\Vehicle;
use App\Models\InvestmentStock;
use Illuminate\Http\Request;
use App\Models\investmentplan;
use App\Http\Controllers\Controller;

class admin_pagecontroller extends Controller
{
    //
    public function dashboard()
    {

        $userCount = User::where('role', 'user')->count();
        $totalwithdrawal = Userwithdraw::where('status', 'confirmed')->sum('amount');
        $totalDeposit = Userdeposit::where('status', 'confirmed')->sum('amount');
        $pendingDeposit = Userdeposit::where('status', 'pending')->get();
        $pendingwithdrawal = Userwithdraw::where('status', 'pending')->get();
        return view('Adminview.admin_dashboard', compact('userCount', 'totalDeposit', 'totalwithdrawal', 'pendingDeposit', 'pendingwithdrawal'));
    }

    public function manage_user()
    {
        $allUsers = User::where('role', 'user')
            ->orderByDesc('created_at')
            ->get();
        return view('Adminview.manageuser', compact('allUsers'));
    }

    public function pending_kyc()
    {
        $pending_kyc = kyc_verification::where('status', 'unconfirmed')->get();
        return view('Adminview.pending_kyc', compact('pending_kyc'));
    }

    public function pending_deposit()
    {
        $pendingDeposit = Userdeposit::where('status', 'unconfirmed')->get();
        return view('Adminview.pending_deposit', compact('pendingDeposit'));
    }

    public function pending_withdrawal()
    {
        $pendingwithdrawal = Userwithdraw::where('status', 'pending')->get();
        return view('Adminview.pending_withdrawal', compact('pendingwithdrawal'));
    }

    public function ongoing_investment()
    {
        $ongoing_investnment = investmentplan::where('status', 'ongoing')->get();
        return view('Adminview.ongoing_investment', compact('ongoing_investnment'));
    }

    public function manage_website()
    {
        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)

        return view('Adminview.manage_website', [
            'adminWallet' => $adminWallet,
            'btc_address_bitcoin_qr' => $adminWallet->btc_address_bitcoin_qr,
            'btc_address_bep20_qr' => $adminWallet->btc_address_bep20_qr,
            'eth_address_erc20_qr' => $adminWallet->eth_address_erc20_qr,
            'eth_address_bep20_qr' => $adminWallet->eth_address_bep20_qr,
            'usdt_address_trc20_qr' => $adminWallet->usdt_address_trc20_qr,
            'usdt_address_bep20_qr' => $adminWallet->usdt_address_bep20_qr,
            'usdt_address_erc20_qr' => $adminWallet->usdt_address_erc20_qr,
        ]);
    }

    public function modify($id)
    {
        $user = User::findOrFail($id); // Fetch the deposit based on the provided ID
        return view('Adminview.user_modify', compact('user'));
    }

    public function modify_investments($id)
    {
        $investment = investmentplan::findOrFail($id);
        return view('Adminview.investment_modifyupdate', compact('investment'));
    }

    public function all_withdrawal()
    {
        $allwithdrawal = Userwithdraw::get();
        return view('Adminview.all_withdrawal', compact('allwithdrawal'));
    }

    public function all_deposits()
    {
        $alldeposit = Userdeposit::get();
        return view('Adminview.all_deposit', compact('alldeposit'));
    }

    public function modify_withdrawal($id)
    {
        $withdrawal = Userwithdraw::findOrFail($id);
        return view('Adminview.modify_withdrawal', compact('withdrawal'));
    }

    public function manage_investments()
    {
        $allInvestment = investmentplan::orderByDesc('created_at')->get();
        return view('Adminview.manageinvestment', compact('allInvestment'));
    }

    public function add_traders()
    {
        return view('Adminview.addtraders');
    }

    public function plan_settings()
    {
        $plans = Plan::orderBy('created_at', 'desc')->get();
        return view('Adminview.plan_settings', compact('plans'));
    }

    public function manage_signals()
    {
        $signals = Signal::orderBy('created_at', 'desc')->get();
        return view('Adminview.manage_signals', compact('signals'));
    }

    public function upload_cars(){
        $tesla = Vehicle::get();
        return view('Adminview.upload_cars', compact('tesla'));
    }

    public function manage_stocks(){
        $stocks = Stock::orderBy('created_at', 'desc')->get();
        return view('Adminview.manage_stocks', compact('stocks'));
    }

    public function ongoing_investment_stocks(){
        $ongoingStockInv = InvestmentStock::with('stock')
        ->Where('status','ongoing')
        ->orderBy('created_at', 'desc')->get();
        return view('Adminview.ongoing_stocks_inv', compact('ongoingStockInv'));
    }
}
