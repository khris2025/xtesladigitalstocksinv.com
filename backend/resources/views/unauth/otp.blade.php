@extends('unauth.layout.index')
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
<div class="container py-5 h-100">
   <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
         <div class="card rounded-3 text-black">
            <div class="row g-0">
               <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
                     <div class="text-center">
                        <!--<img src="{{ asset('assets/images/bit-blockdigital_images/logomain.png') }}"-->
                        <!--   style="width: 185px;" alt="logo">-->
                     </div>
                     @if(session('success'))
                     <div class="alert alert-success">
                        {{ session('success') }}
                     </div>
                     @endif
                     @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                     @endif
                     <form action="{{ route('otp.verify') }}" method="POST">
                        @csrf
                        <p>Please enter the One-Time Password (OTP) sent to your registered email address.</p>
                        <div class="form-outline mb-4">
                           <label class="form-label" for="otp">OTP</label>
                           <input type="number" id="otp" name="otp" class="form-control" maxlength="6" />
                        </div>
                        <a class="text-muted" href="{{ route('resendOtp') }}">Didn't receive the OTP? Resend</a>
                        <br>
                        <br>
                        <input type="submit" value="Verify OTP" class="btn btn-outline-danger">
                        <hr>
                     </form>
                  </div>
               </div>
               <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection