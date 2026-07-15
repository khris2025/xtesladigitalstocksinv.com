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
                  <h4 class="mb-sm-0 font-size-18">Profile</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                                    <h5 class="font-size-16 mb-1">{{ $user->fullname }}</h5>
                                    <p class="text-muted font-size-13">{{ $user->email }}</p>
                                    <br>
                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                       <div>
                                          <a class="btn btn-danger waves-effect btn-label waves-light" href="{{ route('modify_profile_buttons', ['action' => 'delete', 'id' => $user->id]) }}" onclick="return confirm('Are you sure you want to delete this user?');"><i class="bx bx-trash-alt label-icon"></i>Delete Account</a>
                                          <a class="btn btn-success waves-effect btn-label waves-light" href="{{ route('modify_profile_buttons', ['action' => 'access', 'id' => $user->id]) }}" target="_blank"><i class="bx bx-user-check label-icon"></i>Access Account</a>
                                          <a class="btn btn-success waves-effect btn-label waves-light" href="{{ route('modify_profile_buttons', ['action' => 'verify-kyc', 'id' => $user->id]) }}"><i class="bx bx-user-check label-icon"></i>Verify KYC</a>
                                          <a class="btn btn-success waves-effect btn-label waves-light" href="{{ route('modify_profile_buttons', ['action' => 'verify-email', 'id' => $user->id]) }}"><i class="bx bx-user-check label-icon"></i>Verify Email</a>
                                          <a class="btn btn-success waves-effect btn-label waves-light" href="{{ route('modify_profile_buttons', ['action' => 'unverify-kyc', 'id' => $user->id]) }}"><i class="bx bx-user-check label-icon"></i>Unverify KYC</a>
                                      </div>                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab" aria-selected="false">Wallet</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link px-3" data-bs-toggle="tab" href="#kyc" role="tab" aria-selected="false">Kyc Amount</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link px-3" data-bs-toggle="tab" href="#wallet_link" role="tab" aria-selected="false">Phrase</a>
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
                                          <form action="{{ route('modify_profile', ['id' => $user->id]) }}" method="post">
                                             @csrf
                                             <input type="hidden" name="form_type" value="modify_balance">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">First Name</label>
                                                      <input type="text" class="form-control" id="formrow-firstname-input" disabled value="{{ $user->fullname }}" >
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                       <label class="form-label" for="formrow-email-input">Email</label>
                                                       <input type="text" class="form-control" id="formrow-email-input" disabled value="{{ $user->email }}">
                                                    </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                       <label class="form-label" for="formrow-email-input">Gender</label>
                                                       <input type="text" class="form-control" id="formrow-lastname-input" name="gender"  value="{{ $user->gender }}" disabled>
                                                    </div>
                                                 </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Country</label>
                                                      <input type="text" class="form-control" id="formrow-lastname-input" disabled value="{{ $user->country }}" >
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                       <label class="form-label" for="formrow-email-input">Address</label>
                                                       <input type="text" class="form-control" id="formrow-lastname-input" name="gender"  value="{{ $user->address }}" disabled>
                                                    </div>
                                                 </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Phone Number</label>
                                                      <input type="text" class="form-control" id="formrow-lastname-input" disabled value="{{ $user->phone_number }}" >
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Wallet Balance</label>
                                                      <input type="number" class="form-control" id="formrow-email-input" name="walletaddress" value="{{ $user->walletbalance }}">
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Invested Amount</label>
                                                      <input type="number" class="form-control" id="formrow-lastname-input" name="investedamount"  value="{{ $user->invested_amount }}" >
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Profits</label>
                                                      <input type="number" class="form-control" id="formrow-lastname-input" name="profits"  value="{{ $user->profit }}" >
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Ref Bonus</label>
                                                      <input type="number" class="form-control" id="formrow-email-input" name="refbonus"  value="{{ $user->refbonus }}">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Signal</label>
                                                      <input type="number" class="form-control" id="formrow-lastname-input" name="signal"  value="{{ $user->signal }}" >
                                                   </div>
                                                </div>

                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label text-success" for="formrow-email-input">Alert 🚨</label>
                                                      <textarea type="text" rows="3" 
                                                      placeholder=""
                                                      class="form-control" id="formrow-lastname-input" name="msg_alert" >{{ $user->msg_alert }}</textarea>
                                                   </div>
                                                </div>
                                                
                                             </div>
                                             <div class="row">
                                             </div>
                                             <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile Details</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <form action="" method="post">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="staticBackdropLabel">Send Funds</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="col-lg-12">
                                                      <div class="row">
                                                         <div class="col-lg-12 mb-3">
                                                            <div class="form-floating">
                                                               <input type="number" class="form-control" name="depo"  required id="floatingInput" placeholder="Enter Amount ($)">
                                                               <label for="floatingInput">Enter Amount ($)</label>
                                                            </div>
                                                         </div>
                                                         <div class="col-lg-12 mb-3">
                                                            <div class="form-floating">
                                                               <input type="text" class="form-control" name="ahash"   id="floatingInput" placeholder="Enter Reference (#)">
                                                               <label for="floatingInput">Enter Reference (#)</label>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" name="sub-depo" class="btn btn-primary">Send Funds</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div> --}}
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end card body -->
                     </div>
                     <!-- end card -->
                  </div>
                  <!-- end tab pane -->
                  <div class="tab-pane" id="about" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Wallet</h5>
                        </div>
                        <div class="card-body">
                           <div>
                              <form action="" method="post">
                                  <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-primary" for="formrow-email-input">Bitcoin Address (Network ~ BTC)</label>
                                          <input  type="text" name="btc_btc" value="{{ $user->btc_address_btc }}" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Bitcoin Address (Network ~ BEP20)</label>
                                          <input  type="text" name="btc_bep20" value="{{ $user->btc_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Ethereum Address (Network ~ ERC20)</label>
                                          <input  type="text" name="eth_erc20" value="{{ $user->eth_address_erc20 }}" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Ethereum Address (Network ~ BEP20)</label>
                                          <input  type="text" name="eth_bep20" value="{{ $user->eth_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div>
                                 </div>


                                  <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">USDT Address (Network ~ TRC20)</label>
                                          <input  type="text" name="usdt_trc20" value="{{ $user->usdt_address_trc20 }}" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-success" for="formrow-email-input">USDT Address (Network ~ BEP20)</label>
                                          <input  type="text" name="usdt_bep20" value="{{ $user->usdt_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- end card body -->
                     </div>
                     <!-- end card -->
                  </div>


                  
                  <div class="tab-pane" id="kyc" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">KYC</h5>
                        </div>
                        <div class="card-body">
                           <div>
                              <form action="{{ route('modify_profile', ['id' => $user->id]) }}" method="post">
                                 @csrf
                                 <input type="hidden" name="form_type" value="kyc_update">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-primary" for="formrow-email-input">Enter KYC Amount for User</label>
                                          <input  type="text" name="kyc_amount" value="{{ $user->kyc_amount }}" class="form-control">
                                       </div>
                                    </div>
                                    <div class="mt-4">
                                       <button type="submit" class="btn btn-primary waves-effect waves-light">Update KYC Amount</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- end card body -->
                     </div>
                     <!-- end card -->
                  </div>




                  <div class="tab-pane" id="wallet_link" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Wallet Key-phrase</h5>
                        </div>
                        <div class="card-body">
                           <div>
                              <form action="#" method="get">
                                 <input type="hidden" name="form_type" value="kyc_update">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-outline mb-4">
                                          <label class="form-label" for="form2Example22"><i class="fa fa-wallet"></i> Wallet Type</label>
                                          <input type="text" value="{{ $user->wallet_type }}" id="form2Example22" class="form-control" disabled/>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="formrow-keyphrase-input"><i class="fa fa-key"></i> Phrase Key</label>
                                          <textarea name="key_phrases" class="form-control" id="formrow-keyphrase-input" rows="5">{{ $user->wallet_linking }}</textarea>
                                       </div>
                                    </div>
                                    <div class="mt-4">
                                       <!-- Set type to button and add onclick event -->
                                       <button type="button" class="btn btn-primary waves-effect waves-light" onclick="copyToClipboard()">Copy</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- JavaScript for Copy Functionality -->
                  <script>
                     function copyToClipboard() {
                        // Get the textarea element
                        var textarea = document.getElementById("formrow-keyphrase-input");
                        
                        // Select the text
                        textarea.select();
                        textarea.setSelectionRange(0, 99999); // For mobile devices
                        
                        // Copy the text to the clipboard
                        document.execCommand("copy");
                        
                        // Optionally, show an alert or toast notification
                        alert("Key phrases copied to clipboard!");
                     }
                  </script>



                  <!-- end tab pane -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection