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
                  <h4 class="mb-sm-0 font-size-18">Deposit-Payment</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Deposit-Payment</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-5 col-lg-5">
               <div class="card">
                  <div class="card-header border-0 pb-0">
                     <h2 class="card-title">Payment</h2>
                  </div>
                  <div class="card-body pb-0 text-center">
                     <p>You are about to deposit <code>${{ number_format($deposit->amount) }}</code> into your Wallet</p>
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex px-0 justify-content-between">
                           <strong>Trans. ID</strong>
                           <span class="mb-0">{{ $deposit->transid }}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                           <strong>Date/Time</strong>
                           <span class="mb-0">{{ $deposit->dateadd->format('F j, Y g:i A') }}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                           <strong>Amount to deposit</strong>
                           <span class="mb-0">$ {{ number_format($deposit->amount) }} </span>
                        </li>
                     </ul>
                  </div>
                  <div class="card-footer pt-3 pb-3 text-center">
                     <span class="text-primary"><i class="fa fa-exclamation-circle"> </i> Please Review the Information and Confirm</span>
                     <div class="row text-center">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title">Deposit-Payment</h4>
                  </div>
                  <div class="card-body">
                     <div>
                        <div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="text-center">
                                    <h3 class="card-text "></h3>
                                    <p class="card-text">ADDRESS</p>
                                    <div class="mb-2" style="text-align: center; margin-top: 1%;" id="circle">   <img src="{{ url('storage/qr_images/' . $qr) }}" style="border-radius: 10%;  height: 150px;" alt="qrcode" />  </div>
                                    <br>
                                    <form action="{{ route('upload_proof',  ['id' => $deposit->id]) }}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <!--<div class="input-group mb-3 input-warning-o">-->
                                       <!--   <div class="input-group-prepend">-->
                                       <!--      <span class="input-group-text">₿</span>-->
                                       <!--   </div>-->
                                       <!--   <input type="text" class="form-control" id="copy" value="{{ $walletAddress  }}"> <button type="button" onclick="myFunction()" class="btn btn-success">Copy </button>-->
                                       <!--</div>-->
                                       <div class="input-group mb-3 input-warning-o">
                                           <div class="input-group-prepend">
                                              <span class="input-group-text">₿</span>
                                           </div>
                                           <input type="text" class="form-control" id="copy" value="{{ $walletAddress }}">
                                           <button type="button" onclick="myFunction()" class="btn btn-success" id="copyButton">Copy</button>
                                        </div>
                                        
                                        <script>
                                        function myFunction() {
                                           // Get the text field
                                           var copyText = document.getElementById("copy");
                                           
                                           // Select the text field
                                           copyText.select();
                                           copyText.setSelectionRange(0, 99999); // For mobile devices
                                           
                                           // Copy the text inside the text field
                                           navigator.clipboard.writeText(copyText.value).then(function() {
                                               alert("Copied the text: " + copyText.value);
                                           }).catch(function(error) {
                                               alert("Failed to copy text: " + error);
                                           });
                                        }
                                        </script>

                                       @if ($deposit->status == 'unconfirmed' || $deposit->status == 'canceled')
                                          <div class="mb-4" style="text-align: center;" id="circle">
                                             <br>
                                             @if ($deposit->proof)
                                             <img id="blah" src="{{ url('storage/proof_images/' .$deposit->proof) }}" style="border-radius: 10%;  height: 150px;" alt="Uploaded Image">
                                             @endif
                                          </div>
                                          <div class="mb-3 d-grid gap-2">
                                             <button type="submit" disabled class="btn btn-primary waves-effect btn-label waves-light">
                                             <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                             AWAITING CONFIRMATION
                                             </button>
                                          </div>
                                          @else
                                          <p class="card-text">Upload Payment Proof (Screenshot)</p>
                                          <div class="input-group mb-3 row">
                                             <div class="custom-file">
                                                <input type="file" class="form-control" name="proof_image">
                                             </div>
                                          </div>
                                          <div class="mb-3 d-grid gap-2">
                                             <button type="submit" name="sub-depo" class="btn btn-success waves-effect btn-label waves-light">
                                             <i class="bx bx-check-double label-icon"></i>
                                             PAID 
                                             </button>
                                          </div>
                                       @endif
                                    </form>
                                 </div>
                                 <div class="card-footer">
                                    <ul>
                                       <li>
                                          <p class="card-text text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"> </i> Be aware of that this order will be cancelled, if you send any other BTC amount.</p>
                                       </li>
                                       <li>
                                          <p class="card-text text-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"> </i> Account will credited once we received your payment.</p>
                                       </li>
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
   </div>
</div>
@endsection