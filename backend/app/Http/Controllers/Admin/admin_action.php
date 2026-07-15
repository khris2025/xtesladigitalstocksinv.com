<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Adminwallet;
use App\Models\Userdeposit;
use App\Models\CopyTrader;
use App\Models\Activity;
use App\Models\Userwithdraw;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\investmentplan;
use App\Models\kyc_verification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class admin_action extends Controller
{
    //
    public function upload_qr(Request $request)
    {
        // Validate the uploaded image (you can add more validation rules as needed)
        $validatedData = $request->validate([
            'qr_code' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
        ]);

        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)

        $uploadedImage = $request->file('qr_code');
        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('qr_images', $filename, 'public');

        $formType = $request->input('form_type');
        if ($formType === 'btc_address_bitcoin_qr') {
            // Update BTC QR data in the database
            $adminWallet->btc_address_bitcoin_qr = $filename;
        } elseif ($formType === 'btc_address_bep20_qr') {
            // Update ETH QR data in the database
            $adminWallet->btc_address_bep20_qr = $filename;
        } elseif ($formType === 'eth_address_erc20_qr') {
            // Update ETH QR data in the database
            $adminWallet->eth_address_erc20_qr = $filename;
        } elseif ($formType === 'eth_address_bep20_qr') {
            // Update ETH QR data in the database
            $adminWallet->eth_address_bep20_qr = $filename;
        } elseif ($formType === 'usdt_address_trc20_qr') {
            // Update ETH QR data in the database
            $adminWallet->usdt_address_trc20_qr = $filename;
        } elseif ($formType === 'usdt_address_bep20_qr') {
            // Update ETH QR data in the database
            $adminWallet->usdt_address_bep20_qr = $filename;
        } elseif ($formType === 'usdt_address_erc20_qr') {
            // Update USDT QR data in the database
            $adminWallet->usdt_address_erc20_qr = $filename;
        }

        $adminWallet->save();

        return redirect()
            ->back()
            ->with('success', 'QR Code uploaded successfully.');
    }


    public function update_address(Request $request)
    {
        $validatedData = $request->validate([
            'btc_address_bitcoin' => 'required|string',
            'eth_address_erc20' => 'required|string',
            'eth_address_bep20' => 'required|string',
            'usdt_address_trc20' => 'required|string',
            'usdt_address_bep20' => 'required|string',
            'usdt_address_erc20' => 'required|string',
        ]);

        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)

        // Update the fields with the values from the form
        $adminWallet->btc_address_bitcoin = $request->input('btc_address_bitcoin');
        $adminWallet->eth_address_erc20 = $request->input('eth_address_erc20');
        $adminWallet->eth_address_bep20 = $request->input('eth_address_bep20');
        $adminWallet->usdt_address_trc20 = $request->input('usdt_address_trc20');
        $adminWallet->usdt_address_bep20 = $request->input('usdt_address_bep20');
        $adminWallet->usdt_address_erc20 = $request->input('usdt_address_erc20');

        $adminWallet->save();

        return redirect()
            ->back()
            ->with('success', 'Addresses updated successfully.');
    }

    public function modify_profile(Request $request, $id)
    {
        $validatedData = $request->validate([




            'walletaddress' => 'sometimes|required|numeric',
            'investedamount' => 'sometimes|required|numeric',
            'profits' => 'sometimes|required|numeric',
            'refbonus' => 'sometimes|required|numeric',
            'kyc_amount' => 'sometimes|required|numeric',
            'signal' => 'sometimes|required|numeric',
            'msg_alert' => 'sometimes|required|string',
        ]);



        $user = User::findOrFail($id); // Fetch the user based on the provided ID
        $formType = $request->input('form_type');
        if ($formType == 'kyc_update') {
            $user->kyc_amount = $request->input('kyc_amount');
            $user->save();
        } elseif ($formType == 'modify_balance') {

            $user->walletbalance = $request->input('walletaddress');
            $user->invested_amount = $request->input('investedamount');
            $user->profit = $request->input('profits');
            $user->refbonus = $request->input('refbonus');
            $user->signal = $request->input('signal');
            $user->msg_alert = $request->input('msg_alert');

            $user->save();
        }

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
    }



    public function modify_investmentupdate(Request $request, $id)
    {



        $validatedData = $request->validate([
            'profits' => 'sometimes|required',
            'amount' => 'sometimes|required',
            'status_select' => 'sometimes|required',
            'withdrawal_date' => 'sometimes|required|date',

        ]);

        $investment = investmentplan::findOrFail($id); // Fetch the user based on the provided ID






        $investment->profit = $request->input('profits');
        $investment->amount = $request->input('amount');
        $investment->status = $request->input('status_select');
        $investment->Withdrawaldate = $request->input('withdrawal_date');
        $investment->profit = $request->input('profits');





        $investment->save();

        return redirect()
            ->back()
            ->with('success', 'Investment updated successfully.');
    }



    public function modify_profile_buttons(Request $request, $id)
    {
        $action = $request->query('action');
        $user = User::findOrFail($id); // Fetch the user based on the provided ID



        switch ($action) {
            case 'delete':
                // Handle delete action
                $user->delete();
                return redirect()->route('admin.manageuser')->with('success', 'User deleted successfully.');
                break;

            case 'access':
                // Handle access action
                Auth::login($user);

                // Redirect the user to their dashboard or any other desired page
                return redirect()->route('dashboard')->with('success', 'Login successful!');
                break;

            case 'verify-kyc':
                // Handle verify KYC action
                $user->kyc_verify = 'yes';
                $user->save();
                return redirect()->back()->with('success', 'User kyc successfully verified.');
                break;

            case 'verify-email':
                // Handle verify email action
                $user->email_verify = 'yes';
                $user->save();
                return redirect()->back()->with('success', 'User Email successfully verified.');
                break;

            case 'unverify-kyc':
                // Handle unverify KYC action
                $user->kyc_verify = 'no';
                $user->save();
                return redirect()->back()->with('success', 'User kyc successfully unverified.');
                break;

            default:
                // Handle unknown action or redirect back
                return redirect()->back()->withErrors(['message' => 'Unknown action.']);
        }

        // Perform the desired action and return a response
    }


    public function deposit_action(Request $request, $id)
    {

        $action = $request->query('action');
        $deposit = Userdeposit::findOrFail($id); // Fetch the user based on the provided ID
        $useremail = $deposit->email;
        $user = User::where('email', $useremail)->first();
        $deposit_amount = $deposit->amount;

        switch ($action) {
            case 'confirm':
                $deposit->status = 'confirmed';
                $deposit->save();
                $user->walletbalance += $deposit_amount;
                $user->save();

                Activity::create([
                    'email' => $useremail,
                    'activity_type' => 'deposit',
                    'status' => 'success',
                    'amount' => $deposit_amount,
                    'title' => 'Deposit Approved',
                ]);


                


                //send Mail


                Mail::send('emails.deposit_confirmed', ['user' => $user, 'deposit_amount' => $deposit_amount], function ($message) use ($user) {
                    $message->to($user->email)->subject('Deposit Confirmed');
                });


                return redirect()->back()->with('success', 'Deposit confirmed.');
                break;
                break;
            case 'decline':
                $deposit->status = 'canceled';
                $deposit->save();


                //send Mail


                Mail::send('emails.deposit_declined', ['user' => $user, 'deposit_amount' => $deposit_amount], function ($message) use ($user) {
                    $message->to($user->email)->subject('Deposit Error');
                });

                return redirect()->back()->withErrors(['message' => 'deposit declined.']);
                break;

            default:
                # code...
                break;
        }
    }


    public function withdrawal_action(Request $request, $id)
    {

        $action = $request->query('action');
        $withdrawal = Userwithdraw::findOrFail($id); // Fetch the withdrawal record based on the provided ID
        $useremail = $withdrawal->email;
        $user = User::where('email', $useremail)->first();
        $withdrawal_amount = $withdrawal->amount;
        $wallet_address = $withdrawal->walletaddress;

        switch ($action) {
            case 'confirm':
                $withdrawal->status = 'success';
                $withdrawal->save();
                $user->walletbalance -= $withdrawal_amount;
                $user->save();

                Activity::create([
                    'email' => $useremail,
                    'activity_type' => 'withdrawal',
                    'status' => 'success',
                    'amount' => $withdrawal_amount,
                    'title' => 'Withdrawal Approved',
                ]);





                //Send Mail
                Mail::send('emails.withdrawal_confirmed', ['user' => $user, 'withdrawal_amount' => $withdrawal_amount, 'wallet_address' => $wallet_address], function ($message) use ($user) {
                    $message->to($user->email)->subject('withdrawal Confirmed');
                });


                return redirect()->back()->with('success', 'Withdrawal confirmed.');
                break;

            case 'decline':
                $withdrawal->status = 'declined';
                $withdrawal->save();

                Activity::create([
                    'email' => $useremail,
                    'activity_type' => 'withdrawal',
                    'status' => 'failed',
                    'amount' => $withdrawal_amount,
                    'title' => 'Withdrawal Declined',
                ]);


                //Send Mail
                Mail::send('emails.withdrawal_declined', ['user' => $user, 'withdrawal_amount' => $withdrawal_amount, 'wallet_address' => $wallet_address], function ($message) use ($user) {
                    $message->to($user->email)->subject('withdrawal Declined');
                });

                return redirect()->back()->withErrors(['message' => 'Withdrawal Declined.']);
                break;

            default:
                return redirect()->back()->withErrors(['message' => 'Invalid action.']);
                break;
        }
    }


    public function end_investment($id)
    {
        $investment = investmentplan::findOrFail($id);
        $investment->status = 'ended';
        $invested_amount = $investment->amount;
        $invested_profit = $investment->profit;
        $total = $invested_amount + $invested_profit;
        $investment->save();

        $user = User::where('email', $investment->email)->first();
        $user_profit = $user->profit;
        $new_profit = $total + $user_profit;
        $user->profit = $new_profit; // Update user's profit
        $user->save();

        Activity::create([
            'email' => $investment->email,
            'activity_type' => 'profit',
            'status' => 'success',
            'amount' => $invested_amount,
            'profit' => $invested_profit,
            'title' => 'Profit Payout',
        ]);

        return redirect()->back()->with('success', 'Investment plan has been successfully ended.');
    }





    public function kyc_action(Request $request, $id)
    {
        $action = $request->query('action');
        $kyc_find = kyc_verification::findOrFail($id); // Fetch the user based on the provided ID
        $useremail = $kyc_find->email;
        $user = User::where('email', $useremail)->first();


        switch ($action) {
            case 'confirm':
                $kyc_find->status = 'confirmed';
                $kyc_find->save();
                $user->kyc_verify = 'true';
                $user->save();



                //send Mail
                return redirect()->back()->with('success', 'KYC confirmed.');
                break;
                break;
            case 'decline':
                $kyc_find->delete(); // Delete the record from the database
                return redirect()->back()->withErrors(['message' => 'KYC declined and record deleted..']);
                break;

            default:
                # code...
                break;
        }
    }



    public function update_withdrawal_options(Request $request, $id)
    {
        $validatedData = $request->validate([
            'withdrawal_fee_option' => 'sometimes|required',
            'withdrawal_fee' => 'sometimes|required|numeric',
            'fee_name' => 'sometimes|required|string',
        ]);
        $withdrawal = Userwithdraw::findOrFail($id);

        $withdrawal->wfee = $request->input('withdrawal_fee_option');
        $withdrawal->fee = $request->input('withdrawal_fee');
        $withdrawal->fee_name = $request->input('fee_name');
        $withdrawal->save();
        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
    }


    public function delete_deposit($id)
    {
        try {
            $deposit = Userdeposit::findOrFail($id); // Find the deposit by ID
            $deposit->delete(); // Delete the deposit

            return redirect()->back()->with('success', 'Deposit deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Failed to delete deposit.']);
        }
    }

    public function store_traders(Request $request)
    {
        $validatedData = $request->validate([
            'tradersimg' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
            'tradersname' => 'sometimes|required|string',
            'return_rate' => 'sometimes|required|string',
            'followers' => 'sometimes|required|string',
            'profitshare' => 'sometimes|required|string',
        ]);

        $uploadedImage = $request->file('tradersimg');
        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('traders_image', $filename, 'public');

        // Step 3: Insert data into the database
        CopyTrader::create([
            'tradersname' => $validatedData['tradersname'],
            'tradersimg' => $filename,
            'return_rate' => $validatedData['return_rate'],
            'followers' => $validatedData['followers'],
            'profitshare' => $validatedData['profitshare'],
        ]);

        // Step 4: Redirect or return success response
        return redirect()->back()->with('success', 'Trader information saved successfully!');
    }

    public function wallet_earn(Request $request)
    {
        $validatedData = $request->validate([
            'min_amount_req' => 'required|numeric|min:0', // Ensures it's a required number greater than or equal to 0
            'daily_earning_amount' => 'sometimes|required|numeric|min:0', // Ensures it's a number if provided
        ]);
        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)


        $adminWallet->Phrase_min_amount = $request->input('min_amount_req');
        $adminWallet->daily_earning = $request->input('daily_earning_amount');

        $adminWallet->save();

        return redirect()
            ->back()
            ->with('success', 'settings updated successfully');
    }

    public function upload_cars_action(Request $request){

        $validatedData = $request->validate([
            'vehicle_name' => 'required|string', 
            'vehicle_amount' => 'required|numeric|min:0',
            'features' => 'required|string',
            'vehicle_description' => 'required|string',
            'vehicle_img' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $features = array_filter(
            array_map('trim', explode("\n", $request->features))
        );

        $uploadedImage = $request->file('vehicle_img');
        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('vehicle_img', $filename, 'public');


        Vehicle::create([
            'vehicle_name' => $validatedData['vehicle_name'],
            'vehicle_amount' => $validatedData['vehicle_amount'],
            'features' => $features,
            'vehicle_description' => $validatedData['vehicle_description'],
            'vehicle_img' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Vehicle added successfully.');
    }

    public function delete_car(Request $request, $id){
        try {
            $car = Vehicle::findOrFail($id); 
            $car->delete(); 

            return redirect()->back()->with('success', 'car deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Failed to delete car.']);
        }
    }
}
