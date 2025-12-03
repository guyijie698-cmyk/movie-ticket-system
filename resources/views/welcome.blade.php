<!DOCTYPE html>
<html>
<head>
    <title>Movie Ticket System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px 20px; text-align: center; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .card { background: white; border-radius: 10px; padding: 20px; margin: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 12px 24px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        .btn-admin { background: #2196F3; }
        .btn-user { background: #9C27B0; }
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .feature-item { padding: 15px; border-left: 4px solid #2196F3; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎬 Movie Ticket Booking System</h1>
        <p>A Laravel web application for movie ticket management</p>
    </div>
    
    <div class="container">
        <div class="card">
        <h2>🚀 Quick Access</h2>
        <p>
            <a href="/movies" class="btn">Browse All Movies</a>
            <a href="/login" class="btn btn-admin">Login to System</a>
            <a href="/movies?admin=1" class="btn btn-admin">Admin Demo</a>
            <a href="/movies" class="btn btn-user">User Demo</a>
        </p>
                <a href="/movies" class="btn">Browse All Movies</a>
                <a href="/movies/create" class="btn">Add New Movie (Admin)</a>
                <a href="/movies?admin=1" class="btn btn-admin">View as Admin</a>
                <a href="/movies" class="btn btn-user">View as Regular User</a>
            </p>
        </div>
        
        <div class="card">
            <h2>📋 System Features</h2>
            <div class="features">
                <div class="feature-item">
                    <h3>🎞️ Movie Management</h3>
                    <p>Full CRUD operations for movies</p>
                    <p>Database migrations and models</p>
                </div>
                <div class="feature-item">
                    <h3>👥 User Authentication</h3>
                    <p>Simulated login system</p>
                    <p>Role-based access control (Admin/User)</p>
                </div>
                <div class="feature-item">
                    <h3>🌐 Deployment</h3>
                    <p>Hosted on AWS Ubuntu server</p>
                    <p>Publicly accessible domain</p>
                </div>
                <div class="feature-item">
                    <h3>🔒 Security</h3>
                    <p>CSRF protection</p>
                    <p>Input validation</p>
                    <p>SQL injection prevention</p>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h2>📊 Technical Implementation</h2>
            <ul>
                <li><strong>Framework:</strong> Laravel 12</li>
                <li><strong>Database:</strong> MySQL 8.0</li>
                <li><strong>Server:</strong> Apache 2.4 on AWS Ubuntu</li>
                <li><strong>PHP:</strong> 8.2</li>
                <li><strong>Architecture:</strong> MVC pattern</li>
                <li><strong>Authentication:</strong> Session-based with role management</li>
            </ul>
        </div>
        
        <div class="card">
            <h2>🧪 Demo Accounts</h2>
            <p>For demonstration purposes, use URL parameters to switch roles:</p>
            <ul>
                <li><strong>Admin Mode:</strong> Add <code>?admin=1</code> to URLs</li>
                <li><strong>User Mode:</strong> Remove <code>?admin=1</code> parameter</li>
            </ul>
            <p>Example: <code>http://51.20.116.163/movies?admin=1</code></p>
        </div>
    </div>
</body>
</html>
