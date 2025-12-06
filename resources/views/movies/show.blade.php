<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - Movie Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star-rating {
            direction: rtl;
            display: inline-block;
        }
        .star-rating input[type=radio] {
            display: none;
        }
        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 3px;
            cursor: pointer;
        }
        .star-rating input[type=radio]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/movies">Movie Ticket System</a>
            <div class="text-light">
                <a href="/movies" class="btn btn-outline-light">Back to Movies</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <h1>{{ $movie->title }}</h1>
                <p class="lead">{{ $movie->description }}</p>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                        <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                        <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($movie->release_date)->format('F d, Y') }}</p>
                        <p><strong>Price:</strong> ${{ number_format($movie->price, 2) }}</p>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mt-5">
                    <h3>User Comments</h3>
                    
                    <div class="mb-4">
                        <h5>Add Your Comment</h5>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $movie->id }}">
                            <input type="hidden" name="commentable_type" value="App\Models\Movie">
                            
                            <div class="mb-3">
                                <label class="form-label">Rating (Optional)</label>
                                <div class="star-rating">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}">
                                        <label for="star{{$i}}">★</label>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="3" 
                                          placeholder="Write your comment here..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    </div>

                    <div id="comments-list">
                        @if($movie->comments->count() > 0)
                            @foreach($movie->comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="card-subtitle mb-2">
                                                User #{{ $comment->user_id }}
                                                @if($comment->rating)
                                                    <span class="badge bg-warning ms-2">
                                                        @for($i = 0; $i < $comment->rating; $i++)
                                                            ★
                                                        @endfor
                                                    </span>
                                                @endif
                                            </h6>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="card-text">{{ $comment->content }}</p>
                                        
                                        @if(session('user_role') === 'admin' || (session('user_id') && session('user_id') == $comment->user_id))
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Delete this comment?')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                No comments yet. Be the first to comment!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
