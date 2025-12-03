<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Movie Ticket System')</title>
    <style>
        body { margin: 0; font-family: Arial; }
        nav { background: #333; padding: 15px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; }
        nav span { color: #ccc; margin-left: auto; }
        .container { padding: 20px; }
        .alert { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .navbar { display: flex; align-items: center; }
        form.inline { display: inline; margin: 0; }
        button.link { background: none; border: none; color: white; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <nav>
        <div class="navbar">
            <div>
                <a href="/">Home</a>
                <a href="/movies">Movies</a>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="/movies/create">Add Movie</a>
                    @endif
                @endauth
            </div>
            <div style="margin-left: auto;">
                @auth
                    <span>Welcome, {{ Auth::user()->name }}</span>
                    <form class="inline" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="link">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>
