<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * コメントの新規作成処理
     * 
     * @param CommentRequest $request, Article $article, Comment $comment
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, Article $article, Comment $comment)
    {
        $comment->user_id = $request->user()->id;
        $comment->article_id = $article->id;
        $comment->fill($request->all());
        $comment->save();

        return redirect()->back();
    }

    /**
     * コメントの削除処理
     * 
     * @param Request $request, Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
