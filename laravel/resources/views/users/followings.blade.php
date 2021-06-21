@extends('layouts.app')

@section('title', 'フォロー一覧')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            @include('users.user')
            <div class="article_area">
                @include('users.nav', ['hasArticles' => false, 'hasLikes' => false])
                @forelse($followings as $person)
                @include('users.person_card')
                @empty
                <div class="card">
                    <p class="no_comments">フォロー中のユーザーが見つかりません。</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection