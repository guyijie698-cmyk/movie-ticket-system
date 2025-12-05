<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Movie Ticket System</a>
            <div class="text-light">
                Welcome, {{ session('user_name') }} ({{ session('user_role') }})
                <a href="/movies" class="btn btn-outline-light btn-sm ms-2">Back to Movies</a>
                <a href="/logout" class="btn btn-outline-light btn-sm ms-2">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Movie: {{ $movie->title }}</h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/movies/{{ $movie->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Movie Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="{{ old('title', $movie->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="3" required>{{ old('description', $movie->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genre" class="form-label">Genre *</label>
                                    <input type="text" class="form-control" id="genre" name="genre" 
                                           value="{{ old('genre', $movie->genre) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="duration" class="form-label">Duration (minutes) *</label>
                                    <input type="number" class="form-control" id="duration" name="duration" 
                                           value="{{ old('duration', $movie->duration) }}" min="1" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="release_date" class="form-label">Release Date *</label>
                                    <input type="date" class="form-control" id="release_date" name="release_date" 
                                           value="{{ old('release_date', $movie->release_date) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price ($) *</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                           value="{{ old('price', $movie->price) }}" min="0" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/movies" class="btn btn-secondary me-md-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Movie</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
