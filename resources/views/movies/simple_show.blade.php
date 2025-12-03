<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie->title }}</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .movie-details { border: 1px solid #ddd; padding: 20px; }
    </style>
</head>
<body>
    <h1>{{ $movie->title }}</h1>
    <div class="movie-details">
        <p><strong>Description:</strong> {{ $movie->description }}</p>
        <p><strong>Genre:</strong> {{ $movie->genre }}</p>
        <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
        <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
        <p><strong>Price:</strong> ${{ $movie->price }}</p>
    </div>
    <p><a href="/movies">Back to Movies List</a> | <a href="/">Home</a></p>
</body>
</html>
