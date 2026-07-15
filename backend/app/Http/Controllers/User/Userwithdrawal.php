<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Userwithdraw;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Activity;

class Userwithdrawal extends Controller
{
    //
    public function withdraw(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'wallet_type' => 'required',
            // 'withdrawalwalletaddress' => 'required|string',
        ]);
        $user = Auth::user();
        $wallet_type = $request->wallet_type;
        $amount_to_withdraw = $request->amount;
        $user_wallet_balance = $user->walletbalance;

        if ($wallet_type == 'Bitcoin_bitcoin') {
            $payment_wallet_address = Auth::user()->btc_address_btc;
        }
        // elseif ($wallet_type == 'Bitcoin_bep20') {
        //     $payment_wallet_address = Auth::user()->btc_address_bep20;
        // } 
        elseif ($wallet_type == 'Ethereum_erc20') {
            $payment_wallet_address = Auth::user()->eth_address_erc20;
        } elseif ($wallet_type == 'Ethereum_bep20') {
            $payment_wallet_address = Auth::user()->eth_address_bep20;
        } elseif ($wallet_type == 'USDT_trc20') {
            $payment_wallet_address = Auth::user()->usdt_address_trc20;
        } elseif ($wallet_type == 'USDT_bep20') {
            $payment_wallet_address = Auth::user()->usdt_address_bep20;
        } elseif ($wallet_type == 'USDT_erc20') {
            $payment_wallet_address = Auth::user()->usdt_address_erc20;
        }

        $transactionId = Str::uuid()->toString();
        $currentDate = Carbon::now();

        if (empty(trim($payment_wallet_address))) {
            return redirect()->back()->withErrors(['message' => 'Add your wallet address in your profile page and try again.']);
        }

        if ($amount_to_withdraw > $user_wallet_balance) {
            # code...
            return redirect()->back()->withErrors(['message' => 'Withdrawal amount exceeds your available balance.']);
        }
        $withdrawal_method = 'Crypto';
        $withdraw = new Userwithdraw();
        $withdraw->fullname = Auth::user()->fullname;
        $withdraw->email = Auth::user()->email;
        $withdraw->amount = $validatedData['amount'];
        $withdraw->ptype = $validatedData['wallet_type'];
        $withdraw->walletaddress = $payment_wallet_address;
        $withdraw->transid = $transactionId;
        $withdraw->dateadd = $currentDate;
        $withdraw->method = $withdrawal_method;
        $withdraw->save();

        Activity::create([
            'email' => $user->email,
            'activity_type' => 'withdrawal',
            'status' => 'pending',
            'amount' => $withdraw->amount,
            'title' => 'Withdrawal Requested',
        ]);



        return redirect()->back()->with('success', 'Withdraw request made successfully!');
    }



    public function withdraw_bank(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'bank_name' => 'required|string',
            'iban_number' => 'required|string',
            'bic_number' => 'required|string',
        ]);


        $withdrawal_amount = $request->amount;
        $bank_name = $request->bank_name;
        $iban_number = $request->bic_number;
        $method = 'Bank Withdrawal';
        $transactionId = Str::uuid()->toString();
        $currentDate = Carbon::now();
        $user = Auth::user();
        $user_wallet_balance = $user->walletbalance;

        if ($withdrawal_amount > $user_wallet_balance) {
            # code...
            return redirect()->back()->withErrors(['message' => 'Withdrawal amount exceeds your available balance.']);
        }

        $withdraw = new Userwithdraw();
        $withdraw->fullname = Auth::user()->fullname;
        $withdraw->email = Auth::user()->email;
        $withdraw->amount = $withdrawal_amount;
        $withdraw->ptype = 'Bank';
        $withdraw->walletaddress =  'bank (' . $iban_number . ')';
        $withdraw->transid = $transactionId;
        $withdraw->dateadd = $currentDate;
        $withdraw->method = $method;
        $withdraw->save();

        return redirect()->back()->with('success', 'Withdraw request made successfully!');
    }
}
