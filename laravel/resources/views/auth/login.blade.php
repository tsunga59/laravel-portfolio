@extends('layouts.app')

@section('title', 'ログイン')

@section('content')

<section class="login">
    <div class="container">
        <form action="{{ url('/login') }}" method="post">
            @csrf
            <!-- エラーメッセージ -->
            @if($errors->any())
                <div class="error_area">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h2>ログインフォーム</h2>
            <table>
                <tr>
                    <th>
                        <label for="email"><i class="fas fa-envelope"></i></label>
                    </th>
                    <td>
                        <input type="email" name="email" id="email" placeholder="メールアドレス" autofocus value="{{ old('email') }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="password"><i class="fas fa-lock"></i></label>
                    </th>
                    <td>
                        <input type="password" name="password" id="password" placeholder="パスワード">
                    </td>
                </tr>
                <tr class="border-none">
                    <th>
                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </th>
                    <td>
                        <label class="" for="remember">ログイン状態を保存する</label>
                    </td>
                </tr>
            </table>
            <div class="form-check">
            </div>
            <button type="submit" class="btn green">メールアドレスでログイン</button>
            <p class="add">or</p>
            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn red">Googleでログイン</a>
            <a href="{{ route('login.guest') }}" class="btn gray">ゲストログイン</a>
            <a href="{{ route('register') }}" class="redirect">ユーザー登録はこちら</a>
        </form>
    </div>
</section>
@endsection