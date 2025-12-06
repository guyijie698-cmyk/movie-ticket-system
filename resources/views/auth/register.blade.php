<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Movie Ticket System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; min-height: 100vh; display: flex; align-items: center; padding: 20px; }
        .register-card { background: white; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); max-width: 400px; margin: 0 auto; padding: 30px; }
        .btn-register { background: #007bff; color: white; width: 100%; padding: 10px; }
        .btn-register:hover { background: #0056b3; color: white; }
    </style>
</head>
<body>
    <div class="register-card">
        <h2 class="text-center mb-4">Create Account</h2>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-register">Register</button>
        </form>
        
        <div class="text-center mt-3">
            <a href="/login">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
