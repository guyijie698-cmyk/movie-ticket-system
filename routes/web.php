<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Login page
Route::get('/login', function () {
    return view('auth.login');
});

// Process login
Route::post('/login', function () {
    $request = request();
    $email = $request->email;
    $password = $request->password;

    // Demo accounts
    $validAccounts = [
        'admin@movie.com' => ['password' => 'password', 'role' => 'admin'],
        'user@example.com' => ['password' => 'password', 'role' => 'user']
    ];

    if (isset($validAccounts[$email]) && $password == $validAccounts[$email]['password']) {
        // Set session
        session([
            'logged_in' => true,
            'user_email' => $email,
            'user_role' => $validAccounts[$email]['role'],
            'user_name' => $email == 'admin@movie.com' ? 'Admin User' : 'Regular User',
            'user_id' => $email
        ]);

        // Redirect based on role
        if ($validAccounts[$email]['role'] == 'admin') {
            return redirect('/movies')->with('success', 'Welcome Admin!');
        } else {
            return redirect('/movies')->with('success', 'Welcome!');
        }
    }

    // Invalid credentials
    return back()->with('error', 'Invalid credentials. Use demo accounts: admin@movie.com / password');
});

// Logout
Route::get('/logout', function () {
    session()->flush();
    return redirect('/')->with('success', 'Logged out successfully');
});

// Movie CRUD routes - USING CONTROLLER
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/create', [MovieController::class, 'create']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/movies/{id}/edit', [MovieController::class, 'edit']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

// Registration routes
Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', function () {
    $request = request();
    
    // 简单验证
    $validated = $request->validate([
        'name' => 'required|min:2|max:50',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);
    
    // 检查邮箱是否已存在（模拟）
    $existingUsers = [
        'admin@movie.com' => 'Admin User',
        'user@example.com' => 'Regular User'
    ];
    
    if (isset($existingUsers[$request->email])) {
        return back()->with('error', 'Email already registered. Please use another email or login.');
    }
    
    // 模拟用户创建 - 在实际项目中这里会保存到数据库
    // 这里我们只是创建session，模拟注册成功
    
    // 随机分配用户角色（70%普通用户，30%管理员 - 仅用于演示）
    $role = (rand(1, 10) > 7) ? 'admin' : 'user';
    
    session([
        'logged_in' => true,
        'user_email' => $request->email,
        'user_name' => $request->name,
        'user_role' => $role,
        'user_id' => 'user_' . time() . rand(100, 999)
    ]);
    
    // 记录新用户（在实际项目中这里会保存到数据库）
    $newUser = [
        'email' => $request->email,
        'name' => $request->name,
        'role' => $role,
        'registered_at' => now()->toDateTimeString()
    ];
    
    // 可以记录到文件或日志（可选）
    file_put_contents(
        storage_path('app/new_users.log'),
        json_encode($newUser) . PHP_EOL,
        FILE_APPEND
    );
    
    return redirect('/movies')->with('success', 'Registration successful! Welcome to Movie Ticket System.');
});

// Comment Routes
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/api/comments', [CommentController::class, 'getComments'])->name('comments.get');

// Test route for polymorphic relationship
Route::get('/test-polymorphic', function() {
    $movie = App\Models\Movie::first();
    if ($movie) {
        $comments = $movie->comments;
        return response()->json([
            'movie' => $movie->title,
            'comments_count' => $comments->count(),
            'average_rating' => $movie->averageRating()
        ]);
    }
    return 'No movies found';
});
// Movie Image Routes
Route::post('/movies/{movie}/upload-poster', function (\Illuminate\Http\Request $request, \App\Models\Movie $movie) {
    $request->validate(['poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
    if ($request->hasFile('poster')) {
        $path = $request->file('poster')->store('posters', 'public');
        $movie->poster = $path;
        $movie->save();
    }
    return back()->with('success', 'Poster uploaded successfully');
})->name('movies.upload-poster');
Route::delete('/movies/{movie}/delete-poster', function (\App\Models\Movie $movie) {
    if ($movie->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($movie->poster)) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($movie->poster);
    }
    $movie->poster = null;
    $movie->save();
    return back()->with('success', 'Poster deleted successfully');
})->name('movies.delete-poster');
