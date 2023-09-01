<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $posts = $this->repository->getAllPaginated();

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        $posts = Post::all();

        return view('posts.create', compact('posts'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $posts = $this->repository->create($create);

        return redirect()->route('posts.index')->with('success', __('labels.added'));
    }

    public function edit(Post $post): View
    {

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($post->id, $update);

        return redirect()->route('posts.edit', $post->id)->with('success', __('labels.updated'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')->with('error', __('labels.deleted'));
    }

}