<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function byTag($id)
    {
        $news = Tag::findOrFail($id)
            ->news()
            ->simplePaginate(10);

        return response()->json($news);
    }
}
