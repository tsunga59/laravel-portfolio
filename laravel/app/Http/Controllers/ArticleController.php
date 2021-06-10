<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 投稿を一覧表示
     * 
     * @return view
     */
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');

        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * 投稿の新規作成画面を表示
     * 
     * @return view
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * 投稿の新規作成処理
     * 
     * @param ArticleRequest $request, Article $article
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article->user_id = $request->user()->id;
        // $article->content = $request->content;
        $article->fill($request->all());
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * 投稿の詳細を表示
     * 
     * @param Article $article
     * @return view
     */
    public function show(Article $article)
    {

    }

    /**
     * 投稿の更新画面を表示
     * 
     * @param Article $article
     * @return view
     */
    public function edit(Article $article)
    {

    }

    /**
     * 投稿の更新処理
     * 
     * @param ArticleRequest $request, Article $article
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {

    }

    /**
     * 投稿の削除処理
     * 
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article)
    {

    }
}
