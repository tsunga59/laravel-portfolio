@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            @include('users.user')
            <div class="article_area">
                @include('users.nav', ['hasArticles' => true, 'hasLikes' => false])
                @foreach($articles as $article)
                @include('articles.card')
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection