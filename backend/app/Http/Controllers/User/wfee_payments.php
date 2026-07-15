<?php

namespace App\Http\Controllers\User;

use App\Models\Adminwallet;
use App\Models\Userwithdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class wfee_payments extends Controller
{
    //
    public function wfee_payment($id)
    {
        $fee = Userwithdraw::findOrFail($id);
        $adminWallet = Adminwallet::first(); // Retrieve the first row from the Adminwallet table (adjust this as needed)
        $coinType = $fee->ptype;
        $QRcode = null;
        $walletAddress = null;






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
        } elseif ($coinType === 'Bank') {
            $walletAddress = $adminWallet->btc_address_bitcoin;
            $QRcode = $adminWallet->btc_address_bitcoin_qr;
        }
        return view('Userview.fee_payment', compact('fee', 'walletAddress', 'QRcode'));
    }

    public function wfee_payment_upload(Request $request, $id)
    {

        // Validate the uploaded image (you can add more validation rules as needed)
        $validatedData = $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif', // Example validation rules
        ]);

        $fee = Userwithdraw::findOrFail($id);

        // Get the uploaded image file
        $uploadedImage = $request->file('proof_image');

        // Generate a unique filename for the uploaded image
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();

        // // Store the image in a location within the 'public' disk
        // $imagePath = $uploadedImage->store('proof_images', 'public');
        // Store the image in a location within the 'public' disk with a custom filename
        $imagePath = $uploadedImage->storeAs('fee_payment', $filename, 'public');

        // Update the deposit record and set status to 'unconfirmed'
        $fee->proof = $filename;
        $fee->status = 'unconfirmed';
        $fee->save();

        return redirect()
            ->back()
            ->with('success', 'Proof uploaded successfully.')
            ->with('imagePath', $imagePath);
    }
}
