@extends('Userview.layouts.app')

@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">

         <!-- PAGE HEADER -->
         <div class="row mb-3">
            <div class="col-12">
               <div class="d-flex justify-content-between align-items-center">
                  <div>
                     <h3 class="mb-0 fw-bold">Cars</h3>
                     <small class="text-muted">Vehicle details & specifications</small>
                  </div>
                  <ol class="breadcrumb mb-0">
                     <li class="breadcrumb-item"><a href="#">User</a></li>
                     <li class="breadcrumb-item active">Cars</li>
                  </ol>
               </div>
            </div>
         </div>

         <div class="row g-4">

            <!-- LEFT SIDE -->
            <div class="col-lg-8">

               <!-- HERO IMAGE -->
               <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                  <img src="{{ url('storage/' . $tesla->vehicle_img) }}"
                       style="max-height:420px; object-fit:cover;">
               </div>

               <!-- QUICK STATS -->
               

               <!-- CAR DETAILS SECTION -->
               <div class="card border-0 shadow-sm rounded-4 mb-4">
                  <div class="card-body p-4">
                     <h5 class="fw-bold mb-3">Car description</h5>

                     
                  </div>
               </div>

               <!-- FEATURES -->
               <div class="card border-0 shadow-sm rounded-4 mb-4">
                  <div class="card-body p-4">
                     <h5 class="fw-bold mb-3">Features</h5>

                     <div class="d-flex flex-wrap gap-2">
                        @foreach($tesla->features as $feature)
                           <span class="badge bg-light text-dark border p-2"> {{ $feature }}</span>
                        @endforeach
                        

                     </div>
                  </div>
               </div>

            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4">

               <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top:20px;">
                  <div class="card-body p-4">

                     <h4 class="fw-bold">{{ $tesla->vehicle_name }}</h4>

                     <h2 class="text-danger fw-bold mb-3">
                        ${{ number_format($tesla->vehicle_amount) }}
                     </h2>

                     <hr>

                     <div class="mb-3">
                        <small class="text-muted">Status</small>
                        <div class="fw-bold text-success">Available</div>
                     </div>

                     <div class="d-grid gap-2">
                        <button class="btn btn-secondary btn-lg rounded-3">
                           🛒 Order Now
                        </button>

                        
                     </div>

                  </div>
               </div>

            </div>

         </div>

      </div>
   </div>
</div>
@endsection