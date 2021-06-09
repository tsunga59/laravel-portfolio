@auth
{{ Auth::user()->name }}
<br>
{{ Auth::user()->email }}
<br>
<a href="{{ route('articles.create') }}">投稿する</a>
<br>
<form id="logout-button" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">logout</button>
</form>
@else
<a href="{{ route('register') }}">ユーザー登録</a>
<a href="{{ route('login') }}">ログイン</a>
@endauth