<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentStoreRequest;
use App\NewModel;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index() {
        return response()->json(NewModel::all());
    }

    public function byTag($id)
    {
        $news = $this->__prepare(Tag::class, $id)
            ->simplePaginate(8, [
                'news.id',
                'news.short_name',
                'news.description',
                'news.image',
                'news.user_id',
                'news.views',
                'news.display_author'
            ]);

        return response()->json($news);
    }

    public function byUser($id)
    {
        $news = $this->__prepare(User::class, $id)
            ->whereDisplayAuthor(true)
            ->simplePaginate(8, [
                'news.id',
                'news.short_name',
                'news.description',
                'news.image',
                'news.user_id',
                'news.views',
                'news.display_author'
            ]);

        return response()->json($news);
    }

    public function byId($id)
    {
        $new = NewModel::query()
            ->where('is_private', false)
            ->with(['tags', 'comments'])
            ->findOrFail($id);

        return response()->json($new);
    }

    public function comment(CommentStoreRequest $request, $id)
    {
        NewModel::findOrFail($id);

        $user = \Auth::user();
        $comment = $user->comments()->make([
            'new_id' => $id,
            'text' => $request->comment
        ]);

        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->toArray()
        ]);
    }

    private function __prepare($class, $id)
    {
        return $class::findOrFail($id)
            ->news()
            ->whereIsPrivate(false)
            ->with(['tags' => function ($q) {
                $q->select(['tags.id', 'tags.name']);
            }]);
    }
}
