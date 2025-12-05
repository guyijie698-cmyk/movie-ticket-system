<!DOCTYPE html>
<html>
<head>
    <title>Movies List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .alert { padding: 15px; margin: 15px 0; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .movie-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .movie-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .movie-content { padding: 15px; }
        .movie-title { margin: 0 0 10px 0; font-size: 1.2em; }
        .btn { display: inline-block; padding: 8px 16px; text-decoration: none; border-radius: 4px; margin: 5px 5px 5px 0; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
<div class="header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1>Movies List</h1>
                Welcome, {{ session('user_name') }} ({{ session('user_role') }})
            </div>
            <div>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
        <p>
            <a href="/" class="btn btn-primary">Home</a>
            @if($isAdmin)
                <a href="/movies/create" class="btn btn-success">Add New Movie</a>
                <span style="color: #ffc107;">🔒 Admin Mode Active</span>
            @else
                <a href="/movies?admin=1" class="btn btn-warning">Switch to Admin Mode</a>
                <span>👤 User Mode</span>
            @endif
        </p>
    </div>
</div>
    </div>
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        
        <div class="movie-grid">
            @forelse($movies as $movie)
            <div class="movie-card">
                <div class="movie-content">
                    <h3 class="movie-title">{{ $movie->title }}</h3>
                    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                    <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                    <p><strong>Price:</strong> ${{ number_format($movie->price, 2) }}</p>
                    <p><strong>Released:</strong> {{ date('M d, Y', strtotime($movie->release_date)) }}</p>
                    
                    <div style="margin-top: 15px;">
                        <a href="/movies/{{ $movie->id }}" class="btn btn-primary">View Details</a>
                        
                        @if($isAdmin)
                            <a href="/movies/{{ $movie->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/movies/{{ $movie->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete movie?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p>No movies found in the database.</p>
                @if($isAdmin)
                    <a href="/movies/create" class="btn btn-success">Add First Movie</a>
                @endif
            </div>
            @endforelse
        </div>
        
        <div style="margin-top: 30px; text-align: center;">
            <p>Total Movies: {{ $movies->count() }}</p>
            <p><a href="/">Back to Home</a></p>
        </div>
    </div>
</body>
</html>
