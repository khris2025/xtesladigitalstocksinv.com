<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Activity;
use App\Models\InvestmentStock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;


class StocksController extends Controller
{
    //
    public function upload_stocks(Request $request){
        $validatedData = $request->validate([
            'stock_name' => 'required|string',
            'amount_share' => 'required|numeric',
            'roi' => 'required|numeric',
            'trading_period' => 'required|integer',
            'stock_img' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $uploadedImage = $request->file('stock_img');
        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('stock_img', $filename, 'public');


        Stock::create([
            'stock_name' => $validatedData['stock_name'],
            'amount_share' => $validatedData['amount_share'],
            'roi' => $validatedData['roi'],
            'trading_period' => $validatedData['trading_period'],
            'stock_logo' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Stocks added successfully.');

        
    }

    public function delete_stocks(Request $request, $id){
        try {
            $stocks = Stock::FindorFail($id);
            $stocks->delete(); // Delete the stock

            return redirect()->back()->with('success', 'stocks deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Failed to delete stocks.']);
        }

    }

    public function stocks_subscribe(Request $request, $id){
        $stocks = Stock::findOrFail($id);
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'amount' => "required|numeric",
        ]);

        $investmentAmount = $request->amount;
        $profit = ($stocks->roi/100) * $investmentAmount;
        $shareBought = $investmentAmount / $stocks->amount_share;


        if ($user->walletbalance < $request->amount) {
            return redirect()->back()->withErrors(['message' => 'Insufficient wallet balance!']);
        }

        // Deduct the investment amount from wallet balance
        $user->walletbalance -= $investmentAmount;
        $user->save();

        // Create a new subscription
        $startDate = Carbon::now();
        InvestmentStock::create([
            'stock_id' => $stocks->id,
            'fullname' => $user->fullname,
            'email' => $user->email,
            'amount' => $investmentAmount,
            'profit' => $profit,
            'shares' => $shareBought,
            'transid' => Str::uuid()->toString(),
            'Withdrawaldate' => Carbon::now()->addDays($stocks->trading_period), // Set withdrawal date
            'dateadd' => $startDate,
        ]);

        Activity::create([
            'email' => $user->email,
            'activity_type' => 'stocks',
            'status' => 'success',
            'amount' => $investmentAmount,
            'profit' => $profit,
            'title' => 'Stocks Bought successful',
        ]);




        return redirect()->back()->with('success', 'stocks purchase successful!');
    }

    public function end_investment_stocks(Request $request, $id){
        $stockinv = InvestmentStock::FindorFail($id);
        $stockinv->status = 'ended';
        $stockinv->save();

        $user = User::where('email', $stockinv->email)->firstOrFail();
        $finalBalance = $stockinv->profit + $stockinv->amount;
        $user->walletbalance += $finalBalance;
        $user->save();

        Activity::create([
            'email' => $user->email,
            'activity_type' => 'stocks',
            'status' => 'ended',
            'amount' => $stockinv->amount,
            'profit' => $stockinv->profit,
            'title' => 'Stocks Profit Payout',
        ]);
        

        return redirect()->back()->with('success', 'stocks investment ended successful!');

    }
}
