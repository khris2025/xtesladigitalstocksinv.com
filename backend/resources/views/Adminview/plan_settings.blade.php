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
               <h4 class="mb-sm-0 font-size-18">Manage Plans</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                     <li class="breadcrumb-item active">Manage Plans</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <form action="{{ route('plans.store') }}" method="POST">
               @csrf
               <div class="mb-3">
                  <label for="signal_name" class="form-label">Plan Name</label>
                  <input type="text" class="form-control" id="plan_name" name="plan_name" required>
               </div>
               <div class="mb-3">
                  <label for="signal_amount" class="form-label">Plan Amount (Min)</label>
                  <input type="number" class="form-control" id="plan_amount_min" name="plan_amount_min" required>
               </div>
               <div class="mb-3">
                  <label for="signal_amount" class="form-label">Plan Amount (Max)</label>
                  <input type="number" class="form-control" id="plan_amount_max" name="plan_amount_max" required>
               </div>
               <div class="mb-3">
                  <label for="signal_amount" class="form-label">ROI</label>
                  <input type="number" class="form-control" id="plan_roi" name="plan_roi" required>
               </div>
               <div class="mb-3">
                  <label for="percentage" class="form-label">Duration (Days)</label>
                  <input type="number" class="form-control" id="plan_duration" name="plan_duration" required>
               </div>
               <button type="submit" class="btn btn-primary">Add Plan</button>
            </form>
         </div>
      </div>
      <table class="table">
         <thead>
            <tr>
               <th>Name</th>
               <th>Amount Min ($)</th>
               <th>Amount Max ($)</th>
               <th>Duration (Days)</th>
               <th>ROI (%)</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            @foreach($plans as $plan)
            <tr>
               <td>{{ $plan->name }}</td>
               <td>{{ $plan->min_amount }}</td>
               <td>{{ $plan->max_amount }}</td>
               <td>{{ $plan->duration }}</td>
               <td>{{ $plan->roi }}</td>
               <td>
                  <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                  <!-- Form for deleting a plan -->
                  <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" style="display:inline;">
                     @csrf
                     @method('DELETE') <!-- This is crucial to send a DELETE request -->
                     <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection