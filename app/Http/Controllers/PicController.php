<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePicRequest;
use App\Models\Pic;
use App\Repositories\PicRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PicController extends Controller
{
    public function __construct(PicRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $pics = $this->repository->getAllPaginated();

        return view('pics.index', compact('pics'));
    }

    public function create(): View
    {
        $pics = Pic::all();

        return view('pics.create', compact('pics'));
    }

    public function store(StorePicRequest $request): RedirectResponse
    {   
        // $path = $request->file('image')->store('images');
        // $path = $request->file('image')->storeAs('images', $request->user()->id);
        // dd($name);
        $create = $request->except(['_token']);

        if($request->image !== null){
            $file = $request->file('image');
            $filename = date('Y_m_d_His').'_'. $file->getClientOriginalName();
            $path = $file->storeAs('images', $filename);
            $create['image'] = $filename;
        }
        
        $pics = $this->repository->create($create);

        return redirect()->route('pics.index')->with('success', __('labels.added'));
    }

    public function edit(Pic $pic): View
    {

        return view('pics.edit', compact('pic'));
    }

    public function update(Request $request, Pic $pic): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        
        if($request->image !== null){
            $file = $request->file('image');
            $filename = date('Y_m_d_His').'_'. $file->getClientOriginalName();
            Storage::delete('images/'.$pic->image);
            $path = $file->storeAs('images', $filename);
            $create['image'] = $filename;
        }

        $this->repository->update($pic->id, $update);

        return redirect()->route('pics.edit', $pic->id)->with('success', __('labels.updated'));
    }

    public function destroy(Pic $pic): RedirectResponse
    {
        Storage::delete('images/'.$pic->image);
        $pic->delete();

        return redirect()->route('pics.index')->with('error', __('labels.deleted'));
    }

}