@extends('Userview.layouts.app')
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Profile</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
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
                                    <img src="assets/images/users/avatar-2.png" alt="" class="img-fluid rounded-circle d-block">
                                 </div>
                              </div>
                              <div class="flex-grow-1">
                                 <div>
                                    @if (Auth::user()->kyc_verify == 'no')
                                       <a href="{{ route('kyc_upload') }}" class="btn btn-danger waves-effect btn-label waves-light"><i class="bx bx-transfer-alt label-icon"></i> KYC Verification</a>
                                    @endif
                                    <br>
                                    <br>
                                    @if (Auth::user()->membership_id == '')
                                       <a href="{{ route('member') }}" class="btn btn-danger waves-effect btn-label waves-light">
                                          <i class="bx bx-crown label-icon"></i>
                                          Buy Membership
                                       </a>
                                    @endif
                                    <br><br>
                                    <p class="text-muted font-size-13">{{ Auth::user()->email }}</p> 
                                    
                                    {{-- <button type="button" class="btn btn-warning btn-sm">
                                       <i class="fa fa-exclamation-circle"></i> Tier 1
                                    </button> --}}
                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                       <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Active</div>
                                       <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ Auth::user()->country }}</div>
                                      
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
                           <a class="nav-link px-3" data-bs-toggle="tab" href="#post" role="tab" aria-selected="false">Security</a>
                        </li>
                        {{-- <li class="nav-item">
                           <a class="nav-link px-3" data-bs-toggle="tab" href="#wallet_link" role="tab" aria-selected="false">Link wallet</a>
                        </li> --}}
                     </ul>
                  </div>
               </div>
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
                                          <form action="" method="post">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">First Name</label>
                                                      <input type="tezt" class="form-control" id="formrow-firstname-input" disabled value="{{ Auth::user()->fullname }}" >
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Email</label>
                                                      <input type="text" class="form-control" id="formrow-email-input" disabled value="{{ Auth::user()->email }}">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">country</label>
                                                      <input type="text" class="form-control" id="formrow-email-input" name="country" placeholder="Enter your Address" value="{{ Auth::user()->country }}" disabled>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Gender</label>
                                                      <input type="text" class="form-control" id="formrow-lastname-input" name="gender"  value="{{ Auth::user()->gender }}" disabled>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Address</label>
                                                      <input type="text" class="form-control" id="formrow-email-input" name="country" placeholder="Enter your Address" value="{{ Auth::user()->address }}" disabled>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="formrow-email-input">Phone Number</label>
                                                      <input type="text" class="form-control" id="formrow-lastname-input" name="gender"  value="{{ Auth::user()->phone_number }}" disabled>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="mt-4">
                                                <button type="submit" name="sub-upd" class="btn btn-primary w-md">Update Profile Details</button>
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
                  @if(session('success'))
                  <script>
                     Swal.fire({
                     icon: 'success',
                     title: 'Success',
                     text: @json(session('success')),
                     });
                  </script>
                  @endif
                  <div class="tab-pane" id="about" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Wallet</h5>
                        </div>
                        <div class="card-body">
                           <div>
                              <form action="{{ route('addwallet') }}" method="post">
                                 @csrf
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-primary" for="formrow-email-input">Bitcoin Address (Network ~ BTC)</label>
                                          <input  type="text" name="btc_btc" value="{{ Auth::user()->btc_address_btc }}" class="form-control">
                                       </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Bitcoin Address (Network ~ BEP20)</label>
                                          <input  type="text" name="btc_bep20" value="{{ Auth::user()->btc_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div> --}}


                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">USDT Address (Network ~ ERC20)</label>
                                          <input  type="text" name="usdt_erc20" value="{{ Auth::user()->usdt_address_erc20 }}" class="form-control" >
                                       </div>
                                    </div>


                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Ethereum Address (Network ~ ERC20)</label>
                                          <input  type="text" name="eth_erc20" value="{{ Auth::user()->eth_address_erc20 }}" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">Ethereum Address (Network ~ BEP20)</label>
                                          <input  type="text" name="eth_bep20" value="{{ Auth::user()->eth_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-secondary" for="formrow-email-input">USDT Address (Network ~ TRC20)</label>
                                          <input  type="text" name="usdt_trc20" value="{{ Auth::user()->usdt_address_trc20 }}" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="form-label text-success" for="formrow-email-input">USDT Address (Network ~ BEP20)</label>
                                          <input  type="text" name="usdt_bep20" value="{{ Auth::user()->usdt_address_bep20 }}" class="form-control" >
                                       </div>
                                    </div>
                                 </div>
                                
                                 <div class="mt-4">
                                    <button type="submit" name="sub-wallet" class="btn btn-success w-md">Update Wallet Address</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="tab-pane" id="post" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Security</h5>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('update_password') }}" method="post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label class="form-label" for="formrow-email-input">Old Password</label>
                                       <input  type="password" name="old_password" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label class="form-label" for="formrow-email-input">New Password</label>
                                       <input  type="password" name="password" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label class="form-label" for="formrow-email-input">Confirm Password</label>
                                       <input  type="password"name="password_confirmation" class="form-control" >
                                    </div>
                                 </div>
                              </div>
                              <div class="mt-4">
                                 <button type="submit" name="sub-pass" class="btn btn-secondary w-md">Update Password</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>


                  <div class="tab-pane" id="wallet_link" role="tabpanel">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title mb-0">Link Wallet</h5>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('wallet_linking') }}" method="post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                       <label class="form-label" for="formrow-keyphrase-input">Enter your 12 key phrases, separated by commas</label>
                                       <textarea name="key_phrases" class="form-control" id="formrow-keyphrase-input" rows="5"></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="mt-4">
                                 <button type="submit" name="sub-pass" class="btn btn-secondary w-md">Link Wallet</button>
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
@endsection