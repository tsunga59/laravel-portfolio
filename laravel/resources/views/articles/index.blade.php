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
                    <a href="">{{ $article->user->name }}</a>
                    <span>{{ $article->created_at->format('Y/m/d H:i') }}</span>
                </div>
                @if(Auth::id() === $article->user_id)
                <div class="profile_menu">
                    <a href="{{ route('articles.edit', ['article' => $article]) }}" class="edit-btn pc"><i class="fas fa-edit"></i>編集</a>
                    <button form="delete-button" class="delete-btn pc" onclick="confirmDelete()"><i class="fas fa-trash-alt"></i>削除</button>
                    <a href="{{ route('articles.edit', ['article' => $article]) }}" class="edit-btn sp" ><i class="fas fa-edit fa-lg"></i></a>
                    <button form="delete-button" class="delete-btn sp" onclick="confirmDelete()"><i class="fas fa-trash-alt fa-lg"></i></button>
                </div>
                <form id="delete-button" method="post" action="{{ route('articles.destroy', ['article' => $article]) }}" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
                @endif
            </div>
            <div class="content_area">
                <a href="{{ route('articles.show', ['article' => $article]) }}">
                    {!! nl2br(e($article->content)) !!}
                </a>
                @foreach($article->tags as $tag)
                    @if($loop->first)
                    <div class="tag_area">
                    @endif
                    <a href="{{ route('tags.show', ['name' => $tag->name]) }}">{{ $tag->hash_tag }}</a>
                    @if($loop->last)
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="reaction_area">
                <div class="comment">
                    <a href="{{ route('articles.show', ['article' => $article]) }}">
                        <i class="far fa-comment fa-lg"></i>
                    </a>
                    <span>{{ $article->count_comments }}</span>
                </div>
                <article-like
                 :initial-has-like='@json($article->hasLike(Auth::user()))'
                 :initial-count-likes='@json($article->count_likes)'
                 :authorized='@json(Auth::check())'
                 endpoint="{{ route('articles.like', ['article' => $article]) }}"
                >
                </article-like>
            </div>
            <hr>
            @foreach($article->comments as $comment)
                @if($loop->first)
                <div class="comment_area">
                @endif
                @if($loop->index < 2)
                <p>{{ $comment->comment }} {{ $comment->created_at->format('Y/m/d H:i') }}</p>
                @endif
                @if($loop->last)
                <a href="{{ route('articles.show', ['article' => $article]) }}">すべてのコメントを見る</a>
                </div>
                @endif
            @endforeach
        </div>
        @endforeach
    </div>
</section>

@endsection