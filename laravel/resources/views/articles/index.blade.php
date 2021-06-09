{{ Auth::user()->name }}
<br>
{{ Auth::user()->email }}
<br>
<br>
<form id="logout-button" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">logout</button>
</form>