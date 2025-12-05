<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.simple_index', [
            'movies' => $movies,
            'isAdmin' => session('user_role') === 'admin'
        ]);
    }

    public function create()
    {
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }
        return view('movies.simple_create');
    }

    public function store(Request $request)
    {
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'genre' => 'required',
            'price' => 'required|numeric',
        ]);

        Movie::create($request->all());
        return redirect('/movies')->with('success', 'Movie added successfully');
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.simple.show', compact('movie'));
    }

    public function edit($id)
    {
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }
        
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }

        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'genre' => 'required',
            'price' => 'required|numeric',
        ]);

        $movie->update($request->all());
        return redirect('/movies')->with('success', 'Movie updated successfully');
    }

    public function destroy($id)
    {
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }

        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect('/movies')->with('success', 'Movie deleted successfully');
    }
}
