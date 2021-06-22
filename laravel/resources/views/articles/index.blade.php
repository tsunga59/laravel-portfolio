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
        <div class="sidebar" id="js-sidebar">
            @include('articles.sidebar')
        </div>
    </div>
    @if(session('achievement_message'))
    <!-- 朝活達成ポップアップ -->
    @include('articles.modal')
    @endif
    <!-- SP時のランキング表示・非表示ボタン -->
    <div class="sidebar_btn sp" id="js-sidebar-btn">
        <i class="far fa-file-alt fa-lg" id="js-sidebar-icon"></i>
    </div>
</section>

@endsection