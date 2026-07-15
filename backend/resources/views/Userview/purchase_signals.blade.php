{{-- @extends('Userview.layouts.app')
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
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Purchase Signal</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Purchase Signal</li>
                     </ol>
                  </div>
               </div>
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
                  <div class="card-header d-flex">
                     <h4 class="card-title mb-0 flex-grow-1">Select your Signal Package</h4>
                     <div class="flex-shrink-0 align-self-end">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" id="pills-tab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link px-3 rounded monthly active" id="monthly" data-bs-toggle="pill" href="#month" role="tab" aria-controls="month" aria-selected="true">Plans</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="month" role="tabpanel" aria-labelledby="monthly">
                           <div class="row">
                              <div class="col-xl-4 col-sm-6">
                                 <div class="card mb-xl-0">
                                    <div class="card-body">
                                       <div class="p-2">
                                          <h5 class="font-size-16">Scalping Signals</h5>
                                          <h2 class="mt-3">$1,000<span class="text-muted font-size-16 fw-medium"></span></h2>
                                          <div class="mt-4 pt-2 text-muted">
                                             <p class="mb-3 font-size-15"><i class="mdi mdi-check-circle text-secondary font-size-18 me-2"></i>Percentage: 60%</p>
                                          </div>
                                          <div class="mt-4 pt-2">
                                             <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-outline-primary w-100">Subscribe now</button>
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
            </div>
           
         </div>
      </div>
   </div>
</div>
@endsection --}}


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

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Purchase Signal</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                <li class="breadcrumb-item active">Purchase Signal</li>
                            </ol>
                        </div>
                    </div>

                    <!-- TradingView Widget -->
                    <div class="tradingview-widget-container mb-3">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                            {
                            "symbols": [
                                {"proName": "FOREXCOM:SPXUSD", "title": "S&P 500"},
                                {"proName": "FOREXCOM:NSXUSD", "title": "US 100"},
                                {"proName": "FX_IDC:EURUSD", "title": "EUR/USD"},
                                {"proName": "BITSTAMP:BTCUSD", "title": "Bitcoin"},
                                {"proName": "BITSTAMP:ETHUSD", "title": "Ethereum"}
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
                        <div class="card-header d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Select your Signal Package</h4>
                            <div class="flex-shrink-0 align-self-end">
                                <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 rounded monthly active" id="monthly" data-bs-toggle="pill" href="#month" role="tab" aria-controls="month" aria-selected="true">Plans</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="month" role="tabpanel" aria-labelledby="monthly">
                                    <div class="row">
                                        <!-- Loop through each signal -->
                                        @foreach($signals as $signal)
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="card mb-xl-0">
                                                <div class="card-body">
                                                    <div class="p-2">
                                                        <h5 class="font-size-16">{{ $signal->name }}</h5>
                                                        <h2 class="mt-3">${{ number_format($signal->amount, 2) }}<span class="text-muted font-size-16 fw-medium"></span></h2>
                                                        <div class="mt-4 pt-2 text-muted">
                                                            <p class="mb-3 font-size-15"><i class="mdi mdi-check-circle text-secondary font-size-18 me-2"></i>Percentage: {{ $signal->percentage }}%</p>
                                                        </div>
                                                        <div class="mt-4 pt-2">
                                                            <form action="{{ route('user.subscribe.signal', $signal->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-primary w-100">Subscribe now</button>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
