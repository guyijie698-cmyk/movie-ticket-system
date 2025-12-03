<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin: 5px; }
        .btn-primary { background: #007bff; color: white; }
        .movie-info { margin: 20px 0; }
        .movie-info p { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <div style="max-width: 800px; margin: 0 auto;">
            <h1>{{ $movie->title }}</h1>
            <p>
                <a href="/movies" class="btn btn-primary">Back to Movies</a>
                <a href="/" class="btn btn-primary">Home</a>
            </p>
        </div>
    </div>
    
    <div class="container">
        <div class="movie-info">
            <h2>Movie Details</h2>
            <p><strong>Title:</strong> {{ $movie->title }}</p>
            <p><strong>Description:</strong></p>
            <p>{{ $movie->description }}</p>
            <p><strong>Genre:</strong> {{ $movie->genre }}</p>
            <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
            <p><strong>Release Date:</strong> {{ date('F j, Y', strtotime($movie->release_date)) }}</p>
            <p><strong>Price:</strong> ${{ number_format($movie->price, 2) }}</p>
            <p><strong>Added:</strong> {{ $movie->created_at->format('M d, Y H:i') }}</p>
        </div>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <h3>Actions</h3>
            <a href="/movies" class="btn btn-primary">Browse More Movies</a>
            @if(request()->has('admin'))
                <a href="/movies/create" class="btn btn-primary">Add Another Movie</a>
            @endif
        </div>
    </div>
</body>
</html>
