<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtraRequest;
use App\Models\Extra;
use App\Repositories\ExtraRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function __construct(ExtraRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $extras = $this->repository->getAllPaginated();

        return view('extras.index', compact('extras'));
    }

    public function create(): View
    {
        $extras = Extra::all();

        return view('extras.create', compact('extras'));
    }

    public function store(StoreExtraRequest $request): RedirectResponse
    {
        $create = $request->except(['_token']);
        $extras = $this->repository->create($create);

        return redirect()->route('extras.index')->with('success', __('labels.added'));
    }

    public function edit(Extra $extra): View
    {

        return view('extras.edit', compact('extra'));
    }

    public function update(Request $request, Extra $extra): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($extra->id, $update);

        return redirect()->route('extras.edit', $extra->id)->with('success', __('labels.updated'));
    }

    public function destroy(Extra $extra): RedirectResponse
    {
        $extra->delete();

        return redirect()->route('extras.index')->with('error', __('labels.deleted'));
    }
}
