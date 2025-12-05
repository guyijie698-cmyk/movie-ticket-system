<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct()
    {
        // 简单检查：是否有 user_id 会话
        $this->middleware(function ($request, $next) {
            $path = $request->path();
            if (in_array($path, ['movies/create', 'movies/store']) && !session('user_id')) {
                return redirect('/login')->with('error', 'Please login first');
            }
            return $next($request);
        });
    }
    
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
        // 检查是否是管理员
        if (session('user_role') !== 'admin') {
            return redirect('/movies')->with('error', 'Admin access required');
        }
        
        return view('movies.simple_create');
    }
    
    public function store(Request $request)
    {
        // 检查是否是管理员
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
        
        return redirect('/movies')->with('success', 'Movie added successfully!');
    }
    
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.simple_show', compact('movie'));
    }
}
