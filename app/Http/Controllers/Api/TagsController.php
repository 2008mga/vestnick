<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function inline() {
        $tags = Tag::query()
            ->select(['id', 'name'])
            ->limit(5)
            ->get()
            ->sortBy('news_count');

        return response()->json($tags);
    }
}
