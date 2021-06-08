トップ・記事一覧

<form id="logout-button" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">logout</button>
</form>