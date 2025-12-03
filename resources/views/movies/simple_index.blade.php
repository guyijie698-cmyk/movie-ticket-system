<!DOCTYPE html>
<html>
<head>
    <title>Movies List</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .movie { border: 1px solid #ddd; padding: 15px; margin: 10px 0; }
        .btn { background: #007bff; color: white; padding: 8px 15px; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Movies List</h1>
    
    @if(session('success'))
        <div style="color:green; padding:10px; background:#e8f5e8;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="color:red; padding:10px; background:#ffe6e6;">
            {{ session('error') }}
        </div>
    @endif
    
    <?php $isAdmin = session('user_role') === 'admin'; ?>
    
    @if($isAdmin)
        <a href="/movies/create" class="btn">Add New Movie</a>
        <p><small>You are logged in as Admin</small></p>
    @endif
    
    @if(session('user_id') && !$isAdmin)
        <p><small>You are logged in as User</small></p>
    @endif
    
    @if(!session('user_id'))
        <p><small><a href="/login">Login</a> to access admin features</small></p>
    @endif
    
    @foreach($movies as $movie)
    <div class="movie">
        <h3>{{ $movie->title }}</h3>
        <p><strong>Genre:</strong> {{ $movie->genre }}</p>
        <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
        <p><strong>Price:</strong> ${{ $movie->price }}</p>
        <a href="/movies/{{ $movie->id }}">View Details</a>
    </div>
    @endforeach
    
    <p><a href="/">Home</a></p>
</body>
</html>
