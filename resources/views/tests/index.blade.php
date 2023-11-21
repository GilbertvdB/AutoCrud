@extends('layouts.auth')

@section('title', __('tests.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('tests.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('tests.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('Names') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($tests as $test)
        <tr>
                        <td>{{ $test->names }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'tests', 'entity' => $test])</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $tests->links() !!}
@stop