@extends('layouts.app')

@section('title', '新規投稿')

@section('content')

<section class="articles create">
    <div class="container">
        <form action="{{ route('articles.store') }}" method="post">
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
            <dl>
                <dt>
                    <label for="content">投稿本文</label>
                </dt>
                <dd>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                </dd>
                <dt>
                    <label for="tag">タグ(最大3個)</label>
                </dt>
                <dd>
                    <input type="text" name="tag" id="tag" value="{{ old('tag') }}">
                </dd>
            </dl>
            <button type="submit" class="btn green">投稿する</button>
        </form>
    </div>
</section>

@endsection