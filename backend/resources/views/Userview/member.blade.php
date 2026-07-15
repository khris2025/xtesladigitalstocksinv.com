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
                  <h4 class="mb-sm-0 font-size-18">Membership</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Membership</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12 col-lg-12">
               <div class="card-body">
                  <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade active show" id="membership" role="tabpanel">
                        <div class="row">
                           <!-- Silver Membership -->
                           <div class="col-xl-4 col-md-6 mb-4">
                              <div class="card shadow-sm h-100">
                                 <div class="card-body text-center">
                                    <span class="badge bg-primary p-3 rounded-pill mb-3">
                                    <i class="mdi mdi-medal fs-2"></i>
                                    </span>
                                    <h4 class="mb-3">🔹 Tier 1: Apex Access</h4>
                                    <h2 class="text-primary">$250</h2>
                                    <p class="text-muted">30 Days Access</p>
                                    <hr>
                                    <ul class="list-unstyled text-start">
                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Priority Routing: 15% reduction in latency during high market volatility.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Advanced Feed: Real-time, AI-filtered Forex & crypto momentum alerts.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Giveaway Entry: Automatic entry into quarterly global hardware allocations.
                                       </li>

                                       <li>
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          24/7 Support: Fast-tracked digital assistance via the secure dashboard.
                                       </li>
                                    </ul>
                                    <form action="{{ route('membership.subscribe') }}" method="POST">
                                       @csrf

                                       <input type="hidden" name="membership_name" value="Apex Access">
                                       <input type="hidden" name="amount" value="250">
                                       <input type="hidden" name="duration_days" value="30">

                                       <button class="btn btn-primary w-100 mt-3">
                                          Buy Membership
                                       </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- Gold Membership -->
                           <div class="col-xl-4 col-md-6 mb-4">
                              <div class="card shadow-sm h-100">
                                 <div class="card-body text-center">
                                    <span class="badge bg-primary p-3 rounded-pill mb-3">
                                    <i class="mdi mdi-crown fs-2"></i>
                                    </span>
                                    <h4 class="mb-3">🔹 Tier 2: Quantum Executive</h4>
                                    <h2 class="text-primary">$600</h2>
                                    <p class="text-muted">90 Days Access</p>
                                    <hr>
                                    <ul class="list-unstyled text-start">
                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          All Apex Perks: Fully included.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Micro-Hedging: Automated risk-management dashboard plugins.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          3x Giveaway Weight: Triple entry metrics for corporate allocations.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Operations Contact: Direct routing to an account specialist for logistics.
                                       </li>

                                       <li>
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Market Briefings: Bi-weekly deep-dive insider global asset reports.
                                       </li>
                                    </ul>
                                    <form action="{{ route('membership.subscribe') }}" method="POST">
                                       @csrf

                                       <input type="hidden" name="membership_name" value="Quantum Executive">
                                       <input type="hidden" name="amount" value="600">
                                       <input type="hidden" name="duration_days" value="90">

                                       <button class="btn btn-primary w-100 mt-3">
                                          Buy Membership
                                       </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- Platinum Membership -->
                           <div class="col-xl-4 col-md-6 mb-4">
                              <div class="card shadow-sm h-100">
                                 <div class="card-body text-center">
                                    <span class="badge bg-primary p-3 rounded-pill mb-3">
                                    <i class="mdi mdi-diamond-stone fs-2"></i>
                                    </span>
                                    <h4 class="mb-3">🔹 Tier 3: Terra Sovereign (The Flagship Tier)</h4>
                                    <h2 class="text-primary">$1,200</h2>
                                    <p class="text-muted">365 Days Access</p>
                                    <hr>
                                    <ul class="list-unstyled text-start">
                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          All Quantum Executive Perks Included.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Custom API Node Access: Direct integration options for clients deploying their own high-frequency automated scripts.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          White-Glove Liquidity Routing: Zero-slippage priority fills on large-block USDT or Forex positions.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          5x Giveaway Weight: Maximum allocation tier for all high-value corporate incentives.
                                       </li>

                                       <li class="mb-2">
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Direct Executive Channel: Encrypted, immediate operational communication options directly within the secure dashboard app.
                                       </li>

                                       <li>
                                          <i class="mdi mdi-check-circle text-primary me-2"></i>
                                          Annual Innovation Summary: Exclusive breakdown of upcoming platform modules, alpha-stage tools, and network expansions before public deployment.
                                       </li>
                                    </ul>
                                    <form action="{{ route('membership.subscribe') }}" method="POST">
                                       @csrf

                                       <input type="hidden" name="membership_name" value="Terra Sovereign">
                                       <input type="hidden" name="amount" value="1200">
                                       <input type="hidden" name="duration_days" value="365">

                                       <button class="btn btn-primary w-100 mt-3">
                                          Buy Membership
                                       </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <!-- Active Memberships -->
               <div class="col-xl-8">
                  <div class="card">
                     <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">
                           My Memberships
                        </h4>
                        <div class="flex-shrink-0">
                           <span class="badge bg-primary fs-6">
                           Active Plans
                           </span>
                        </div>
                     </div>
                     <div class="card-body px-0">
                        <div class="table-responsive px-3">
                           <table id="datatable" class="table table-bordered align-middle w-100">
                              <thead class="table-light">
                                 <tr>
                                    <th>Date</th>
                                    <th>Membership ID</th>
                                    <th>Plan</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($membership)
                                   <tr>
                                       <td>{{ \Carbon\Carbon::parse($membership->purchase_date)->format('Y-m-d') }}</td>
                                       <td>{{ $membership->membership_id }}</td>
                                       <td>{{ $membership->membership_name }}</td>
                                       <td>{{ $membership->duration_days }} Days</td>
                                       <td>${{ number_format($membership->amount) }}</td>
                                       <td>{{ \Carbon\Carbon::parse($membership->expiry_date)->format('Y-m-d') }}</td>
                                       <td>
                                          <span class="badge bg-success">
                                          Active
                                          </span>
                                       </td>
                                    </tr> 
                                 @else
                                    No active membership
                                 @endif
                                 
                                 
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Membership History -->
               <div class="col-xl-4">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title mb-0">
                           Membership Purchase History
                        </h4>
                     </div>
                     <div class="card-body">
                        <div style="max-height:420px;overflow:auto;">
                           <ul class="list-unstyled activity-wid mb-0">
                              @foreach ($endedmembership as $ended)
                                 <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                       <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                       <i class="bx bx-medal font-size-22"></i>
                                       </span>
                                    </div>
                                    <div class="timeline-list-item">
                                       <h5 class="font-size-15 mb-1">
                                          {{ $ended->membership_name }} Membership Purchased
                                       </h5>
                                       <p class="text-muted mb-1">
                                          Membership ID: {{ $ended->membership_id }}
                                       </p>
                                       <small class="text-muted">
                                      <td>{{ \Carbon\Carbon::parse($ended->purchase_date)->format('Y-m-d') }}</td>
                                       </small>
                                       <div class="mt-2">
                                          <td>${{ number_format($ended->amount) }}</td>
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
</div>
</div>
@endsection