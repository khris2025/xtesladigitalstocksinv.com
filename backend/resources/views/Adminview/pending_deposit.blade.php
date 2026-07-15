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
                  <h4 class="mb-sm-0 font-size-18">Pending-Deposits</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Pending-Deposits</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12">
               <div class="card">
                  <div class="card-header align-items-center d-flex">
                     <h4 class="card-title mb-0 flex-grow-1">Pending-Deposits</h4>
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
                                       <th >Full Name</th>
                                       <th >Email</th>
                                       <th >Transc. ID</th>
                                       <th >Status</th>
                                       <th >Amount</th>
                                       <th >Crypto</th>
                                       <th >Proof</th>
                                       <th >Date/Time</th>
                                       <th >Control</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($pendingDeposit as $pendingDeposits)
                                       <tr>
                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->fullname }}</td>
                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->email }}</td>
                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->transid }}</td>
                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->status }}</td>
                                          <td style="font-size: 16px;" class="font-w400 ">${{ number_format($pendingDeposits->amount) }}</td>
                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->ptype }}</td>

                                          <td style="font-size: 16px;" class="font-w400 ">
                                             <a href="{{ url('storage/proof_images/' . $pendingDeposits->proof) }}">
                                                <img id="blah" src="{{ url('storage/proof_images/' . $pendingDeposits->proof) }}" style="border-radius: 10%;  height: 150px;" alt="Uploaded Image">
                                             </a>
                                          </td>

                                          <td style="font-size: 16px;" class="font-w400 ">{{ $pendingDeposits->created_at->format('F j, Y g:i A') }}</td>
                                          <td><a href="{{ route('deposit_action', ['action' => 'confirm','id' => $pendingDeposits->id]) }}" class="btn btn-rounded btn-success">Approve</a>
                                             <br>
                                             <br>
                                             <a href="{{ route('deposit_action', ['action' => 'decline','id' => $pendingDeposits->id]) }}" class="btn btn-rounded btn-danger">Decline</a>
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
         </div>
      </div>
   </div>
</div>
@endsection