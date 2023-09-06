@extends('layouts.auth')

@section('title', __('stuffs.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('stuffs.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('stuffs.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('labels.name') }}</th>
            <th>{{ __('labels.job') }}</th>
            <th>{{ __('labels.active') }}</th>
            <th>{{ __('labels.user_id') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($stuffs as $stuff)
        <tr>
                        <td>{{ $stuff->name }}</td>
            <td>{{ $stuff->job }}</td>
            <td>{{ $stuff->active }}</td>
            <td>{{ $stuff->user_id }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'stuffs', 'entity' => $stuff])</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $stuffs->links() !!}
@stop