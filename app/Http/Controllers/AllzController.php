<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllzRequest;
use App\Models\Allz;
use App\Repositories\AllzRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AllzController extends Controller
{
    public function __construct(AllzRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $allzs = $this->repository->getAllPaginated();

        return view('allzs.index', compact('allzs'));
    }

    public function create(): View
    {
        $allzs = Allz::all();

        return view('allzs.create', compact('allzs'));
    }

    public function store(StoreAllzRequest $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $allzs = $this->repository->create($create);

        return redirect()->route('allzs.index')->with('success', __('labels.added'));
    }

    public function edit(Allz $allz): View
    {

        return view('allzs.edit', compact('allz'));
    }

    public function update(Request $request, Allz $allz): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($allz->id, $update);

        return redirect()->route('allzs.edit', $allz->id)->with('success', __('labels.updated'));
    }

    public function destroy(Allz $allz): RedirectResponse
    {
        $allz->delete();

        return redirect()->route('allzs.index')->with('error', __('labels.deleted'));
    }

}