@extends('layouts.auth')

@section('title', __('extras.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('extras.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('extras.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
            
            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($extras as $extra)
        <tr>
            
            <td align="right">@include('layouts.actions', ['route' => 'extras', 'entity' => $extra])</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $extras->links() !!}
@stop