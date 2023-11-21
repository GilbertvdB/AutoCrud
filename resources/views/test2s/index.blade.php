@extends('layouts.auth')

@section('title', __('test2s.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('test2s.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('test2s.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('Fillings') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($test2s as $test2)
        <tr>
                        <td>{{ $test2->fillings }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'test2s', 'entity' => $test2])</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $test2s->links() !!}
@stop