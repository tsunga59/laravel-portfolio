@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')

<section class="articles index">
    <div class="container">
        @foreach($articles as $article)
        <div class="card">
            <div class="profile_area">
                <a href="" class="profile_image">
                    {{-- <img src=""> --}}
                    <i class="far fa-user fa-2x"></i>
                </a>
                <div class="profile_text">
                    <a href="">ユーザー名</a>
                    <span>2021/06/10</span>
                </div>
                {{-- @if(Auth::id() === $article->user_id) --}}
                <div class="profile_menu">
                    <a href="{{ route('articles.edit', ['article' => $article]) }}" class="edit-btn pc"><i class="fas fa-edit"></i>編集</a>
                    <a href="{{ route('articles.destroy', ['article' => $article]) }}" class="delete-btn pc" onclick="confirmDelete()"><i class="fas fa-trash-alt"></i>削除</a>
                    <a href="{{ route('articles.edit', ['article' => $article]) }}" class="edit-btn sp" ><i class="fas fa-edit fa-lg"></i></a>
                    <a href="{{ route('articles.destroy', ['article' => $article]) }}" class="delete-btn sp" onclick="confirmDelete()"><i class="fas fa-trash-alt fa-lg"></i></a>
                </div>
                {{-- @endif --}}
            </div>
            <div class="content_area">
                {{-- {!! nl2br(e($article->content)) !!} --}}
                <a href="{{ route('articles.show', ['article' => $article]) }}">テキストテキストテキスト<br>テキストテキストテキストテキスト</a>
                <div class="tag_area">
                    <a href="">#朝活</a>
                    <a href="">#目標</a>
                </div>
            </div>
            <div class="reaction_area">
                <a href="" class="comment">
                    <i class="far fa-comment fa-lg"></i>
                    <span>5</span>
                </a>
                <a href="" class="like">
                    <i class="far fa-heart fa-lg"></i>
                    <span>3</span>
                </a>
            </div>
            <hr>
            <div class="comment_area">
                <a href="{{ route('articles.show', ['article' => $article]) }}">すべてのコメントを見る</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection