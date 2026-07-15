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
                       <img src="{{ asset('assets/images/tesla_logo.png') }}"
                        style="width: 185px;" alt="logo">
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
                     <form action="{{ route('reset_password_user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <p>Reset Password</p>
                        <div class="form-outline mb-4">
                           <label class="form-label" for="form2Example22">New Password</label>
                           <div class="input-group">
                             <input type="password" id="new_password" name="password" class="form-control" value="{{ old('email') }}"/>
                             <div class="input-group-append">
                               <span class="input-group-text" onclick="togglePasswordVisibility('new_password')">
                                 <i class="fa fa-eye" id="toggleNewPassword"></i>
                               </span>
                             </div>
                           </div>
                        </div>

                        <div class="form-outline mb-4">
                           <label class="form-label" for="form2Example22">Confirm Password</label>
                           <div class="input-group">
                              <input type="password" id="confirm_password" name="password_confirmation" class="form-control" value="{{ old('email') }}"/>
                              <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePasswordVisibility('confirm_password')">
                                  <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                </span>
                              </div>
                           </div>
                        </div>

                        <script>
                           function togglePasswordVisibility(fieldId) {
                             var field = document.getElementById(fieldId);
                             var icon = field.nextElementSibling.querySelector('i');
                             if (field.type === "password") {
                               field.type = "text";
                               icon.classList.remove('fa-eye');
                               icon.classList.add('fa-eye-slash');
                             } else {
                               field.type = "password";
                               icon.classList.remove('fa-eye-slash');
                               icon.classList.add('fa-eye');
                             }
                           }
                        </script>


                        <input type="submit" value="Get Started" class="btn btn-outline-danger">
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection