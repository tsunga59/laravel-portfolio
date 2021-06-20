@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<section class="articles create">
    <div class="container">
        <form action="{{ route('articles.store') }}" method="post" class="article_form">
            @csrf
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h2>新規投稿フォーム</h2>
            @include('articles.form')
            <button type="submit" class="btn green">投稿する</button>
        </form>
    </div>
</section>

@endsection