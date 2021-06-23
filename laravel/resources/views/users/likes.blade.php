@extends('layouts.app')

@section('title', 'いいねした投稿一覧')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            @include('users.user')
            <div class="article_area">
                @include('users.nav', ['hasArticles' => false, 'hasLikes' => true])
                @forelse($articles as $article)
                @include('articles.card')
                @empty
                <div class="card">
                    <p class="no_comments">いいねした投稿が見つかりません。</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection