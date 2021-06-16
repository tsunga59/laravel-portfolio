@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<section class="articles edit">
    <div class="container">
        <form action="{{ route('articles.update', ['article' => $article]) }}" method="post" class="article_form">
            @csrf
            @method('patch')
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h2>投稿編集フォーム</h2>
            <dl>
                <dt>
                    <label for="content">投稿本文</label>
                </dt>
                <dd>
                    <textarea name="content" id="content" rows="8">{{ old('content') ?? $article->content }}</textarea>
                </dd>
                <dt>
                    <label for="tags">タグ(最大5個)</label>
                </dt>
                <dd>
                    <article-tags-input
                     :initial-tags='@json($tagNames ?? [])'
                     :autocomplete-items='@json($allTagNames ?? [])'
                    >
                    </article-tags-input>
                </dd>
            </dl>
            <button type="submit" class="btn green">編集する</button>
        </form>
    </div>
</section>

@endsection