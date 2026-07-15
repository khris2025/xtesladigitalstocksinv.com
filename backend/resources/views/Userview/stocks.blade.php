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
                  <h4 class="mb-sm-0 font-size-18">Stocks</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Stocks</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="card-body">
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade active show" id="stocks" role="tabpanel">
                     <div class="row">
                        <!-- Stock Card -->
                        @foreach ($stocks as $stocksdata)
                        <div class="col-xl-4 col-sm-6">
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
            <div class="row">
               <div class="col-xl-8">
                  <div class="card">
                     <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Ongoing Stocks Investment</h4>
                        <div class="flex-shrink-0">
                           <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                                 Investments
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-body px-0">
                        <div class="tab-content">
                           <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                              <div class="table-responsive px-3" data-simplebar>
                                 <table id="datatable" class="table nowrap w-100">
                                    <thead>
                                       <tr>
                                          <th>Date</th>
                                          <th>Trans. ID</th>
                                          <th>Stock</th>
                                          <th>Shares</th>
                                          <th>ROI</th>
                                          <th>Amount</th>
                                          <th>Withdrawal Date</th>
                                          <th>Profit</th>
                                          <th>Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($ongoingStocks as $ongoingStocksdata) 
                                       <tr>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->dateadd }}</td>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->transid }}</td>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->stock->stock_name }}</td>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->shares }}</td>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->stock->roi }}%</td>
                                          <td style="font-size: 16px;">${{ number_format($ongoingStocksdata->amount) }}</td>
                                          <td style="font-size: 16px;">{{ $ongoingStocksdata->Withdrawaldate }}</td>
                                          <td style="font-size: 16px;">${{ $ongoingStocksdata->profit }}</td>
                                          <td>
                                             <button type="button" class="btn btn-rounded btn-sm btn-outline-warning">
                                             <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                             Ongoing
                                             </button>
                                          </td>
                                       </tr>
                                       @endforeach
                                       <!-- Additional rows go here -->
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Investment History -->
               <div class="col-xl-4">
                  <div class="card">
                     <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Investment History</h4>
                     </div>
                     <div class="card-body px-0">
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                           <ul class="list-unstyled activity-wid mb-0">
                              @foreach($endedStocks as $endedStocksData)
                              <li class="activity-list activity-border">
                                 <div class="activity-icon avatar-md">
                                    <span class="avatar-title bg-soft-success text-secondary rounded-circle">
                                    <i class="bx bxs-check-circle font-size-24"></i>
                                    </span>
                                 </div>
                                 <div class="timeline-list-item">
                                    <div class="d-flex">
                                       <div class="flex-grow-1 overflow-hidden me-4">
                                          <h5 class="font-size-14 mb-1">
                                             Transaction ID - {{ $endedStocksData->transid }}
                                          </h5>
                                       </div>
                                       <div class="flex-shrink-0 text-end me-3">
                                          <h6 class="mb-1">
                                             Investment:
                                             <span class="text-success">${{ number_format($endedStocksData->amount) }}</span>
                                          </h6>
                                          <div class="font-size-13">
                                             Profit: ${{ number_format($endedStocksData->profit) }}
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              @endforeach
                              <!-- Additional history items go here -->
                           </ul>
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