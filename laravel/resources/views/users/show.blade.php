@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            @include('users.user')
            <div class="article_area">
                @include('users.nav', ['hasArticles' => true, 'hasLikes' => false])
                @forelse($articles as $article)
                @include('articles.card')
                @empty
                <div class="card">
                    <p class="no_comments">投稿が見つかりません。</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection