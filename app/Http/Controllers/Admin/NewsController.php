<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewStoreRequest;
use App\NewModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewModel::all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(NewStoreRequest $request)
    {
        $new = \Auth::user()->news()->create($request->except([
            'tags'
        ]));

        print_r($new);
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
     * @param NewModel $news
     * @return \Illuminate\Http\Response
     * @internal param NewModel $new
     * @internal param int $id
     */
    public function edit(NewModel $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param NewModel $news
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, NewModel $news)
    {
        $news->fill($request->all());
        $news->save();
        print_r($news->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NewModel $news
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request, NewModel $news)
    {
        $news->delete();

        $request->session()->flash('success', 'Новость удалена');

        return redirect()->route('admin.news.index');
    }
}
