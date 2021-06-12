<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Tag;
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
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });
        
        return view('articles.create', ['allTagNames' => $allTagNames]);
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
        $article->fill($request->all());
        $article->save();

        // タグ作成・投稿に紐付け
        $request->tags->each(function($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

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
        return view('articles.show', ['article' => $article]);
    }

    /**
     * 投稿の更新画面を表示
     * 
     * @param Article $article
     * @return view
     */
    public function edit(Article $article)
    {
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });
        
        $tagNames = $article->tags->map(function($tag) {
            return ['text' => $tag->name];
        });
        
        return view('articles.edit', [
            'article' => $article,
            'allTagNames' => $allTagNames,
            'tagNames' => $tagNames,
        ]);
    }

    /**
     * 投稿の更新処理
     * 
     * @param ArticleRequest $request, Article $article
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();

        $article->tags()->detach();
        $request->tags->each(function($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index');
    }

    /**
     * 投稿の削除処理
     * 
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
