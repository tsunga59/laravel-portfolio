@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')

<section class="articles show">
    <div class="container">
        <div class="card">
            <div class="profile_area">
                <a href="" class="profile_image">
                    {{-- <img src=""> --}}
                    <i class="far fa-user fa-2x"></i>
                </a>
                <div class="profile_text">
                    <div class="profile_text">
                        <a href="">{{ $article->user->name }}</a>
                        <span>{{ $article->created_at->format('Y/m/d H:i') }}</span>
                    </div>
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
                {!! nl2br(e($article->content)) !!}
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
                    <button type="button">
                        <i class="far fa-comment fa-lg"></i>
                    </button>
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
            <div class="comment_area">
                @forelse($article->comments as $comment)
                <p>{{ $comment->comment }} {{ $comment->created_at->format('Y/m/d H:i') }}</p>
                @empty
                <p>コメントがありません。</p>
                @endforelse
                <form action="{{ route('comments.store', ['article' => $article]) }}" method="post" class="comment_form">
                    @csrf
                    <textarea name="comment" placeholder="コメントを入力する"></textarea>
                    <button type="submit" class="btn green">送信する</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection