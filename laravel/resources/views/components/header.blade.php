<header class="header">
    <h1>
        <a href="{{ route('articles.index') }}">Morning App</a>
    </h1>
    <form action="" method="get" class="pc">
        <input type="text" name="search" placeholder="朝活仲間を探そう！">
        <button><i class="fas fa-search"></i></button>
    </form>
    <nav>
        <ul>
            @guest
            <li class="pc"><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i>ユーザー登録</a></li>
            <li class="pc"><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>ログイン</a></li>
            <li class="sp"><a href="{{ route('register') }}"><i class="fas fa-user-plus fa-lg"></i></a></li>
            <li class="sp"><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-lg"></i></a></li>
            @endguest

            @auth
            <li class="pc"><a href="{{ route('articles.create') }}"><i class="fas fa-edit"></i>投稿する</a></li>
            <li class="sp"><a href="{{ route('articles.create') }}"><i class="fas fa-edit fa-lg"></i></a></li>
            <li class="dropdown">
                <i class="far fa-user fa-lg"></i>
                <div class="dropdown-content">
                    <a href="">
                        {{ Auth::user()->name }}<br>
                        <span>{{ Auth::user()->email }}</span>
                    </a>
                    <button form="logout-button" type="submit" onclick="confirmLogout()">ログアウト</button>
                </div>
            </li>
            <form id="logout-button" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
              </form>
            @endauth
        </ul>
    </nav>
</header>