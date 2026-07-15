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
               <h4 class="mb-sm-0 font-size-18">Upload Cars</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                     <li class="breadcrumb-item active">Upload Cars</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
            <div class="col-lg-12 col-sm-12 mt-4">
                <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Upload Cars</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('upload_cars_action') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Vehicle Name/Year</label>
                                <input type="text" name="vehicle_name" class="form-control" >
                            </div>
                            <div class="form-group col-md-6 ">
                                <label class="text-secondary">Amount ($)</label>
                                <input type="text" name="vehicle_amount" class="form-control">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label>Features</label>
                                    <textarea
                                        name="features"
                                        rows="8"
                                        class="form-control"
                                        placeholder="One feature per line">
                                    </textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-secondary">Description</label>
                                <textarea
                                        name="vehicle_description"
                                        rows="8"
                                        class="form-control"
                                        placeholder="description">
                                    </textarea>
                            </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="text-secondary">Upload Car Img</label>
                                    <div class="form-row">
                                        <div class="mb-2" style="text-align: center; margin-top: 1%;" id="circle"> 
                                    </div>
                                    <div class="input-group col-lg-12 row">
                                        <div class="custom-file">
                                        <input type="file" class="form-control" required="" name="vehicle_img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class=" mt-3">
                            <button type="submit" name="" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                @foreach ($tesla as $cars)
                    <tbody>
                        <td>{{ $cars->vehicle_name }}</td>
                        <td>${{ number_format($cars->vehicle_amount) }}</td>
                        <td>
                           <!-- Form for deleting a plan -->
                            <form action="{{ route('car.destroy', $cars->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE') <!-- This is crucial to send a DELETE request -->
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                            </form> 
                        </td>
                        
                    </tbody>
                @endforeach
                
            </table>
      </div>
   </div>
</div>
@endsection