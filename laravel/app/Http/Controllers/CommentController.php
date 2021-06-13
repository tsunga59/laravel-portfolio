<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * コメントの新規作成処理
     * 
     * @param CommentRequest $request, Comment $comment
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, Comment $comment)
    {
        $comment->user_id = $request->user()->id;
        $comment->fill($request->all());
        $comment->save();

        return redirect()->back();
        
        // $article->comments()->detach($request->user()->id);
        // $article->comments()->attach($request->user()->id);

        // return [
        //     'id' => $article->id,
        //     'countComments' => $article->count_comments,
        // ];
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
