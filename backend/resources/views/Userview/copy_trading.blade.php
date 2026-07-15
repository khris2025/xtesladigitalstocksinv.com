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


<style>
   .card {
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
   }

   .card-body {
      padding: 2rem;
   }

   .profile-image {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 1rem;
      display: block;
   }

   .card-title {
      font-weight: bold;
      text-align: center;
      margin-bottom: 1.5rem;
   }

   .info-item {
      margin-bottom: 0.75rem;
   }

   .rating i {
      color: gold;
   }

   .copy-expert {
      background-color: #28a745; /* Green */
      color: white;
      text-align: center;
      padding: 0.75rem;
      border-radius: 5px;
      margin-top: 1rem;
      cursor: pointer;
   }

   .pro-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: gold; /* Or any color you prefer */
      color: black;
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
      font-size: small; /* Adjust size as needed */
   }
</style>


<div class="main-content">
   <div class="page-content">






      <div class="row">
         @foreach($traders as $trader)
         <div class="container mt-5">
            <div class="col-md-4">
               <div class="card">
                  <span class="pro-badge">PRO</span>
                  <div class="card-body">
                     <img
                        src="{{ asset('storage/traders_image/' . $trader->tradersimg) }}"
                        alt="Profile"
                        class="profile-image"
                        />
                     <h5 class="card-title">{{ $trader->tradersname }}</h5>
                     <div class="info-item">
                        <span>Followers</span>
                        <span class="float-end">{{ number_format($trader->followers) }}</span>
                     </div>
                     {{-- <div class="info-item">
                        <span>Minimum Start Up Capital</span>
                        <span class="float-end">$20,000</span>
                     </div> --}}
                     <div class="info-item">
                        <span>Profit Share:</span>
                        <span class="float-end">{{ $trader->profitshare }}%</span>
                     </div>
                     <div class="info-item">
                        <span>Profit Share:</span>
                        <span class="float-end">Return Rate: {{ $trader->return_rate }}%</span>
                     </div>
                     {{-- <div class="info-item">
                        <span>Total Profit</span>
                        <span class="float-end">$1,280,000</span>
                     </div> --}}
                     <div class="rating info-item">
                        Rating:
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                     </div>
                     <div class="copy-expert" data-bs-toggle="modal" data-bs-target="#staticBackdrop" disabled>Copy Expert</div>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>



      {{-- <div class="row">
         @foreach($traders as $trader)
         <div class="col-md-4 mb-4">
               <div class="card">
                  <div class="card-header">
                     <h5 class="card-title mb-0" style="display: inline-block;">{{ $trader->tradersname }}</h5>
                     <img src="{{ asset('assets/images/verification.png') }}" alt="Verification Icon" class="rounded-circle" style="display: inline-block; height: 5%; width: 5%;">
                     <br>
                     <br>
                     <center>
                        <img src="{{ asset('storage/traders_image/' . $trader->tradersimg) }}" alt="{{ $trader->name }} Image" class="rounded-circle float-right" height="20%" width="20%">
                     </center>
                     
                  </div>
                  <div class="card-body">
                     <p class="card-text">
                           <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Copy Trader</button>
                     </p>
                     <ul class="list-group list-group-flush">
                           <li class="list-group-item">Return Rate: {{ $trader->return_rate }}%</li>
                           <li class="list-group-item">Followers: {{ number_format($trader->followers) }}</li>
                           <li class="list-group-item">Profit Share: {{ $trader->profitshare }}%</li>
                     </ul>
                  </div>
               </div>
         </div>
         @endforeach
      </div> --}}

     




      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <form action="{{ route('copy_payment') }}" method="post">
                  @csrf
                  <div class="modal-header">
                     <h5 class="modal-title" id="staticBackdropLabel">Copy this trader?</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-lg-12 mb-3">
                                <div class="alert alert-info" role="alert">
                                    <strong>Important:</strong> Copying this trader would attract a payment of $500.
                                </div>

                                <div class="form-floating ">
                                    <select required id="floatingInput" name="ptype"  class="form-select">
                                        <option value >Select Payment Method </option>
                                        <option value="walletbalance">Wallet Balance</option>
                                    </select>
                                </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="sub-upd" class="btn btn-primary">Proceed to payment</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection