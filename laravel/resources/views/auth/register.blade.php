@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')

<section class="register">
    <div class="container">
        <form action="{{ url('/register') }}" method="post">
            @csrf
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h2>ユーザー登録フォーム</h2>
            <table>
                <tr>
                    <th>
                        <label for="name"><i class="fas fa-user"></i></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" placeholder="ユーザー名" autofocus value="{{ old('name') }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email"><i class="fas fa-envelope"></i></label>
                    </th>
                    <td>
                        <input type="email" name="email" id="email" placeholder="メールアドレス" value="{{ old('email') }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="password"><i class="fas fa-lock"></i></label>
                    </th>
                    <td>
                        <input type="password" name="password" id="password" placeholder="パスワード(8文字以上)">
                    </td>
                </tr>
            </table>
            <button type="submit" class="green">メールアドレスで登録</button>
            <p class="add">or</p>
            <button class="red">Googleで登録</button>
            <a href="{{ route('login') }}">ログインはこちら</a>
        </form>
    </div>
</section>
@endsection