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
                <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Plan Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="min_amount">Minimum Amount ($)</label>
                        <input type="number" name="min_amount" id="min_amount" class="form-control" value="{{ old('min_amount', $plan->min_amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="max_amount">Maximum Amount ($)</label>
                        <input type="number" name="max_amount" id="max_amount" class="form-control" value="{{ old('max_amount', $plan->max_amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration (Days)</label>
                        <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration', $plan->duration) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="roi">ROI (%)</label>
                        <input type="number" step="0.01" name="roi" id="roi" class="form-control" value="{{ old('roi', $plan->roi) }}" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update Plan</button>
                </form>
            </div>
        </div>
    </div>
@endsection