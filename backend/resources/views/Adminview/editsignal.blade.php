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
                <form action="{{ route('signal.update', $signal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $signal->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount ($)</label>
                        <input type="number" name="amount" class="form-control" value="{{ $signal->amount }}" required>
                    </div>

                    <div class="form-group">
                        <label for="percentage">Percentage (%)</label>
                        <input type="number" name="percentage" class="form-control" value="{{ $signal->percentage }}" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection