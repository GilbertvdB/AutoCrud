@extends('layouts.auth')

@section('title', __('allzs.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('allzs.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('allzs.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
            <th>{{ __('labels.Name') }}</th>
            <th>{{ __('labels.active') }}</th>
            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($allzs as $allz)
        <tr>
            <td>{{ $allz->Name }}</td>
            <td>{{ $allz->active }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'allzs', 'entity' => $allz])</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $allzs->links() !!}
@stop