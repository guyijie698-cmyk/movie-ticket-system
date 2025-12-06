<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieImageController extends Controller
{
    public function uploadPoster(Request $request, Movie $movie)
    {
        $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $movie->poster = $path;
            $movie->save();
        }

        return back()->with('success', 'Poster uploaded successfully');
    }

    public function deletePoster(Movie $movie)
    {
        if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->poster = null;
        $movie->save();

        return back()->with('success', 'Poster deleted successfully');
    }
}
