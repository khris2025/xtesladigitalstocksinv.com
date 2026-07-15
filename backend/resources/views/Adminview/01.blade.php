@extends('Userview.layouts.app')
@section('content')
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
                   <h4 class="mb-sm-0 font-size-18">Deposits</h4>
                   <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                         <li class="breadcrumb-item active">Deposits</li>
                      </ol>
                   </div>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container mb-3">
                   <div class="tradingview-widget-container__widget"></div>
                   <script type="text/javascript" src="https://account.tradeverseltd.com/s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
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
             <div class="col-xl-5 col-md-5 col-sm-12">
                <!-- card -->
                <div class="card card-h-100">
                   <!-- card body -->
                   <div class="card-body">
                      <div class="row align-items-center">
                         <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">My Wallet</span>
                            <h4 class="mb-3">
                               $<span>{{ number_format(Auth::user()->walletbalance) }}</span>
                            </h4>
                         </div>
                         <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                         </div>
                      </div>
                      <div class="text-nowrap">
                         <span class="badge bg-soft-success text-success">+$20.9k</span>
                         <span class="ms-1 text-muted font-size-13">Since last week</span>
                         <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-rounded " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class=" bx bxs-credit-card label-icon"></i> Deposit Funds</button>
                         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                               <div class="modal-content">
                                  <form action="{{ route('deposit.store') }}" method="post">
                                    @csrf
                                     <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Deposit Funds</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                        <div class="col-lg-12">
                                           <div class="row">
                                              <div class="col-lg-12 mb-3">
                                                 <div class="form-floating">
                                                    <input type="number" class="form-control" name="amount"  required id="floatingInput" placeholder="Enter Amount ($)">
                                                    <label for="floatingInput">Enter Amount ($)</label>
                                                 </div>
                                              </div>
                                              <div class="col-lg-12 mb-3">
                                                 <div class="form-floating ">
                                                    <select required id="floatingInput" name="ptype"  class="form-select">
                                                       <option value >Select Payment Method </option>
                                                       <option value="Bitcoin_bitcoin">Bitcoin (Network ~ Bitcoin)</option>
                                                       <!--<option value="Bitcoin_bep20">Bitcoin (Network ~ BEP20)</option>-->
                                                       <option value="Ethereum_erc20">Ethereum (Network ~ ERC20)</option>
                                                       <option value="Ethereum_bep20">Ethereum (Network ~ BEP20)</option>
                                                       <option value="USDT_trc20">USDT (Network ~ TRC20)</option>
                                                       <option value="USDT_bep20">USDT (Network ~ BEP20)</option>
                                                       <option value="USDT_erc20">USDT (Network ~ ERC20)</option>

                                                    </select>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="sub-upd" class="btn btn-primary">Proceed to payment</button>
                                     </div>
                                  </form>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <!-- end card body -->
                </div>
                <!-- end card -->
             </div>
             <!-- end col -->
          </div>
          <!-- end row-->
          <div class="row">
             <div class="col-xl-8">
                <div class="card">
                   <div class="card-header align-items-center d-flex">
                      <h4 class="card-title mb-0 flex-grow-1">Pending Deposits</h4>
                      <div class="flex-shrink-0">
                         <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                            <li class="nav-item">
                               <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                               Deposits 
                               </a>
                            </li>
                         </ul>
                         <!-- end nav tabs -->
                      </div>
                   </div>
                   <!-- end card header -->
                   <div class="card-body px-0">
                      <div class="tab-content">
                         <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive px-3" data-simplebar >
                                 <table id="datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date Added</th> 
                                            <th>Amount</th>
                                            <th>Payment-Type</th>
                                            <th>Transaction-ID</th>
                                            <th>Status</th>
                                            <th>Control</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $deposit)
                                            <tr>
                                                @php
                                                   if ($deposit->status == 'unconfirmed' || $deposit->status == 'canceled') {
                                                      $buttonClass = 'btn btn-sm btn-rounded btn-outline-success';
                                                      $buttonText = 'View';
                                                   } else {
                                                      $buttonClass = 'btn btn-sm btn-rounded btn-outline-primary';
                                                      $buttonText = 'Make Payment';
                                                   }
                                                @endphp
                                                <td style="font-size: 16px;" class="font-w400 ">{{ $deposit->id }}</td>
                                                <td style="font-size: 16px;" class="font-w400 ">{{ $deposit->dateadd->format('F j, Y g:i A') }}</td>
                                                <td style="font-size: 16px;" class="font-w400 ">${{ number_format($deposit->amount) }}</td>
                                                <td style="font-size: 16px;" class="font-w400 ">{{ $deposit->ptype }}</td>
                                                <td style="font-size: 16px;" class="font-w400 ">{{ $deposit->transid }}</td>
                                              

                                                <td style="font-size: 16px;" > <button type="button " class="btn btn-rounded btn-sm btn-outline-warning">
                                                   <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                                  {{ $deposit->status }}
                                               </button></td>
                                               <td>
                                                   @if ($deposit->status == 'pending')
                                                      <a href="{{ route('makepayment', ['id' => $deposit->id]) }}"
                                                         class="{{ $buttonClass }}">
                                                         {{ $buttonText }}
                                                      </a>
                                                       @else
                                                         <a href="{{ route('makepayment', ['id' => $deposit->id]) }}"
                                                            class="{{ $buttonClass }}">
                                                            {{ $buttonText }}
                                                         </a>
                                                         {{-- <button type="button" class="{{ $buttonClass }}">
                                                            {{ $buttonText }}
                                                         </button> --}}
                                                   @endif
                                                   
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
            <div class="col-xl-4">
               <div class="card">
                  <div class="card-header align-items-center d-flex">
                     <h4 class="card-title mb-0 flex-grow-1">Deposit History</h4>
                  </div>
                     <div class="card-body px-0">
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                           <ul class="list-unstyled activity-wid mb-0">
                              @foreach ($completed_deposits as $completed_deposits)
                                 <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                       <span class="avatar-title bg-soft-success text-secondary rounded-circle">
                                       <i class="bx bxs-check-circle font-size-24"></i>
                                       </span>
                                    </div>
                                    <div class="timeline-list-item">
                                          <div class="d-flex">
                                             <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">Transaction ID - {{ $completed_deposits->transid }}</h5>
                                             </div>
                                             <div class="flex-shrink-0 text-end me-3">
                                                <h6 class="mb-1">Deposit: <span class="text-success"> ${{ number_format($completed_deposits->amount) }} </span> </h6>
                                                <div class="font-size-13">Coin: {{ $completed_deposits->ptype }} </div>
                                             </div>
                           
                                             
                                          </div>
                                    </div> 
                                  </li>
                              @endforeach
                           </ul>
                     </div>
                  </div>
               </div>
            </div>

             







          </div>
       </div>
    </div>
</div>
@endsection