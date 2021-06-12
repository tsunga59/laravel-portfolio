<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 投稿へのコメント処理
     * 
     * @param CommentRequest $request, Article $article
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, Article $article)
    {
        
    }
}
