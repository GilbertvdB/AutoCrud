<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContestRequest;
use App\Models\Contest;
use App\Repositories\ContestRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContestController extends Controller
{
    public function __construct(ContestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $contests = $this->repository->getAllPaginated();

        return view('contests.index', compact('contests'));
    }

    public function create(): View
    {
        $contests = Contest::all();

        return view('contests.create', compact('contests'));
    }

    public function store(StoreContestRequest $request): RedirectResponse
    {   dd($request->all());
        $create = $request->except(['_token']);
        $contests = $this->repository->create($create);

        // if ($request->image !== null) {
        //     $file = $request->file('image');
        //     $filename = date('Y_m_d_His').'_'. $file->getClientOriginalName();
        //     $path = $file->storeAs('images', $filename);
        //     $create['image'] = $filename;
        // }

        return redirect()->route('contests.index')->with('success', __('labels.added'));
    }

    public function edit(Contest $contest): View
    {

        return view('contests.edit', compact('contest'));
    }

    public function update(Request $request, Contest $contest): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($contest->id, $update);

        return redirect()->route('contests.edit', $contest->id)->with('success', __('labels.updated'));
    }

    public function destroy(Contest $contest): RedirectResponse
    {
        $contest->delete();

        return redirect()->route('contests.index')->with('error', __('labels.deleted'));
    }

}