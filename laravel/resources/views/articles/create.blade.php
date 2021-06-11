@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<section class="articles create">
    <div class="container">
        <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h2>新規投稿フォーム</h2>
            <dl>
                <dt>
                    <label for="content">投稿本文</label>
                </dt>
                <dd>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                </dd>
                <dt>
                    <label for="tags">タグ(最大5個)</label>
                </dt>
                <dd>
                    <article-tags-input
                     :initial-tags='@json($tagNames ?? [])'
                    >
                    </article-tags-input>
                </dd>
            </dl>
            <button type="submit" class="btn green">投稿する</button>
        </form>
    </div>
</section>

@endsection