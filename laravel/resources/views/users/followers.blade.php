@extends('layouts.app')

@section('title', 'フォロワー一覧')

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
                            <a href="{{ route('users.followings', ['user' => $user]) }}"><span>{{ $user->count_followings }}</span>フォロー</a>
                            <a href="{{ route('users.followers', ['user' => $user]) }}"><span>{{ $user->count_followers }}</span>フォロワー</a>
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
                      :authorized='@json(Auth::check())'
                      endpoint="{{ route('users.follow', ['user' => $user]) }}"
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
                    <p>{{ $user->count_achievements }}日</p>
                </li>
                <li>
                    <i class="far fa-chart-bar fa-2x"></i>
                    <h2>朝活達成率</h2>
                    <p>{{ $user->calc_achievements }}%</p>
                </li>
            </ul>
            <div class="article_area">
                <ul class="nav_list">
                    <li>
                        <a href="{{ route('users.show', ['user' => $user]) }}">投稿</a>
                    </li>
                    <li>
                        <a href="{{ route('users.likes', ['user' => $user]) }}">いいね</a>
                    </li>
                </ul>
                @foreach($followers as $person)
                <div class="person_card">
                    <a href="{{ route('users.show', ['user' => $person]) }}" class="person_image">
                        @if(!empty($person->profile_image))
                        <img src="/storage/profile_images/{{ $person->profile_image }}">
                        @else
                        <i class="far fa-user fa-2x"></i>
                        @endif
                    </a>
                    <a href="{{ route('users.show', ['user' => $person]) }}" class="person_name">
                        {{ $person->name }}
                    </a>
                    @if(!Auth::id() === $person->id)
                    <div class="person_menu">
                      <follow-button
                       :initial-has-followed='@json($user->hasFollowed(Auth::user()))'
                       :authorized='@json(Auth::check())'
                       endpoint="{{ route('users.follow', ['user' => $user]) }}"
                      >
                      </follow-button>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection