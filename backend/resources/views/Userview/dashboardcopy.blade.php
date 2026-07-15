@extends('Userview.layouts.app')
@section('content')
<div id="layout-wrapper">
   <!-- Left Sidebar End -->
   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   <div class="main-content">
      <div class="page-content">
         <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
               <div class="col-12">
                  <div class="row">
                     <h4 class="mb-sm-0 ">Welcome, {{ $user->username }}</h4>
                  </div>
                  {{-- <div class="mt-3  d-sm-inline-block">
                     <a href="{{ route('kyc_upload') }}" class="btn btn-danger waves-effect btn-label waves-light"><i class="bx bx-transfer-alt label-icon"></i>Account not verified</a>
                  </div> --}}
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
               <div class="col-xl-3 col-md-6">
                  <!-- card -->
                  <div class="card card-h-100">
                     <!-- card body -->
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-download" style="font-size:40px; color:#fca159;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Balance</span>
                              <h4 class="mb-3">
                                 $<span>{{ number_format($user->walletbalance) }}</span>
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-database" style="font-size:40px; color:#35ca38;" aria-hidden="true"></i>
                           </div>
                           @error('profit_transfer_error')
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
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Profits</span>
                              <h4 class="mb-3">
                                 $<span>{{ number_format($user->profit) }}</span>
                              </h4>
                           </div>
                           <button type="button" class="btn btn-dark waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#transferprofit"><i class=" bx bx-transfer-alt label-icon"></i> Transfer to Wallet</button>
                        </div>
                        <div class="row">
                           <div class="col-4 text-nowrap">
                           </div>
                           <div class="col-8 text-nowrap">
                           </div>
                        </div>
                        <div class="modal fade" id="transferprofit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <form action="{{ route('addto_balance', ['action' => 'profit_to_wallet']) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="profit_to_wallet" value="profit_to_wallet">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="staticBackdropLabel">Transfer Profits to Wallet</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-12 mb-3">
                                                <div class="form-floating">
                                                   <input type="number" class="form-control" name="profit_amount" required id="floatingInput" placeholder="Enter Amount ($)">
                                                   <label for="floatingInput">Enter Amount to transfer to Wallet ($)</label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" name="sub-trf" class="btn btn-primary">Submit</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-gift" style="font-size:40px; color:#ff4d5f;"  aria-hidden="true"></i>
                           </div>
                           @error('bonus_transfer_error')
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
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Bonus</span>
                              <h4 class="mb-3">
                                 $<span>{{ number_format($user->refbonus) }}</span>
                              </h4>
                           </div>
                           <button type="button" class="btn btn-dark waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#transferbonus"><i class=" bx bx-transfer-alt label-icon"></i> Transfer to Wallet</button>
                        </div>
                     </div>
                     <div class="modal fade" id="transferbonus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <form action="{{ route('addto_balance', ['action' => 'bonus_to_wallet']) }}" method="post">
                                 @csrf
                                 <input type="hidden" name="bonus_to_wallet" value="bonus_to_wallet">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Transfer Bonus to Wallet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <div class="row">
                                          <div class="col-lg-12 mb-3">
                                             <div class="form-floating">
                                                <input type="number" class="form-control" name="bonus_amount" required id="floatingInput" placeholder="Enter Amount ($)">
                                                <label for="floatingInput">Enter Amount to transfer to Wallet ($)</label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="sub-trfbonus" class="btn btn-primary">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-university" style="font-size:40px; color:#72a4d8;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Invested Amount</span>
                              <h4 class="mb-3">
                                 $<span>{{ number_format(Auth::user()->invested_amount) }}</span>
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               
            </div>
            

            <div class="row">

            <div class="row">
               {{-- <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-briefcase" style="font-size:40px; color: #35ca38;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Investment sector</span>
                              <h4 class="mb-3">
                                 <span>{{ $user->investedin }}</span>
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> --}}

               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-envelope" style="font-size:40px; color: #ff4d5f;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Packages</span>
                              <h4 class="mb-3">
                                 <span>{{ number_format($total_occurrences_packages) }}</span>
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-envelope-open" style="font-size:40px; color: #1a66ff;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Active Packages</span>
                              <h4 class="mb-3">
                                 <span>{{ number_format($active_packages) }}</span>
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-md-6">
                  <div class="card card-h-100">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-4">
                              <i class="fa fa-signal" style="font-size:40px; color: white;" aria-hidden="true"></i>
                           </div>
                           <div class="col-8">
                              <span class="text-muted mb-3 lh-1 d-block text-truncate">Signal</span>
                              <h4 class="mb-3">
                                 <span>{{ number_format(Auth::user()->signal) }}</span>%
                              </h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            <div class="row">
               <div class="col-xl-6" >
                  <div class="card">
                     <!-- TradingView Widget BEGIN -->
                     <div class="tradingview-widget-container" >
                        <div id="tradingview_9949c"  style="height: 480px;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                           new TradingView.widget(
                           {
                           
                           
                           "autosize": true,
                           "symbol": "BITSTAMP:BTCUSD",
                           "interval": "D",
                           "timezone": "Etc/UTC",
                           "theme": "light",
                           "style": "1",
                           "locale": "en",
                           "toolbar_bg": "#f1f3f6",
                           "enable_publishing": false,
                           "allow_symbol_change": true,
                           "container_id": "tradingview_9949c"
                           }
                           );
                        </script>
                     </div>
                     <!-- TradingView Widget END -->                       
                  </div>
               </div>
               <div class="col-xl-6">
                  <div class="card">
                     <!-- TradingView Widget BEGIN -->
                     <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                           {
                           "feedMode": "all_symbols",
                           "colorTheme": "dark",
                           "isTransparent": false,
                           "displayMode": "regular",
                           "width": "100%",
                           "height": 480,
                           "locale": "en"
                           }
                        </script>
                     </div>
                     <!-- TradingView Widget END -->
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-7">
                  <div class="card">
                     <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Pending Transactions</h4>
                        <div class="flex-shrink-0">
                           <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" data-bs-toggle="tab" href="#deposittab" role="tab">
                                 Deposits 
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" data-bs-toggle="tab" href="#withdrawaltab" role="tab">
                                 Withdrawals 
                                 </a>
                              </li>
                           </ul>
                           <!-- end nav tabs -->
                        </div>
                     </div>
                     <!-- end card header -->
                     <div class="card-body px-0">
                        <div class="tab-content">
                           <div class="tab-pane active" id="deposittab" role="tabpanel">
                              <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                   <table class="table align-middle table-nowrap table-borderless">
                                       <thead>
                                           <tr>
                                               <th>ID</th>
                                               <th>Amount</th>
                                               <th>Payment-Type</th>
                                               <th>Transaction-ID</th>
                                               <th>Date Added</th>
                                               <th>Status</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach ($pendingDeposit as $pendingDeposits)
                                               <tr>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingDeposits->id }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">${{ number_format($pendingDeposits->amount) }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingDeposits->ptype }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingDeposits->transid }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingDeposits->dateadd }}</td>
                                                   <td style="font-size: 16px;">
                                                       <button type="button" class="btn btn-rounded btn-sm btn-outline-warning">
                                                           <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                                           {{ $pendingDeposits->status }}
                                                       </button>
                                                   </td>
                                               </tr>
                                           @endforeach
                                       </tbody>
                                   </table>
                              </div>
                           </div>
                           <!-- end tab pane -->
                           <div class="tab-pane" id="withdrawaltab" role="tabpanel">
                              <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                   <table class="table align-middle table-nowrap table-borderless">
                                       <thead>
                                           <tr>
                                               <th>ID</th>
                                               <th>Amount</th>
                                               <th>Payment-Type</th>
                                               <th>Transaction-ID</th>
                                               <th>Date Added</th>
                                               <th>Status</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach ($pendingwithdrawal as $pendingwithdrawals)
                                               <tr>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingwithdrawals->id }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">${{ number_format($pendingwithdrawals->amount) }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingwithdrawals->ptype }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingwithdrawals->transid }}</td>
                                                   <td style="font-size: 16px;" class="font-w400">{{ $pendingwithdrawals->dateadd }}</td>
                                                   <td style="font-size: 16px;">
                                                       <button type="button" class="btn btn-rounded btn-sm btn-outline-warning">
                                                           <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                                           {{ $pendingwithdrawals->status }}
                                                       </button>
                                                   </td>
                                               </tr>
                                           @endforeach
                                       </tbody>
                                   </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
               <div class="col-xl-5">
                  <!-- card -->
                  <div class="card bg-primary text-white shadow-primary card-h-100">
                     <!-- card body -->
                     <div class="card-body p-0">
                        <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">
                           <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <div class="text-center p-4">
                                    <i class="mdi mdi-bitcoin widget-box-1-icon"></i>
                                    <div class="avatar-md m-auto">
                                       <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                       <i class="mdi mdi-currency-btc"></i>
                                       </span>
                                    </div>
                                    <h4 class="mt-3 lh-base fw-normal text-white"><b>Bitcoin</b> News</h4>
                                    <p class="text-white-50 font-size-13">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                       over the Bitcoin past week has dampened Bitcoin basics
                                       sentiment for bitcoin. 
                                    </p>
                                    <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
                                 </div>
                              </div>
                              <!-- end carousel-item -->
                              <div class="carousel-item">
                                 <div class="text-center p-4">
                                    <i class="mdi mdi-ethereum widget-box-1-icon"></i>
                                    <div class="avatar-md m-auto">
                                       <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                       <i class="mdi mdi-ethereum"></i>
                                       </span>
                                    </div>
                                    <h4 class="mt-3 lh-base fw-normal text-white"><b>ETH</b> News</h4>
                                    <p class="text-white-50 font-size-13">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                       over the Bitcoin past week has dampened Bitcoin basics
                                       sentiment for bitcoin. 
                                    </p>
                                    <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
                                 </div>
                              </div>
                              <!-- end carousel-item -->
                              <div class="carousel-item">
                                 <div class="text-center p-4">
                                    <i class="mdi mdi-litecoin widget-box-1-icon"></i>
                                    <div class="avatar-md m-auto">
                                       <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                       <i class="mdi mdi-litecoin"></i>
                                       </span>
                                    </div>
                                    <h4 class="mt-3 lh-base fw-normal text-white"><b>Litecoin</b> News</h4>
                                    <p class="text-white-50 font-size-13">Bitcoin prices fell sharply amid the global sell-off in equities. Negative news
                                       over the Bitcoin past week has dampened Bitcoin basics
                                       sentiment for bitcoin. 
                                    </p>
                                    <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
                                 </div>
                              </div>
                              <!-- end carousel-item -->
                           </div>
                           <!-- end carousel-inner -->
                           <div class="carousel-indicators carousel-indicators-rounded">
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                                 aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection