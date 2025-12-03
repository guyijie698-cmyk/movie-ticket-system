<!DOCTYPE html>
<html>
<head>
    <title>Login - Movie Ticket System</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            overflow: hidden;
        }
        .login-header {
            background: #333;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .login-body {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #45a049;
        }
        .demo-accounts {
            margin-top: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #2196F3;
        }
        .demo-accounts h3 {
            margin-top: 0;
            color: #333;
        }
        .demo-accounts ul {
            margin: 10px 0 0 0;
            padding-left: 20px;
        }
        .demo-accounts li {
            margin-bottom: 5px;
        }
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .login-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .login-footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🎬 Movie Ticket System</h1>
            <p>Please login to continue</p>
        </div>
        
        <div class="login-body">
            @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
            @endif
            
            <form method="POST" action="/login">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="Enter your email" value="{{ old('email', 'admin@movie.com') }}">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter your password" value="password">
                </div>
                
                <button type="submit" class="btn-login">Login to System</button>
            </form>
            
            <div class="demo-accounts">
                <h3>Demo Accounts</h3>
                <p>For demonstration purposes, use these credentials:</p>
                <ul>
                    <li><strong>Admin:</strong> admin@movie.com / password</li>
                    <li><strong>User:</strong> user@example.com / password</li>
                </ul>
                <p><small>Any other credentials will show an error message.</small></p>
            </div>
            
            <div class="login-footer">
                <p><a href="/">← Back to Home Page</a></p>
                <p><small>This is a simulated login for demonstration purposes.</small></p>
            </div>
        </div>
    </div>
</body>
</html>
