@extends('Adminview.layout.app')
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
                  <h4 class="mb-sm-0 font-size-18">Modify Withdrawal</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Modify Withdrawal</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                           <div class="d-flex align-items-start mt-3 mt-sm-0">
                              <div class="flex-shrink-0">
                                 <div class="avatar-xl me-3">
                                    <img src="{{ asset('assets/images/users/avatar-2.png') }}" alt="" class="img-fluid rounded-circle d-block">
                                 </div>
                              </div>
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-16 mb-1">{{ $withdrawal->fullname }}</h5>
                                    <p class="text-muted font-size-13">{{ $withdrawal->email }}</p>
                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                       <div>
                                          <a class="btn btn-danger waves-effect btn-label waves-light" href="" onclick="return confirm('Are you sure you want to delete this user?');"><i class="bx bx-trash-alt label-icon"></i>Delete Withdrawal</a>
                                      </div>                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab" aria-selected="true">Manage Withdrawal</a>
                        </li>
                     </ul>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
               <div class="tab-content">
                  <div class="tab-pane active" id="overview" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Profile</h5>
                        </div>
                        <div class="card-body">
                           <div>
                              <div class="pb-3">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div>
                                          <form action="{{ route('update_withdrawal_options',['id' => $withdrawal->id]) }}" method="post">
                                             @csrf
                                             <input type="hidden" name="form_type" value="modify_balance">
                                             <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-email-input">Withdrawal fee?</label>
                                                        <select required id="floatingInput" name="withdrawal_fee_option"  class="form-select" value{{ $withdrawal->wfee }}>
                                                            <option value >Select option</option>
                                                            <option value="yes">yes</option>
                                                            <option value="no">no</option>
                                                         </select>
                                                    </div>
                                                 </div>
                                                <div class="col-md-4">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Withdrawal fee</label>
                                                      <input type="number" class="form-control" id="formrow-firstname-input"  value="{{ $withdrawal->fee }}" name="withdrawal_fee">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                       <label class="form-label" for="formrow-email-input">Fee Name/Purpose</label>
                                                       <input type="text" class="form-control" id="formrow-email-input"  value="{{ $withdrawal->fee_name }}" name="fee_name">
                                                    </div>
                                                 </div>
                                             </div>



                                             <div class="row">
                                             </div>
                                             <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Withdrawal Details</button>
                                             </div>
                                          </form>
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
@endsection