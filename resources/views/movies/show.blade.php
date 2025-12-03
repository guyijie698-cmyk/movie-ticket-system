@extends('layouts.app')

@section('title', $movie->title)

@section('content')
    <h1>{{ $movie->title }}</h1>
    
    <div style="display: flex; gap: 30px; margin-top: 20px;">
        @if($movie->poster)
        <div style="flex: 0 0 300px;">
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" style="max-width: 100%; border-radius: 5px;">
        </div>
        @endif
        
        <div style="flex: 1;">
            <p><strong>Description:</strong></p>
            <p>{{ $movie->description }}</p>
            
            <div style="margin-top: 20px;">
                <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                <p><strong>Release Date:</strong> {{ date('F j, Y', strtotime($movie->release_date)) }}</p>
                <p><strong>Price:</strong> ${{ number_format($movie->price, 2) }}</p>
            </div>
            
            @auth
                @if(Auth::user()->role === 'admin')
                <div style="margin-top: 20px;">
                    <a href="{{ route('movies.edit', $movie->id) }}" style="background: #ffc107; color: #000; padding: 8px 15px; text-decoration: none; margin-right: 10px;">Edit</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this movie?')" style="background: #dc3545; color: white; padding: 8px 15px; border: none; cursor: pointer;">Delete</button>
                    </form>
                </div>
                @endif
            @endauth
        </div>
    </div>
    
    <p style="margin-top: 30px;">
        <a href="{{ route('movies.index') }}">Back to Movies List</a>
    </p>
@endsection
