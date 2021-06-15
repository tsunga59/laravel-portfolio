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
            @endif
            <h2>プロフィール編集フォーム</h2>
            <dl>
                {{-- <span class="avatar-form image-picker">
                    <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                    <label for="avatar" class="d-inline-block">
                        <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                    </label>
                </span> --}}
                <dd class="profile_image_area">
                    <input type="file" name="profile_image" id="profile_image" value="{{ old('profile_image') ?? $user->profile_image }}" style="display: none">
                    <label for="profile_image">
                        @if(isset($user->profile_image))
                        <img src="" accept="image/*" style="width:50px;height:50px;border:1px solid #333;">
                        @else
                        <i class="fas fa-user fa-3x"></i>
                        @endif
                    </label>
                </dd>
                {{-- <dt>
                    <label for="profile_image">
                        <i class="fas fa-user"></i>
                        <input type="file" name="profile_image" id="profile_image" value="{{ old('profile_image') ?? $user->profile_image }}">
                    </label>
                </dt>
                <dd>
                    <img src="" accept="image/*" style="width:50px;height:50px;border:1px solid #333;">
                </dd> --}}
                <dt>
                    <label for="name">ユーザー名</label>
                </dt>
                <dd>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}">
                </dd>
                <dt>
                    <label for="self_introduction">自己紹介・意気込み</label>
                </dt>
                <dd>
                    <textarea name="self_introduction" id="self_introduction" rows="6">{{ old('self_introduction') ?? $user->self_introduction }}</textarea>
                </dd>
                <dt>
                    <label for="wake_up_time">朝活目標時間</label>
                </dt>
                <dd>
                    <input type="text" name="wakeup_time" id="wakeup_time" value="{{ old('wakeup_time') ?? $user->wakeup_time }}">
                    {{-- <select name="" id="">
                        <option value="1"></option>
                    </select> --}}
                </dd>
            </dl>
            <button type="submit" class="btn green">編集する</button>
        </form>
    </div>
</section>

@endsection