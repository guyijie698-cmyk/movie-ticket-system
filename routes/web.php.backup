<?php
use Illuminate\Support\Facades\Route;
use App\Models\Movie;

// 首页
Route::get('/', function () {
    return view('welcome');
});

// 登录页面
Route::get('/login', function () {
    return view('auth.login');
});

// 处理登录
Route::post('/login', function () {
    $request = request();
    $email = $request->email;
    $password = $request->password;
    
    // 演示账户验证
    $validAccounts = [
        'admin@movie.com' => ['password' => 'password', 'role' => 'admin'],
        'user@example.com' => ['password' => 'password', 'role' => 'user']
    ];
    
    if (isset($validAccounts[$email]) && $password === $validAccounts[$email]['password']) {
        // 设置会话
        session([
            'logged_in' => true,
            'user_email' => $email,
            'user_role' => $validAccounts[$email]['role'],
            'user_name' => $email === 'admin@movie.com' ? 'Admin User' : 'Regular User'
        ]);
        
        // 根据角色重定向
        if ($validAccounts[$email]['role'] === 'admin') {
            return redirect('/movies?admin=1')->with('success', 'Welcome Admin!');
        } else {
            return redirect('/movies')->with('success', 'Welcome!');
        }
    }
    
    // 无效凭证
    return back()->with('error', 'Invalid credentials. Use demo accounts: admin@movie.com / password');
});

// 退出登录
Route::get('/logout', function () {
    session()->flush();
    return redirect('/')->with('success', 'Logged out successfully');
});

// 电影列表 - 检查登录状态
Route::get('/movies', function () {
    // 检查是否已登录
    if (!session('logged_in')) {
        return redirect('/login')->with('error', 'Please login first');
    }
    
    $movies = Movie::all();
    $isAdmin = session('user_role') === 'admin' || request()->has('admin');
    
    return view('movies.list', [
        'movies' => $movies,
        'isAdmin' => $isAdmin,
        'userName' => session('user_name'),
        'userRole' => session('user_role'),
        'success' => session('success'),
        'error' => session('error')
    ]);
});

// 添加电影页面 - 需要管理员权限
Route::get('/movies/create', function () {
    if (!session('logged_in')) {
        return redirect('/login')->with('error', 'Please login first');
    }
    
    if (session('user_role') !== 'admin' && !request()->has('admin')) {
        return redirect('/movies')->with('error', 'Admin access required');
    }
    
    return view('movies.create');
});

// 处理添加电影
Route::post('/movies', function () {
    if (!session('logged_in') || (session('user_role') !== 'admin' && !request()->has('admin'))) {
        return redirect('/movies')->with('error', 'Admin access required');
    }
    
    $request = request();
    
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'duration' => 'required|integer|min:1',
        'release_date' => 'required|date',
        'genre' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);
    
    Movie::create($request->all());
    
    return redirect('/movies?admin=1')->with('success', 'Movie added successfully!');
});

// 电影详情
Route::get('/movie/{id}', function ($id) {
    if (!session('logged_in')) {
        return redirect('/login')->with('error', 'Please login first');
    }
    
    $movie = Movie::find($id);
    
    if (!$movie) {
        return redirect('/movies')->with('error', 'Movie not found');
    }
    
    return view('movies.detail', [
        'movie' => $movie,
        'isAdmin' => session('user_role') === 'admin'
    ]);
});
