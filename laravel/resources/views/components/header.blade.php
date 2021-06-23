<header class="header">
    <a href="{{ route('articles.index') }}" class="logo">
        <img src="/images/logo.png" alt="Acmo">
        Acmo
    </a>
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
            <li class="sp"><a href="{{ route('articles.create') }}"><i class="fas fa-edit fa-2x"></i></a></li>
            <li class="dropdown">
                @if(!empty(Auth::user()->profile_image))
                <img src="/storage/profile_images/{{ Auth::user()->profile_image }}">
                @else
                <i class="far fa-user fa-lg"></i>
                @endif
                <div class="dropdown-content">
                    <a href="{{ route('users.show', ['user' => Auth::user()]) }}">
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