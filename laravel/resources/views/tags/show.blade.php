@extends('layouts.app')

@section('title', $tag->hash_tag)

@section('content')

<section class="articles tags-show">
    <div class="container">
        <div class="card_area">
            <div class="title-tag">
                <h2>{{ $tag->hash_tag }}</h2>
                <p>{{ $tag->articles->count() }}件の投稿</p>
            </div>
            @foreach($tag->articles as $article)
                @include('articles.card')
            @endforeach
        </div>
        <div class="sidebar" id="js-sidebar">
            @include('articles.sidebar')
        </div>
    </div>
    <!-- SP時のランキング表示ボタン -->
    <div class="sidebar_open_btn sp" id="js-sidebar-open-btn">
        <i class="far fa-file-alt fa-lg"></i>
    </div>
</section>

@endsection