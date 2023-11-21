@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create extra</h1>

    <form method="POST" action="{{ route('extras.store') }}" >
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
</div>
@endsection