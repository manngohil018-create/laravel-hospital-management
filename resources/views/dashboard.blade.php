<h2>Welcome {{ auth()->user()->username }} 🎉</h2>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
