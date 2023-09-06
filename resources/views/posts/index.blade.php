@extends('layouts.auth')

@section('title', __('posts.index.title'))

@section('content_header')
<ul class="list-inline mb-0">
    <li class="list-inline-item me-5"><strong>{{ __('posts.index.title') }}</strong></li>
</ul>
@stop

@section('create-btn', route('posts.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
                        <th>{{ __('labels.title') }}</th>
            <th>{{ __('labels.content') }}</th>
            <th>{{ __('labels.user_id') }}</th>

            <th width="350"></th>
        </tr>
    </thead>
    <tbody id="tbody">
        @forelse ($posts as $post)
        <tr>
                        <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            <td>{{ $post->user_id }}</td>

            <td align="right">@include('layouts.actions', ['route' => 'posts', 'entity' => $post])</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">{{ __('labels.empty') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
{!! $posts->links() !!}
@stop