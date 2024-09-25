{{-- <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: dimgray">
    <div class="container">
            <img src="{{ asset('img/wd2.png') }}" alt="Logo" style="height: 70px">
        <div class="ml-auto">
            <a href="{{ route('homeuser') }}" class="navbar-brand mr-2">Home</a>
            <a href="{{ route('tentangkami') }}" class="navbar-brand">About Us</a>
            <a href="{{ route('login') }}" class="navbar-brand">Login</a>
        </div>
    </div>
</nav>  --}}

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(66, 64, 68, 0.959)">
    <div class="container">
            <img src="{{ asset('img/wd2.png') }}" alt="Logo" style="height: 70px">
            <ul class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('homeuser') }}">Home</a>
                    <a class="nav-link" href="{{ route('tentangkami') }}">About Us</a>
                @guest
                    <a class="nav-link" href="{{ route('showLoginForm') }}">Login</a>
                @endguest
                
                @auth
                <a class="nav-link" href="{{ route('profil', Auth::user()->id) }}">Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">Logout</button>
                    </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>
