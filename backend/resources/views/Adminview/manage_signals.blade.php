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
               <h4 class="mb-sm-0 font-size-18">Manage Signals</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                     <li class="breadcrumb-item active">Manage Signals</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <form action="{{ route('signals.create') }}" method="POST">
               @csrf
               <div class="mb-3">
                  <label for="signal_name" class="form-label">Signal Name</label>
                  <input type="text" class="form-control" id="signal_name" name="signal_name" required>
               </div>
               <div class="mb-3">
                  <label for="signal_amount" class="form-label">Signal Amount</label>
                  <input type="number" class="form-control" id="signal_amount" name="signal_amount" required>
               </div>
               <div class="mb-3">
                  <label for="percentage" class="form-label">Percentage</label>
                  <input type="number" class="form-control" id="percentage" name="percentage" required>
               </div>
               <button type="submit" class="btn btn-primary">Add Signal</button>
            </form>
         </div>
      </div>
      <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount ($)</th>
                <th>Percentage (%)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($signals as $signal)
                <tr>
                    <td>{{ $signal->name }}</td>
                    <td>{{ $signal->amount }}</td>
                    <td>{{ $signal->percentage }}%</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('signal.edit', $signal->id) }}" class="btn btn-primary btn-sm">Edit</a>
                           <!-- Delete Button -->
                         <form action="{{ route('signal.destroy', $signal->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE') <!-- This is crucial to send a DELETE request -->
                           <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this signal?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>
</div>
@endsection