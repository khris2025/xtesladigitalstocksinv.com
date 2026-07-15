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
                  {{-- 
                  <div class="row" style="margin-bottom: 10px">
                     <h4 class="mb-sm-0 ">Welcome, {{ $user->username }}
                        @if (Auth::user()->kyc_verify == 'no')
                        <button type="button" class="btn btn-warning btn-sm">
                        <i class="fa fa-exclamation-circle"></i> Account Not Verified
                        </button>
                        @endif  
                     </h4>
                  </div>
                  --}}
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
            <!-- Notification -->
            @if (Auth::user()->msg_alert != 'none')
            <div class="alert position-relative d-flex align-items-start mb-4"
               style="
               background-color: #f9f6ea;
               border-left: 4px solid #f4a300;
               border-radius: 16px;
               padding: 20px;
               max-width: 500px;
               ">
               <!-- Icon -->
               <div class="me-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:50px;height:50px;background:#fdf1d3;">
                     <i class="fa fa-bell text-warning fs-4"></i>
                  </div>
               </div>
               <!-- Content -->
               <div class="flex-grow-1">
                  <h6 class="fw-bold mb-2 text-dark">Notification</h6>
                  <p class="mb-0 text-secondary fs-6">
                     {{ Auth::user()->msg_alert }}
                     <span class="text-warning">⚠️</span>
                  </p>
               </div>
            </div>
            @endif
            <div class="row">
               <div class="col-md-6 col-sm-12">
                  <div class="card text-white border-0 shadow-lg"
                     style="height:440px;background:linear-gradient(135deg,#0f172a,#1e293b);border-radius:15px;overflow:hidden;">
                     <div class="card-body d-flex flex-column justify-content-between p-4">
                        <!-- Header -->
                        <div>
                           <h4 class="text-light mb-1">
                              Welcome back,
                           </h4>
                           <p class="text-light small mb-0 opacity-75">
                              Track your investments, manage your portfolio,
                              and explore opportunities.
                           </p>
                        </div>
                        <!-- Balance + Signal -->
                        <div class="p-3 rounded"
                           style="background:rgba(255,255,255,0.08);
                           border:1px solid rgba(255,255,255,0.1);">
                           <div class="d-flex justify-content-between align-items-center">
                              <!-- Balance -->
                              <div>
                                 <small class="text-light opacity-75">
                                 Available Balance
                                 </small>
                                 <h3 class="text-light fw-bold mb-0">
                                    ${{ number_format(Auth::user()->walletbalance, 2) }} USD
                                 </h3>
                                 <small class="text-light opacity-50" id="btcValue">
                                 Loading BTC value...
                                 </small>
                              </div>
                              <!-- Signal -->
                              @php
                              $signal = Auth::user()->signal;
                              if ($signal < 30) {
                              $color = '#ef4444'; // Red
                              $signalStatus = 'Weak Signal';
                              } elseif ($signal < 60) {
                              $color = '#facc15'; // Yellow
                              $signalStatus = 'Fair Signal';
                              } else {
                              $color = '#22c55e'; // Green
                              $signalStatus = 'Strong Signal';
                              }
                              @endphp
                              <div class="text-end">
                                 <div class="d-flex align-items-center justify-content-end gap-2">
                                    <i class="fas fa-signal signal-light-icon"></i>
                                    <h3 class="text-light fw-bold mb-0">
                                       {{ Auth::user()->signal }}%
                                    </h3>
                                 </div>
                                 <span class="signal-light-badge" style="background-color: {{ $color }}">
                                 {{ $signalStatus }}
                                 </span>
                              </div>
                           </div>
                           <!-- Progress -->
                           <div class="mt-3">
                              <div class="progress signal-light-progress">
                                 <div class="progress-bar"
                                    style="width:{{ Auth::user()->signal }}%; background: {{ $color }};">
                                 </div>
                              </div>
                              <div class="d-flex justify-content-between mt-2">
                                 <small class="text-light opacity-50">
                                 0% Weak
                                 </small>
                                 <small class="text-light opacity-50">
                                 30% Moderate
                                 </small>
                                 <small class="text-light opacity-50">
                                 60%+ Strong
                                 </small>
                              </div>
                           </div>
                           <!-- Account Tier -->
                           <div class="mt-3 p-3 rounded"
                              style="background:rgba(255,255,255,0.08);
                              border:1px solid rgba(255,255,255,0.1);">
                              <!-- Membership -->
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                 <div>
                                    <small class="text-light opacity-75">
                                    Membership
                                    </small>
                                 </div>
                                 <span class="badge rounded-pill"
                                    style="background:rgba(59,130,246,.2);
                                    color:#60a5fa;
                                    padding:8px 15px;">
                                 {{ Auth::user()->membership ?? 'No Membership' }}
                                 </span>
                              </div>
                              <hr class="my-2 text-secondary">
                              <!-- Membership ID -->
                              <div class="d-flex justify-content-between align-items-center">
                                 <div>
                                    <small class="text-light opacity-75">
                                    Membership ID
                                    </small>
                                 </div>
                                 <span class="badge rounded-pill"
                                    style="background:rgba(34,197,94,.2);
                                    color:#4ade80;
                                    padding:8px 15px;">
                                 {{ Auth::user()->membership_id ?? 'N/A' }}
                                 </span>
                              </div>
                           </div>
                           <!-- Buttons -->
                           <div class="row g-2 mt-3">
                              <div class="col-6">
                                 <a href="{{ route('deposit') }}" class="btn btn-secondary btn-sm w-100">
                                 <i class="fas fa-plus me-1"></i>
                                 Deposit
                                 </a>
                              </div>
                              <div class="col-6">
                                 <a href="{{ route('withdrawal') }}" class="btn btn-secondary btn-sm w-100">
                                 <i class="fas fa-minus me-1"></i>
                                 Withdraw
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <style>
                     .signal-light-icon {
                     color:#94a3b8;
                     font-size:20px;
                     }
                     .signal-light-badge {
                     display:inline-block;
                     margin-top:5px;
                     background:rgba(34,197,94,.15);
                     /* color:#4ade80; */
                     padding:6px 14px;
                     border-radius:20px;
                     font-size:13px;
                     font-weight:600;
                     }
                     .signal-light-progress {
                     height:12px;
                     background:rgba(255,255,255,.15);
                     border-radius:20px;
                     }
                     .signal-light-progress .progress-bar {
                     /* background:#22c55e; */
                     border-radius:20px;
                     }
                  </style>
                  <div class="row g-3">
                     <!-- Portfolio Value -->
                     {{-- 
                     <div class="col-md-3 col-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <small class="text-muted">Portfolio Value</small>
                              <div class="d-flex justify-content-between align-items-center mt-1">
                                 <h5 class="mb-0 fw-semibold">$0</h5>
                                 <i class="fas fa-arrow-trend-up text-success"></i>
                              </div>
                              <small class="text-muted d-block">$0.0000 BTC</small>
                              <small class="text-success fw-medium">+0.0% this month</small>
                           </div>
                        </div>
                     </div>
                     --}}
                     <!-- Investments -->
                     <div class="col-md-3 col-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <small class="text-muted">Investments</small>
                              <div class="d-flex justify-content-between align-items-center mt-1">
                                 <h5 class="mb-0 fw-semibold">${{ $calculate_invested_amount }}</h5>
                                 {{-- <i class="fas fa-chart-pie text-primary"></i> --}}
                              </div>
                              <small class="text-muted d-block" id="invBtc">Loading BTC value...</small>
                              <small class="text-primary fw-medium">
                              {{ $active_packages }} active investments
                              </small>
                           </div>
                        </div>
                     </div>
                     <!-- Stock Holdings -->
                     <div class="col-md-3 col-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <small class="text-muted">Stock Holdings</small>
                              <div class="d-flex justify-content-between align-items-center mt-1">
                                 <h5 class="mb-0 fw-semibold">${{ $calculate_stocks_amount }}</h5>
                                 <i class="fas fa-chart-column text-purple"></i>
                              </div>
                              <small class="text-muted d-block" id="stocksBtc">Loading BTC value...</small>
                              <small class="text-danger fw-medium">
                              {{ $activeStocksCount }} stock positions
                              </small>
                           </div>
                        </div>
                     </div>
                     <!-- Tesla Vehicles -->
                     <div class="col-md-3 col-6">
                        <div class="card border-0 shadow-sm h-100">
                           <div class="card-body">
                              <small class="text-muted">Tesla Vehicles</small>
                              <div class="d-flex justify-content-between align-items-center mt-1">
                                 <h5 class="mb-0 fw-semibold">0</h5>
                                 <i class="fas fa-car-side text-danger"></i>
                              </div>
                              <small class="text-muted d-block">&nbsp;</small>
                              <small class="text-danger fw-medium">
                              Electric fleet
                              </small>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card shadow-sm border-0">
                     <div class="card-header bg-white border-0">
                        <h4 class="card-title mb-0">
                           <i class="bx bx-history text-primary me-2"></i>
                           Recent Activities
                        </h4>
                     </div>
                     <div class="card-body p-0">
                        @foreach($activities as $activity)
                        <div class="d-flex align-items-start p-3 border-bottom">
                           <!-- ICON SECTION -->
                           <div class="me-3">
                              <div class="avatar-sm">
                                 @php
                                 $type = $activity->activity_type;
                                 @endphp
                                 {{-- Deposit --}}
                                 @if($type == 'deposit')
                                 <span class="avatar-title rounded-circle bg-soft-success text-success">
                                 <i class="bx bx-wallet-alt fs-3"></i>
                                 </span>
                                 {{-- Withdrawal --}}
                                 @elseif($type == 'withdrawal')
                                 <span class="avatar-title rounded-circle bg-soft-warning text-warning">
                                 <i class="bx bx-transfer-alt fs-3"></i>
                                 </span>
                                 {{-- Membership --}}
                                 @elseif($type == 'membership')
                                 <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                 <i class="bx bxs-crown fs-3"></i>
                                 </span>
                                 {{-- Referral --}}
                                 @elseif($type == 'referral')
                                 <span class="avatar-title rounded-circle bg-soft-info text-info">
                                 <i class="bx bx-group fs-3"></i>
                                 </span>
                                 @elseif($type == 'plan')
                                 <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                 <i class="bx bx-rocket fs-3"></i>
                                 </span>
                                 @elseif($type == 'profit')
                                 <span class="avatar-title rounded-circle bg-soft-success text-success">
                                 <i class="bx bx-line-chart fs-3"></i>
                                 </span>
                                 {{-- Default --}}
                                 @else
                                 <span class="avatar-title rounded-circle bg-soft-secondary text-secondary">
                                 <i class="bx bx-bell fs-3"></i>
                                 </span>
                                 @endif
                              </div>
                           </div>
                           <!-- CONTENT -->
                           <div class="flex-grow-1">
                              <!-- TITLE + STATUS -->
                              <div class="d-flex align-items-center mb-1">
                                 <h6 class="mb-0 fw-bold me-2">
                                    {{ $activity->title }}
                                 </h6>
                                 {{-- Status Badge --}}
                                 @if($activity->status == 'success' || $activity->status == 'approved')
                                 <span class="badge rounded-pill bg-success-subtle text-success">
                                 Success
                                 </span>
                                 @elseif($activity->status == 'pending')
                                 <span class="badge rounded-pill bg-warning-subtle text-warning">
                                 Pending
                                 </span>
                                 @elseif($activity->status == 'failed' || $activity->status == 'rejected')
                                 <span class="badge rounded-pill bg-danger-subtle text-danger">
                                 Failed
                                 </span>
                                 @else
                                 <span class="badge rounded-pill bg-secondary-subtle text-secondary">
                                 {{ ucfirst($activity->status) }}
                                 </span>
                                 @endif
                              </div>
                              <!-- MESSAGE / AMOUNT -->
                              <p class="text-muted mb-1">
                                 @if($activity->activity_type == 'deposit' && $activity->status == 'pending')
                                 Your deposit of
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>
                                 is awaiting approval.
                                 @elseif($activity->activity_type == 'deposit' && $activity->status == 'success')
                                 Your deposit of <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong> has been approved and the funds have been credited to your wallet.
                                 @elseif($activity->activity_type == 'withdrawal' && $activity->status == 'pending')
                                 Your withdrawal request of
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>
                                 is awaiting approval.
                                 @elseif($activity->activity_type == 'withdrawal' && $activity->status == 'success')
                                 Your withdrawal of
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>
                                 has been approved.
                                 @elseif($activity->activity_type == 'membership')
                                 Your membership has been activated successfully.
                                 @elseif($activity->activity_type == 'referral')
                                 You earned a referral bonus of
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>.
                                 @elseif($activity->activity_type == 'plan')
                                 Your plan subscription was successful. You have been charged
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>.
                                 @elseif($activity->activity_type == 'profit')
                                 Profit payout of
                                 <strong>${{ number_format($activity->profit ?? 0, 2) }}</strong>
                                 has been credited to your wallet.
                                 @elseif($activity->activity_type == 'stocks' && $activity->status == 'ended')
                                 Profit payout of
                                 <strong>${{ number_format($activity->profit ?? 0, 2) }}</strong>
                                 has been credited to your wallet.
                                 @elseif($activity->activity_type == 'stocks' && $activity->status == 'success')
                                 Stock purchase of
                                 <strong>${{ number_format($activity->amount ?? 0, 2) }}</strong>
                                 was completed successfully.
                                 @else
                                 {{ $activity->description ?? 'Activity update.' }}
                                 @endif
                              </p>
                              <!-- TIME -->
                              <small class="text-muted">
                              <i class="bx bx-time-five me-1"></i>
                              {{ $activity->created_at->format('d M Y • h:i A') }}
                              </small>
                           </div>
                        </div>
                        @endforeach
                        <div class="col-12 mb-4">
                           <div class="text-center mt-4">
                              <a href="{{ route('activities') }}" class="btn btn-outline-dark rounded-pill px-5">
                              <i data-feather="repeat"></i>
                              View More Activities
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card card-h-100 text-white" style="height: 170px; background-color: #111a30; padding: 10px; border-radius: 10px;">
                     <!-- Card body -->
                     <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                        <i class="fa fa-wallet" style="font-size:30px; color:white; margin-bottom: 10px" aria-hidden="true"></i>
                        <h5 style="margin: 0; color: rgb(199, 210, 227);">Connect Wallet</h5>
                        <p style="margin-top: 5px; color: rgb(199, 210, 227);">Earn daily <strong>${{ number_format($phraselogs->daily_earning) }}</strong> for connecting your wallet</p>
                        <a href="{{ route('wallet_connect') }}" class="btn btn-secondary">
                        Connect Now <i class="fa fa-link"></i>
                        </a>
                     </div>
                  </div>
                  <!-- Referral link card -->
                  <script type="text/javascript">
                     function copyLink() {
                        /* Get the text field */
                        var copyText = document.getElementById("myInput");
                        
                        /* Select the text field */
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
                        
                        /* Copy the text inside the text field */
                        document.execCommand("copy");
                        
                        /* Alert the copied text */
                        
                        
                        alert("Copied Referral Link: " + copyText.value);
                     }     
                  </script>
                  <div class="card shadow-sm border-0 rounded-4 mb-4">
                     <div class="card-body p-4">
                        <h4 class="card-title fw-bold">Invite Friends & Earn Rewards</h4>
                        <p class="card-text text-muted">
                           Share your referral link with friends and earn bonuses when they sign up.
                        </p>
                        <div class="input-group">
                           <input 
                              type="text" 
                              class="form-control" 
                              id="myInput"
                              value="{{ 'https://dashboard.xtesladigitalstocksinv.com/register' . '?ref=' . Auth::user()->referral_code }}" readonly
                              >
                           <button type="button" class="btn btn-primary" onclick="copyLink()">
                           Copy Link
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12">
                  <div class="row g-3">
                     @foreach ($vehicles as $uploadedvehicle)
                     <!-- Car Card -->
                     <div class="col-6">
                        <div class="card tesla-card border-0 h-100">
                           <img src="{{ url('storage/' . $uploadedvehicle->vehicle_img) }}"
                              class="card-img-top tesla-img"
                              alt="Tesla Model S">
                           <div class="card-body">
                              <div class="d-flex justify-content-between align-items-start mb-2">
                                 <div>
                                    <h6 class="fw-bold mb-0">{{ $uploadedvehicle->vehicle_name }}</h6>
                                 </div>
                                 <span class="badge bg-success-subtle text-success">
                                 In Stock
                                 </span>
                              </div>
                              <div class="mb-3">
                                 <div class="text-muted small">Starting From</div>
                                 <h5 class="fw-bold mb-0">${{ number_format($uploadedvehicle->vehicle_amount) }}</h5>
                              </div>
                              <a href="{{ route('tesla-details', $uploadedvehicle->id) }}" class="btn btn-dark w-100 rounded-pill">
                              Buy Vehicle
                              </a>
                           </div>
                        </div>
                     </div>
                     @endforeach
                     {{-- <!-- Car Card -->
                     <div class="col-6">
                        <div class="card tesla-card border-0 h-100">
                           <img src="https://cdn.motor1.com/images/mgl/7ZQXXq/s1/tesla-model-s.webp"
                              class="card-img-top tesla-img"
                              alt="Tesla Model X">
                           <div class="card-body">
                              <div class="d-flex justify-content-between align-items-start mb-2">
                                 <div>
                                    <h6 class="fw-bold mb-0">Tesla Model X</h6>
                                    <small class="text-muted">Dual Motor AWD</small>
                                 </div>
                                 <span class="badge bg-success-subtle text-success">
                                 In Stock
                                 </span>
                              </div>
                              <div class="d-flex justify-content-between my-3">
                                 <div>
                                    <small class="text-muted d-block">Range</small>
                                    <strong>348 mi</strong>
                                 </div>
                                 <div>
                                    <small class="text-muted d-block">0-60</small>
                                    <strong>2.5s</strong>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <div class="text-muted small">Starting From</div>
                                 <h5 class="fw-bold mb-0">$94,990</h5>
                              </div>
                              <button class="btn btn-dark w-100 rounded-pill">
                              Buy Vehicle
                              </button>
                           </div>
                        </div>
                     </div>
                     --}}
                     <div class="col-12 mb-4">
                        <div class="text-center mt-4">
                           <a href="{{ route('tesla') }}" class="btn btn-outline-dark rounded-pill px-5">
                           <i class="fas fa-car me-2"></i>
                           View More Vehicles
                           </a>
                        </div>
                     </div>
                  </div>
                  <style>
                     .tesla-card{
                     border-radius:18px;
                     overflow:hidden;
                     box-shadow:0 4px 15px rgba(0,0,0,.08);
                     transition:.3s;
                     background:#fff;
                     }
                     .tesla-card:hover{
                     transform:translateY(-4px);
                     }
                     .tesla-img{
                     height:180px;
                     object-fit:cover;
                     }
                     .bg-success-subtle{
                     background:#e8f8ee;
                     }
                     .btn-dark{
                     background:#111827;
                     border:none;
                     font-weight:600;
                     height:42px;
                     }
                     @media (max-width: 576px){
                     .tesla-img{
                     height:140px;
                     }
                     .card-body{
                     padding:.85rem;
                     }
                     h5{
                     font-size:1rem;
                     }
                     }
                  </style>
                  {{-- 
                  <div class="card border-0 shadow-lg tesla-token-card">
                     <!-- Header -->
                     <div class="token-header">
                        <div class="d-flex align-items-center">
                           <div class="tesla-logo">
                              <span>T</span>
                           </div>
                           <div class="ms-3">
                              <h5 class="fw-bold mb-0 text-white">
                                 Tesla Token
                              </h5>
                              <small class="text-white opacity-75">
                              TSLA Digital Asset
                              </small>
                           </div>
                        </div>
                        <div class="token-badge">
                           <i class="fas fa-bolt"></i>
                        </div>
                     </div>
                     <div class="card-body p-4">
                        <!-- Price -->
                        <div class="price-box mb-4">
                           <small class="text-muted">
                           Current Price
                           </small>
                           <div class="d-flex align-items-center justify-content-between">
                              <h2 class="fw-bold mb-0">
                                 $25.00
                              </h2>
                              <span class="price-up">
                              +8.5%
                              </span>
                           </div>
                        </div>
                        <!-- Stats -->
                        <div class="row token-stats text-center mb-4">
                           <div class="col-4">
                              <small>Market</small>
                              <strong>$25M</strong>
                           </div>
                           <div class="col-4">
                              <small>Supply</small>
                              <strong>1M</strong>
                           </div>
                           <div class="col-4">
                              <small>Holders</small>
                              <strong>5.2K</strong>
                           </div>
                        </div>
                        <div class="d-grid gap-2">
                           <button class="btn btn-dark w-100 rounded-pill">
                           <i class="fas fa-shopping-cart me-2"></i>
                           Buy Tesla Token
                           </button>
                        </div>
                     </div>
                  </div>
                  --}}
                  {{-- 
                  <style>
                     .tesla-token-card{
                     border-radius:22px;
                     overflow:hidden;
                     background:#fff;
                     }
                     /* Top gradient */
                     .token-header{
                     padding:22px;
                     background:
                     linear-gradient(135deg,#111827,#dc2626);
                     display:flex;
                     align-items:center;
                     justify-content:space-between;
                     }
                     /* Tesla Logo */
                     .tesla-logo{
                     width:58px;
                     height:58px;
                     background:white;
                     color:#e11d48;
                     border-radius:50%;
                     display:flex;
                     align-items:center;
                     justify-content:center;
                     font-size:32px;
                     font-weight:800;
                     box-shadow:0 5px 15px rgba(0,0,0,.25);
                     }
                     .token-badge{
                     width:45px;
                     height:45px;
                     border-radius:50%;
                     background:rgba(255,255,255,.2);
                     color:white;
                     display:flex;
                     justify-content:center;
                     align-items:center;
                     }
                     /* Price */
                     .price-box{
                     padding:18px;
                     background:#f8fafc;
                     border-radius:15px;
                     }
                     .price-up{
                     background:#dcfce7;
                     color:#16a34a;
                     padding:6px 12px;
                     border-radius:20px;
                     font-weight:600;
                     }
                     /* Stats */
                     .token-stats{
                     background:#f8fafc;
                     border-radius:15px;
                     padding:15px;
                     }
                     .token-stats small{
                     display:block;
                     color:#6b7280;
                     }
                     .token-stats strong{
                     display:block;
                     margin-top:5px;
                     }
                     /* Buy box */
                     .buy-box{
                     background:#111827;
                     color:white;
                     padding:15px;
                     border-radius:14px;
                     }
                     /* Buttons */
                     .buy-btn{
                     height:45px;
                     border-radius:12px;
                     font-weight:600;
                     }
                     .details-btn{
                     height:45px;
                     border-radius:12px;
                     }
                  </style>
                  --}}
                  <div class="">
                     <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                           <div class="tab-pane fade active show" id="stocks" role="tabpanel">
                              <div class="row">
                                 <!-- Stock Card -->
                                 @foreach ($stocks as $stocksdata)
                                 <div class="">
                                    <div class="card mb-xl-0 shadow-sm">
                                       <!-- Stock Image Section -->
                                       <div class="position-relative">
                                          <img src="{{ url('storage/' . $stocksdata->stock_logo) }}"
                                             class="card-img-top"
                                             style="height:220px; object-fit:cover;"
                                             alt="Apple Stock">
                                          <div class="position-absolute top-0 end-0 m-3">
                                             <span class="badge bg-success font-size-14">
                                             {{ $stocksdata->roi }}% ROI
                                             </span>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="p-2">
                                             <!-- Stock Name -->
                                             <h5 class="font-size-16">
                                                {{ $stocksdata->stock_name }}
                                             </h5>
                                             <!-- Stock Price -->
                                             <h2 class="mt-3">
                                                ${{ number_format($stocksdata->amount_share) }}
                                                <span class="text-muted font-size-16 fw-medium">
                                                / Share
                                                </span>
                                             </h2>
                                             <div class="mt-4 pt-2 text-muted">
                                                <!-- ROI -->
                                                <p class="mb-3 font-size-15">
                                                   <i class="mdi mdi-chart-line text-success font-size-18 me-2"></i>
                                                   Expected ROI:
                                                   <strong class="text-success">
                                                   {{ $stocksdata->roi }}%
                                                   </strong>
                                                </p>
                                                <!-- Duration -->
                                                <p class="mb-3 font-size-15">
                                                   <i class="mdi mdi-clock-outline text-secondary font-size-18 me-2"></i>
                                                   Trading Period:
                                                   {{ $stocksdata->trading_period }}% Days
                                                </p>
                                                <!-- Risk -->
                                                <p class="mb-3 font-size-15">
                                                   <i class="mdi mdi-shield-check text-primary font-size-18 me-2"></i>
                                                   Risk Level:
                                                   Medium
                                                </p>
                                                <!-- Market -->
                                                <p class="mb-3 font-size-15">
                                                   <i class="mdi mdi-finance text-secondary font-size-18 me-2"></i>
                                                   Market:
                                                   NASDAQ
                                                </p>
                                             </div>
                                             <!-- Buy Form -->
                                             <div class="mt-4 pt-2">
                                                <form action="{{ route('stocks.subscribe', $stocksdata->id) }}" method="POST">
                                                   @csrf
                                                   <div class="form-group mb-3">
                                                      <input 
                                                         type="number"
                                                         name="amount"
                                                         class="form-control"
                                                         placeholder="Enter investment amount"
                                                         min="10"
                                                         max="10000">
                                                   </div>
                                                   <button type="submit"
                                                      class="btn btn-outline-primary w-100">
                                                   Buy Stock
                                                   </button>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <!-- TradingView Widget BEGIN -->
                     <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                           {
                           "feedMode": "all_symbols",
                           "colorTheme": "light",
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
         </div>
      </div>
   </div>
</div>
<script>
   async function updateBTCValue() {
      const usdBalance = {{ Auth::user()->walletbalance }};
      const invUsdBalance = {{ $calculate_invested_amount }};
      const stocksUsdBalance = {{ $calculate_stocks_amount }}
   
      try {
         const response = await fetch(
               'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd'
         );
   
         const data = await response.json();
   
         const btcPrice = data.bitcoin.usd;
         const btcAmount = usdBalance / btcPrice;
         const invbtcAmount = invUsdBalance / btcPrice;
         const stocksbtcBalance = stocksUsdBalance / btcPrice;
   
         document.getElementById('btcValue').textContent =
               '= ' + btcAmount.toFixed(8) + ' BTC';
         document.getElementById('invBtc').textContent =
         '= ' + invbtcAmount.toFixed(8) + ' BTC';
         document.getElementById('stocksBtc').textContent =
                  '= ' + stocksbtcBalance.toFixed(8) + ' BTC';
         
          
      } catch (error) {
         document.getElementById('btcValue').textContent =
               '= BTC value unavailable';
      }
   }
   
   updateBTCValue();
</script>
@endsection