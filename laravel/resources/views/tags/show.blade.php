@extends('layouts.app')

@section('title', $tag->hash_tag)

@section('content')

<section class="articles tags-show">
    <div class="container">
        <div class="title-tag">
            <h2>{{ $tag->hash_tag }}</h2>
            <p>{{ $tag->articles->count() }}件の投稿</p>
        </div>
        @foreach($tag->articles as $article)
        @include('articles.card')
        @endforeach
    </div>
</section>

@endsection