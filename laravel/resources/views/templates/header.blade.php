<header class="header">
    <nav>
        <ul>
            @guest
            <li><a href="{{ route('register') }}">ユーザー登録</a></li>
            <li><a href="{{ route('login') }}">ログイン</a></li>
            @endguest

            @auth
            <li><a href="{{ route('articles.create') }}">投稿する</a></li>
            <li><a href="">{{ Auth::user()->name }}</a></li>
            @endauth
        </ul>
    </nav>
</header>