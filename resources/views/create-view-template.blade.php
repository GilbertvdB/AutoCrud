@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Create {{ $model }}</h1>

    <form method="POST" action="{{ route($model . '.store') }}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    @foreach ($fillableProperties as $property)
                    <div class="form-group mb-3">
                        {{-- <label for="{{ $property }}" class="@if ($errors->has('{{ $property }}')) text-danger @endif">{{ __('labels.{{ $property }}') }}</label>
                        <input type="text" id="{{ $property }}" class="form-control @if ($errors->has('{{ $property }}')) is-invalid @endif"
                        placeholder="{{ __('labels.{{ $property }}') }}..." value="{{ old('{{ $property }}') }}"> --}}
                        <div class="form-group">
                            <label for="{{ $property }}">{{ ucwords(str_replace('_', ' ', $property)) }}</label>
                            <input type="text" name="{{ $property }}" id="{{ $property }}" class="form-control" value="{{ old($property) }}" required>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection