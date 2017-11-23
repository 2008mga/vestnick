<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->except('image'));

        if ($request->has('image')) {
            $tag = $tag->uploadImage($request->file('image'));
        }

        $tag->save();

        $request->session()->flash('success', 'Тег успешно создан');

        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($tag)
    {
        $tag = Tag::findOrFail($tag);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagUpdateRequest|Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TagUpdateRequest $request, $tag)
    {
        $tag = Tag::findOrFail($tag);
        $tag->fill($request->except('image'));

        if ($request->has('image')) {
            $tag = $tag->uploadImage($request->file('image'));
        }

        $tag->save();

        $request->session()->flash('success', 'Тег успешно обновлён');

        return redirect()->route('admin.tags.edit', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request, $tag)
    {
        $tag = Tag::findOrFail($tag);
        $tag->delete();

        $request->session()->flash('success', 'Тег удалён');

        return redirect()->route('admin.tags.index');
    }
}
