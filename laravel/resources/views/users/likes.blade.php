@extends('layouts.app')

@section('title', 'いいねした投稿一覧')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            @include('users.user')
            <div class="article_area">
                @include('users.nav', ['hasArticles' => false, 'hasLikes' => true])
                @foreach($articles as $article)
                @include('articles.card')
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection