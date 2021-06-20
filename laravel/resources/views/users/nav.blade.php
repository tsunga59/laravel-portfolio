<ul class="nav_list">
    <li>
        <a href="{{ route('users.show', ['user' => $user]) }}" class="{{ $hasArticles ? 'active' : '' }}">投稿</a>
    </li>
    <li>
        <a href="{{ route('users.likes', ['user' => $user]) }}" class="{{ $hasLikes ? 'active' : '' }}">いいね</a>
    </li>
</ul>