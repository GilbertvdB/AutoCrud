<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStuffRequest;
use App\Models\Stuff;
use App\Repositories\StuffRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StuffController extends Controller
{
    public function __construct(StuffRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $stuffs = $this->repository->getAllPaginated();

        return view('stuffs.index', compact('stuffs'));
    }

    public function create(): View
    {
        $stuffs = Stuff::all();

        return view('stuffs.create', compact('stuffs'));
    }

    public function store(StoreStuffRequest $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $stuffs = $this->repository->create($create);

        return redirect()->route('stuffs.index')->with('success', __('labels.added'));
    }

    public function edit(Stuff $stuff): View
    {

        return view('stuffs.edit', compact('stuff'));
    }

    public function update(Request $request, Stuff $stuff): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($stuff->id, $update);

        return redirect()->route('stuffs.edit', $stuff->id)->with('success', __('labels.updated'));
    }

    public function destroy(Stuff $stuff): RedirectResponse
    {
        $stuff->delete();

        return redirect()->route('stuffs.index')->with('error', __('labels.deleted'));
    }

}