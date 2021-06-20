@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')

<section class="users edit">
    <div class="container">
        <form action="{{ route('users.update', ['user' => $user]) }}" method="post" enctype="multipart/form-data" class="user_form">
            @csrf
            @method('patch')
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @elseif(Auth::id() == config('user.guest_user_id'))
                <div class="error_area">
                    <p>ゲストユーザーはプロフィール画像・ユーザー名を編集できません。</p>
                </div>
            @endif
            <h2>プロフィール編集フォーム</h2>
            @include('users.form')
            <button type="submit" class="btn green">編集する</button>
        </form>
    </div>
</section>

@endsection