<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Models\Test;
use App\Repositories\TestRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $tests = $this->repository->getAllPaginated();

        return view('tests.index', compact('tests'));
    }

    public function create(): View
    {
        $tests = Test::all();

        return view('tests.create', compact('tests'));
    }

    public function store(StoreTestRequest $request): RedirectResponse
    {
        $create = $request->except(['_token']);
        $tests = $this->repository->create($create);

        return redirect()->route('tests.index')->with('success', __('labels.added'));
    }

    public function edit(Test $test): View
    {

        return view('tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($test->id, $update);

        return redirect()->route('tests.edit', $test->id)->with('success', __('labels.updated'));
    }

    public function destroy(Test $test): RedirectResponse
    {
        $test->delete();

        return redirect()->route('tests.index')->with('error', __('labels.deleted'));
    }
}
