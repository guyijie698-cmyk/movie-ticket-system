<!DOCTYPE html>
<html>
<head>
    <title>Register - Movie Tickets</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 400px; margin: 0 auto; }
        .card { border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Register</h1>
        
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password (min. 6 characters)</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <p style="margin-top: 15px; text-align: center;">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </p>
        <p style="text-align: center;">
            <a href="/">Back to Home</a>
        </p>
    </div>
</body>
</html>
