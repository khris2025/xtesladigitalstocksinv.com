@extends('Userview.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
       <div class="container-fluid">
          <div class="row">
             <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h4 class="mb-sm-0 font-size-18">KYC Document-Upload</h4>
                   <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                         <li class="breadcrumb-item active">KYC Document-Upload</li>
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
                                     <h5 class="font-size-16 mb-1">{{ Auth::user()->fullname; }}</h5>
                                     <p class="text-muted font-size-13">{{ Auth::user()->email; }}</p>
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
                            <a class="nav-link px-3 active" data-bs-toggle="tab" href="#kyc" role="tab" aria-selected="false">KYC Verification</a>
                         </li>
                      </ul>
                   </div>
                   <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="tab-content">
                   <div class="tab-pane active" id="kyc" role="tabpanel">
                      <div class="card">
                         <div class="card-header">
                            <h5 class="card-title mb-0">KYC Verification (Document Upload)</h5>
                         </div>
                         <div class="card-body">
                            <form action="{{ route('kyc_upload_id') }}" enctype="multipart/form-data" method="post">
                                @csrf
                               <div class="row">
                                  <p class="card-text">Upload Document</p>
                                  <div class="input-group mb-1 row">
                                     <div class="custom-file">
                                        <label class="form-label" for="">ID Card(Front)</label>
                                        <input type="file" class="form-control" required="" name="id_front">
                                        <br>
                                        <label class="form-label" for="">ID Card(Back)</label>
                                        <input type="file" class="form-control" required="" name="id_back">
                                        <br>
                                     </div>
                                     <div class="col-lg-12 mt-3">
                                        <label class="form-label" for="">Select Payment method</label>
                                        <div class="form-floating ">
                                           <select required id="floatingInput" name="payment_coin" class="form-select">
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
                               <div class="mt-2">
                                  <button type="submit" name="sub-kyc" class="btn btn-secondary w-md">Proceed</button>
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
@endsection