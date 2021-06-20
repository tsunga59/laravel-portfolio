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
            @include('articles.form')
            <button type="submit" class="btn green">編集する</button>
        </form>
    </div>
</section>

@endsection