@extends('Userview.layouts.app')
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Activities</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Activities</li>
                     </ol>
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
               
            </div>
         </div>
      </div>
   </div>
</div>
@endsection