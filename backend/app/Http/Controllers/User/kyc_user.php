<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Adminwallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\kyc_verification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class kyc_user extends Controller
{
    //
    public function kyc_upload_id(Request $request)
    {
        $validatedData = $request->validate([
            'id_front' => 'required|image|mimes:jpeg,png,jpg,gif',
            'id_back' => 'required|image|mimes:jpeg,png,jpg,gif',
            'payment_coin' => 'nullable|string',
        ]);
        $currentDate = Carbon::now();
        $user = Auth::user();
        $uploadedImage_front = $request->file('id_front');
        $uploadedImage_back = $request->file('id_back');

        $filename_front = time() . '_' . $uploadedImage_front->getClientOriginalName();
        $filename_back = time() . '_' . $uploadedImage_back->getClientOriginalName();

        $imagePath_front = $uploadedImage_front->storeAs('kyc_id', $filename_front, 'public');
        $imagePath_back = $uploadedImage_back->storeAs('kyc_id', $filename_back, 'public');
        $transactionId = Str::uuid()->toString();

        $kyc = new kyc_verification();

        $kyc->fullname = $user->fullname;
        $kyc->email = $user->email;
        $kyc->coin_type = $request->input('payment_coin');
        $kyc->id_front = $filename_front;
        $kyc->id_back = $filename_back;
        $kyc->dateadd = $currentDate;
        $kyc->transaction_id = $transactionId;



        $kyc->save();
        return redirect()->route('kyc_upload_pay')->with('success', 'ID successfully uploaded.');
    }


    public function kyc_upload_pay()
    {
        $user = Auth::user();
        $user_email = $user->email;
        $kyc_amount = $user->kyc_amount;

        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)




        // Retrieve the user's KYC data from the kyc_verification table
        $kycData = kyc_verification::where('email', $user_email)->first();
        $coinType = $kycData->coin_type;
        // Determine the appropriate wallet address based on the coin type
        $walletAddress = null; // Default value in case of an unknown coin type
        $QRcode = null;

        if ($coinType === 'Bitcoin_bitcoin') {
            $walletAddress = $adminWallet->btc_address_bitcoin;
            $QRcode = $adminWallet->btc_address_bitcoin_qr;
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

        return view('Userview.kyc_payment', compact('kycData', 'QRcode', 'walletAddress', 'kyc_amount'));
    }


    public function kyc_upload_proof(Request $request)
    {
        // Validate the uploaded image (you can add more validation rules as needed)
        $validatedData = $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
        ]);

        $user = Auth::user();
        $user_email = $user->email;
        // Retrieve the user's KYC data from the kyc_verification table
        $kycData = kyc_verification::where('email', $user_email)->first();


        // Get the uploaded image file
        $uploadedImage = $request->file('proof_image');

        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();

        // // Store the image in a location within the 'public' disk
        // $imagePath = $uploadedImage->store('proof_images', 'public');
        // Store the image in a location within the 'public' disk with a custom filename
        $imagePath = $uploadedImage->storeAs('kyc_payment_proof', $filename, 'public');

        // Update the deposit record and set status to 'unconfirmed'
        $kycData->proof = $filename;
        $kycData->status = 'unconfirmed';
        $kycData->save();

        return redirect()
            ->back()
            ->with('success', 'Proof uploaded successfully.')
            ->with('imagePath', $imagePath);
    }
}
