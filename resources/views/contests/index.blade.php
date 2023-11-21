@extends('layouts.auth')

@section('title', __('contests.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('contests.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('contests.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('Title') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Content') }}</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Blok1-title') }}</th>
            <th>{{ __('Blok1-content') }}</th>
            <th>{{ __('Blok1-image') }}</th>
            <th>{{ __('Blok2-title') }}</th>
            <th>{{ __('Blok2-content') }}</th>
            <th>{{ __('Blok2-image') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($contests as $contest)
        <tr>
                        <td>{{ $contest->title }}</td>
            <td>{{ $contest->date }}</td>
            <td>{{ $contest->content }}</td>
            <td>{{ $contest->image }}</td>
            <td>{{ $contest->blok1-title }}</td>
            <td>{{ $contest->blok1-content }}</td>
            <td>{{ $contest->blok1-image }}</td>
            <td>{{ $contest->blok2-title }}</td>
            <td>{{ $contest->blok2-content }}</td>
            <td>{{ $contest->blok2-image }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'contests', 'entity' => $contest])</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $contests->links() !!}
@stop