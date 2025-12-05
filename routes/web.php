<?php
use Illuminate\Support\Facades\Route;
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
