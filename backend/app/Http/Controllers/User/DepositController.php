<?php

namespace App\Http\Controllers\User;

use App\Models\Adminwallet;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Userdeposit; // Import the Userdeposit model
use Carbon\Carbon;

class DepositController extends Controller
{
    //

    public function deposit(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'ptype' => 'required',
        ]);


        $transactionId = Str::uuid()->toString();
        $currentDate = Carbon::now();


        $deposit = new Userdeposit();
        $deposit->fullname = Auth::user()->fullname;
        $deposit->email = Auth::user()->email;
        $deposit->amount = $validatedData['amount'];
        $deposit->ptype = $validatedData['ptype'];
        $deposit->transid = $transactionId;
        $deposit->dateadd = $currentDate;
        $deposit->save();

        return redirect()->back()->with('success', 'Deposit Amount Selected, proceed to make payment');
    }


    public function deposit_pay($id)
    {
        // $deposit = Userdeposit::findOrFail($id);
        $deposit = Userdeposit::findOrFail($id); // Fetch the deposit based on the provided ID
        // Retrieve the wallet address based on the coin type from the Adminwallet model
        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)
        $coinType = $deposit->ptype;

        // Determine the appropriate wallet address based on the coin type
        $walletAddress = null; // Default value in case of an unknown coin type
        $QRcode = null;
        


        if ($coinType === 'Bitcoin_bitcoin') {
            $walletAddress = $adminWallet->btc_address_bitcoin;
            $QRcode = $adminWallet->btc_address_bitcoin_qr;
        } elseif ($coinType === 'Bitcoin_bep20') {
            $walletAddress = $adminWallet->btc_address_bep20;
            $QRcode = $adminWallet->btc_address_bep20_qr;
        } elseif ($coinType === 'Ethereum_erc20') {
            $walletAddress = $adminWallet->eth_address_erc20;
            $QRcode = $adminWallet->eth_address_erc20_qr;
        } elseif ($coinType === 'Ethereum_bep20') {
            $walletAddress = $adminWallet->eth_address_bep20;
            $QRcode = $adminWallet->eth_address_bep20_qr;
        } elseif ($coinType === 'USDT_trc20') {
            $walletAddress = $adminWallet->usdt_address_trc20;
            $QRcode = $adminWallet->usdt_address_trc20_qr;
        } elseif ($coinType === 'USDT_bep20') {
            $walletAddress = $adminWallet->usdt_address_bep20;
            $QRcode = $adminWallet->usdt_address_bep20_qr;
        } elseif ($coinType === 'USDT_erc20') {
            $walletAddress = $adminWallet->usdt_address_erc20;
            $QRcode = $adminWallet->usdt_address_erc20_qr;
        }
        return view('Adminview.02', [
            'deposit' => $deposit,
            'walletAddress' => $walletAddress, // Pass the wallet address to the view
            'qr' => $QRcode,
            'proof' => $deposit->proof, // Pass the proof variable
        ]);
    }


    public function upload_proof(Request $request, $id)
    {
        // Validate the uploaded image (you can add more validation rules as needed)
        $validatedData = $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
        ]);

        $userDeposit = Userdeposit::findOrFail($id);

        // Get the uploaded image file
        $uploadedImage = $request->file('proof_image');

        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();

        // // Store the image in a location within the 'public' disk
        // $imagePath = $uploadedImage->store('proof_images', 'public');
        // Store the image in a location within the 'public' disk with a custom filename
        $imagePath = $uploadedImage->storeAs('proof_images', $filename, 'public');

        // Update the deposit record and set status to 'unconfirmed'
        $userDeposit->proof = $filename;
        $userDeposit->status = 'unconfirmed';
        $userDeposit->save();

        Activity::create([
            'email' => $userDeposit->email,
            'activity_type' => 'deposit',
            'status' => 'pending',
            'amount' => $userDeposit->amount,
            'title' => 'Deposit Request',
        ]);


        

        return redirect()
            ->back()
            ->with('success', 'Proof uploaded successfully.')
            ->with('imagePath', $imagePath);
    }
}
