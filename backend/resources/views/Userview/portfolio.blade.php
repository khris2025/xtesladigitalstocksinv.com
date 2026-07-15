@extends('Userview.layouts.app')
@section('content')
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
<div id="layout-wrapper">
   <!-- Left Sidebar End -->
   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   <div class="main-content">
      <div class="page-content">
         <div class="container-fluid">
            <div class="row">
               
            </div>
            <!-- TOP SUMMARY CARDS -->
            <div class="row g-3">
               <!-- Wallet Balance -->
               <div class="col-md-3 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Wallet Balance
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold mb-0">
                              ${{ number_format(Auth::user()->walletbalance) }}
                           </h5>
                           <i class="fas fa-wallet text-danger fs-4"></i>
                        </div>
                        <small class="text-muted d-block mt-2">
                        Available funds
                        </small>
                     </div>
                  </div>
               </div>
               <!-- Invested -->
               <div class="col-md-3 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Invested Amount
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold mb-0">
                              ${{ number_format(Auth::user()->invested_amount) }}
                           </h5>
                           <i class="fas fa-university text-primary fs-4"></i>
                        </div>
                        <small class="text-muted d-block mt-2">
                        Active investments
                        </small>
                     </div>
                  </div>
               </div>
               <!-- Profits -->
               <div class="col-md-3 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Profits
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold mb-0">
                              ${{ number_format($user->profit) }}
                           </h5>
                           <i class="fas fa-chart-line text-success fs-4"></i>
                        </div>
                        <small class="text-success d-block mt-2">
                        Total earnings
                        </small>
                        <button class="btn btn-dark btn-sm w-100 mt-3"
                           data-bs-toggle="modal"
                           data-bs-target="#transferprofit">
                        <i class="fas fa-exchange-alt"></i>
                        Transfer Wallet
                        </button>
                     </div>
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

               <!-- Bonus -->
               <div class="col-md-3 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Bonus
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold mb-0">
                              ${{ number_format($user->refbonus) }}
                           </h5>
                           <i class="fas fa-gift text-danger fs-4"></i>
                        </div>
                        <small class="text-danger d-block mt-2">
                        Referral rewards
                        </small>
                        <button class="btn btn-dark btn-sm w-100 mt-3"
                           data-bs-toggle="modal"
                           data-bs-target="#transferbonus">
                        <i class="fas fa-exchange-alt"></i>
                        Transfer Wallet
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- PACKAGE CARDS -->
            <div class="row g-3 mt-1">
               <div class="col-md-6 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Total Packages
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold">
                              {{ number_format($total_occurrences_packages) }}
                           </h5>
                           <i class="fas fa-box text-danger fs-4"></i>
                        </div>
                        <small class="text-muted">
                        Purchased packages
                        </small>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-6">
                  <div class="card border-0 shadow-sm h-100">
                     <div class="card-body">
                        <small class="text-muted">
                        Active Packages
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <h5 class="fw-semibold">
                              {{ number_format($active_packages) }}
                           </h5>
                           <i class="fas fa-box-open text-primary fs-4"></i>
                        </div>
                        <small class="text-primary">
                        Currently running
                        </small>
                     </div>
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