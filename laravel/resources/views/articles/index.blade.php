@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')

<section class="articles index">
    <div class="container">
        <div class="card_area">
            @foreach($articles as $article)
                @include('articles.card')
            @endforeach
        </div>
        <div class="sidebar">
            @include('articles.sidebar')
        </div>
    </div>
    @if(session('achievement_message'))
    <!-- 朝活達成ポップアップ -->
    @include('articles.modal')
    @endif
</section>

@endsection