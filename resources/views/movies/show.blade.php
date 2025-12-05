<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie->title }} - Movie Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .movie-details { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .movie-title { color: #333; margin-bottom: 20px; }
        .movie-info { margin-bottom: 10px; }
        .back-link { margin-top: 20px; }
        .btn { display: inline-block; padding: 8px 16px; text-decoration: none; border-radius: 4px; margin-right: 10px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="movie-details">
            <h1 class="movie-title">{{ $movie->title }}</h1>
            
            <div class="movie-info">
                <p><strong>Description:</strong> {{ $movie->description }}</p>
                <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                <p><strong>Price:</strong> ${{ number_format($movie->price, 2) }}</p>
                <p><strong>Rating:</strong> {{ $movie->rating }}/10</p>
            </div>
            
            <div class="action-buttons">
                <a href="/movies" class="btn btn-primary">Back to Movies</a>
                
                @if(session('user_role') === 'admin')
                <a href="/movies/{{ $movie->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="/movies/{{ $movie->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
