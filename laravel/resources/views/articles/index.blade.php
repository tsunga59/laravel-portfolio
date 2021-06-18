@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')

<section class="articles index">
    <div class="container">
        @foreach($articles as $article)
        <div class="card">
            <div class="profile_area">
                <a href="{{ route('users.show', ['user' => $article->user]) }}" class="profile_image">
                    @if(!empty($article->user->profile_image))
                    <img src="/storage/profile_images/{{ $article->user->profile_image }}">
                    @else
                    <i class="far fa-user fa-2x"></i>
                    @endif
                </a>
                <div class="profile_text">
                    <a href="{{ route('users.show', ['user' => $article->user]) }}">{{ $article->user->name }}</a>
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
            @forelse($article->comments as $comment)
                @if($loop->first)
                <div class="comment_area">
                @endif
                @if($loop->index < 2)
                <div class="profile_area">
                    <a href="{{ route('users.show', ['user' => $comment->user]) }}" class="profile_image">
                        @if(!empty($comment->user->profile_image))
                        <img src="/storage/profile_images/{{ $comment->user->profile_image }}">
                        @else
                        <i class="far fa-user fa-lg"></i>
                        @endif
                    </a>
                    <div class="profile_text">
                        <div class="profile_text">
                            <a href="{{ route('users.show', ['user' => $comment->user]) }}">{{ $comment->user->name }}</a>
                            <span>{{ $comment->created_at->format('Y/m/d H:i') }}</span>
                        </div>
                    </div>
                    @if(Auth::id() === $comment->user_id)
                    <div class="profile_menu">
                        <button form="comment-delete-button" class="comment-delete-btn" onclick="confirmDelete()"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <form id="comment-delete-button" method="post" action="{{ route('comments.destroy', ['comment' => $comment]) }}" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                    @endif
                </div>
                <p>{!! nl2br(e($comment->comment)) !!}</p>
                <hr>
                @endif
                @if($loop->last)
                <a href="{{ route('articles.show', ['article' => $article]) }}" class="add">すべてのコメントを見る</a>
                </div>
                @endif
            @empty
            <p class="no_comments">コメントがありません。</p>
            @endforelse
        </div>
        @endforeach
    </div>
    @if(session('achievement_message'))
    <!-- 朝活達成ポップアップ -->
    <div class="modal" id="js-modal">
        <div class="modal_card">
            <h2>{{ session('achievement_message') }}</h2>
            {{-- <h2>目標達成おめでとうございます！</h2> --}}
            <p>{{ date('n') }}月の朝活達成日数： <span>{{ Auth::user()->count_achievements }}日</span></p>
            <a href="{{ route('articles.create') }}" class="btn green">仲間に自慢する</a>
            <div class="close_btn" id="js-modal-close">×</div>
        </div>
    </div>
    @endif
</section>

@endsection