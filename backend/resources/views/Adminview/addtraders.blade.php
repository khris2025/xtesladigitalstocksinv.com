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
               <h4 class="mb-sm-0 font-size-18">Add Traders</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                     <li class="breadcrumb-item active">Add Traders</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 col-sm-12 mt-4">
            <div class="card">
               <div class="card-header">
                  <h5 class="card-title">Add Traders</h5>
               </div>
               <div class="card-body">
                    <form method="post" action="{{ route('store_traders') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <!-- Row 1: Trader Name and Picture -->
                        <div class="row mt-4">
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Trader's Name</label>
                                <input type="text" name="tradersname" class="form-control" placeholder="Enter trader's name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Trader's Picture</label>
                                <div class="custom-file">
                                <input type="file" class="form-control" name="tradersimg" accept="image/*" required>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Return Rate and Followers -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Return Rate (%)</label>
                                <input type="number" name="return_rate" class="form-control" placeholder="Enter return rate" step="0.01" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Followers</label>
                                <input type="number" name="followers" class="form-control" placeholder="Enter number of followers" required>
                            </div>
                        </div>

                        <!-- Row 3: Profit Share -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Profit Share (%)</label>
                                <input type="number" name="profitshare" class="form-control" placeholder="Enter profit share percentage" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                    </form>

               </div>
            </div>
         </div>
      </div>

   </div>
</div>
@endsection