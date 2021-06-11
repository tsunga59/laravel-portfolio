@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<section class="articles create">
    <div class="container">
        <form action="{{ route('articles.update', ['article' => $article]) }}" method="post">
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
                    <textarea name="content" id="content">{{ old('content') ?? $article->content }}</textarea>
                </dd>
                <dt>
                    <label for="tag">タグ(最大3個)</label>
                </dt>
                <dd>
                    <input type="text" name="tag" id="tag" value="{{ old('tag') }}">
                </dd>
            </dl>
            <button type="submit" class="btn green">編集する</button>
        </form>
    </div>
</section>

@endsection