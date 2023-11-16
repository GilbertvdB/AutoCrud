@extends('layouts.auth')

@section('title', __('imgs.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('imgs.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('imgs.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('Name') }}</th>
            <th>{{ __('Path') }}</th>
            <th>{{ __('User Id') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($imgs as $img)
        <tr>
                        <td>{{ $img->name }}</td>
            <td>{{ $img->path }}</td>
            <td>{{ $img->user_id }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'imgs', 'entity' => $img])</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $imgs->links() !!}
@stop