@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create test</h1>

    <form method="POST" action="{{ route('tests.update'), test }}" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                    <div class="form-group mb-3">
                        <label for="names" class="@if ($errors->has('names')) text-danger @endif">{{ __('labels.names') }}</label>
                        <input type="file" multiple id="names" name="names[]" class="form-control-file @if ($errors->has('names')) is-invalid @endif">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection