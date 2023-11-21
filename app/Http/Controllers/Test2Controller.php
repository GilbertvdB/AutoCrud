<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTest2Request;
use App\Models\Test2;
use App\Repositories\Test2Repository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class Test2Controller extends Controller
{
    public function __construct(Test2Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $test2s = $this->repository->getAllPaginated();

        return view('test2s.index', compact('test2s'));
    }

    public function create(): View
    {
        $test2s = Test2::all();

        return view('test2s.create', compact('test2s'));
    }

    public function store(StoreTest2Request $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $test2s = $this->repository->create($create);

        return redirect()->route('test2s.index')->with('success', __('labels.added'));
    }

    public function edit(Test2 $test2): View
    {

        return view('test2s.edit', compact('test2'));
    }

    public function update(Request $request, Test2 $test2): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($test2->id, $update);

        return redirect()->route('test2s.edit', $test2->id)->with('success', __('labels.updated'));
    }

    public function destroy(Test2 $test2): RedirectResponse
    {
        $test2->delete();

        return redirect()->route('test2s.index')->with('error', __('labels.deleted'));
    }

}