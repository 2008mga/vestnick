<?php

namespace App\Http\Controllers\Api;

use App\NewModel;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function byTag($id)
    {
        $news = Tag::findOrFail($id)
            ->news()
            ->with(['tags' => function ($q) {
                $q->select(['tags.id', 'tags.name']);
            }, 'user'])
            ->simplePaginate(8, [
                'news.id',
                'news.short_name',
                'news.description',
                'news.image',
                'news.user_id',
                'news.views'
                ]);

        return response()->json($news);
    }
}
