<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImgRequest;
use App\Models\Img;
use App\Repositories\ImgRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ImgController extends Controller
{
    public function __construct(ImgRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $imgs = $this->repository->getAllPaginated();

        return view('imgs.index', compact('imgs'));
    }

    public function create(): View
    {
        $imgs = Img::all();

        return view('imgs.create', compact('imgs'));
    }

    public function store(StoreImgRequest $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $imgs = $this->repository->create($create);

        return redirect()->route('imgs.index')->with('success', __('labels.added'));
    }

    public function edit(Img $img): View
    {

        return view('imgs.edit', compact('img'));
    }

    public function update(Request $request, Img $img): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($img->id, $update);

        return redirect()->route('imgs.edit', $img->id)->with('success', __('labels.updated'));
    }

    public function destroy(Img $img): RedirectResponse
    {
        $img->delete();

        return redirect()->route('imgs.index')->with('error', __('labels.deleted'));
    }

}