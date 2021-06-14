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
     * @param CommentRequest $request, Comment $comment, Article $article
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, Comment $comment, Article $article)
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
        // $article->comments()->detach($request->user()->id);

        // return [
        //     'id' => $article->id,
        //     'countComments' => $article->count_comments,
        // ];
    }
}
