@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')

<section class="register">
    <div class="container">
        <form action="{{ route('register.{provider}', ['provider' => $provider]) }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
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
                        <input type="email" name="email" id="email" placeholder="メールアドレス" value="{{ $email }}" disabled>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn red">Googleで登録</button>
            <a href="{{ route('login') }}" class="redirect">ログインはこちら</a>
        </form>
    </div>
</section>
@endsection