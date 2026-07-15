@extends('Userview.layouts.app')
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Cars</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Cars</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="row g-3">
                  <!-- Car Card -->
                  @foreach ($cars as $item)
                      <div class="col-6 col-lg-3">
                        <div class="card tesla-card border-0 h-100">
                           <img src="{{ url('storage/' . $item->vehicle_img) }}"
                              class="card-img-top tesla-img"
                              alt="Tesla Model S">
                           <div class="card-body">
                              <div class="d-flex justify-content-between align-items-start mb-2">
                                 <div>
                                    <h6 class="fw-bold mb-0">{{ $item->vehicle_name }}</h6>
                                    {{-- <small class="text-muted">Plaid AWD</small> --}}
                                 </div>
                                 <span class="badge bg-success-subtle text-success">
                                 In Stock
                                 </span>
                              </div>
                              {{-- <div class="d-flex justify-content-between my-3">
                                 <div>
                                    <small class="text-muted d-block">Range</small>
                                    <strong>396 mi</strong>
                                 </div>
                                 <div>
                                    <small class="text-muted d-block">0-60</small>
                                    <strong>1.99s</strong>
                                 </div>
                              </div> --}}
                              <div class="mb-3">
                                 <div class="text-muted small">Starting From</div>
                                 <h5 class="fw-bold mb-0">${{ number_format($item->vehicle_amount) }}</h5>
                              </div>
                              <a href="{{ route('tesla-details', $item->id) }}" class="btn btn-dark w-100 rounded-pill">
                              Buy Vehicle
                              </a>
                           </div>
                        </div>
                  </div>
                  @endforeach
                  
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   .tesla-card{
   border-radius:18px;
   overflow:hidden;
   box-shadow:0 4px 15px rgba(0,0,0,.08);
   transition:.3s;
   background:#fff;
   }
   .tesla-card:hover{
   transform:translateY(-4px);
   }
   .tesla-img{
   height:180px;
   object-fit:cover;
   }
   .bg-success-subtle{
   background:#e8f8ee;
   }
   .btn-dark{
   background:#111827;
   border:none;
   font-weight:600;
   height:42px;
   }
   @media (max-width: 576px){
   .tesla-img{
   height:140px;
   }
   .card-body{
   padding:.85rem;
   }
   h5{
   font-size:1rem;
   }
   }
</style>
@endsection