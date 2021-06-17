@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')

<section class="users show">
    <div class="container">
        <div class="card">
            <div class="profile_top">
                <div class="profile_left">
                    <div class="profile_image">
                        @if(!empty($user->profile_image))
                        <img src="/storage/profile_images/{{ $user->profile_image }}">
                        @else
                        <i class="far fa-user fa-4x"></i>
                        @endif
                    </div>
                </div>
                <div class="profile_right">
                    <div class="profile_text">
                        <p class="name">{{ $user->name }}</p>
                        <div class="info">
                            <p><span>{{ $user->count_articles }}</span>投稿</p>
                            <a href=""><span>3</span>フォロー</a>
                            <a href=""><span>5</span>フォロワー</a>
                        </div>
                        <p class="message">{!! nl2br(e($user->self_introduction)) !!}</p>
                    </div>
                </div>
                <div class="profile_menu">
                    @if(Auth::id() === $user->id)
                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="profile-edit-btn"><i class="fas fa-edit"></i>編集</a>
                    @else
                    <follow-button
                      :initial-has-followed='@json($user->hasFollowed(Auth::user()))'
                    >
                    </follow-button>
                    @endif
                </div>
            </div>
            <ul class="achivement_area">
                <li>
                    <i class="far fa-clock fa-2x"></i>
                    <h2>朝活目標時間</h2>
                    <p>{{ substr($user->wakeup_time, 0, 5) }}</p>
                </li>
                <li>
                    <i class="far fa-calendar-alt fa-2x"></i>
                    <h2>朝活達成日数</h2>
                    <p>10日</p>
                </li>
                <li>
                    <i class="far fa-chart-bar fa-2x"></i>
                    <h2>朝活達成率</h2>
                    <p>75%</p>
                </li>
            </ul>
            <div class="article_area">
                <ul class="nav_list">
                    <li>
                        <a href="{{ route('users.show', ['user' => $user]) }}" class="active">投稿</a>
                    </li>
                    <li>
                        <a href="{{ route('users.likes', ['user' => $user]) }}">いいね</a>
                    </li>
                </ul>
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
        </div>
    </div>
</section>

@endsection