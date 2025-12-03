@extends('layouts.app')

@section('title', 'Movies List')

@section('content')
    <h1>Movies List</h1>
    
    @auth
        @if(Auth::user()->role === 'admin')
            <p><a href="/movies/create" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none;">Add New Movie</a></p>
        @endif
    @endauth
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @foreach($movies as $movie)
        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
            <h3>{{ $movie->title }}</h3>
            <p><strong>Genre:</strong> {{ $movie->genre }}</p>
            <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
            <p><strong>Price:</strong> ${{ $movie->price }}</p>
            <a href="/movies/{{ $movie->id }}">View Details</a>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="/movies/{{ $movie->id }}/edit" style="color: #ffc107;">Edit</a>
                    <form action="/movies/{{ $movie->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: #dc3545; background: none; border: none; cursor: pointer;">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
        @endforeach
    </div>
    
    @if($movies->isEmpty())
        <p>No movies found.</p>
    @endif
@endsection
