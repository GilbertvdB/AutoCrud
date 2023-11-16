@extends('layouts.auth')

@section('title', __('pics.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('pics.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('pics.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('Name') }}</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Active') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($pics as $pic)
        <tr>
                        <td>{{ $pic->name }}</td>
            <td>{{ $pic->image }}</td>
            <td>{{ $pic->active }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'pics', 'entity' => $pic])</td>
        </tr>
        @empty
        <tr>
            <td colspan="12">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $pics->links() !!}
@stop