<!DOCTYPE html>
<html>
<head>
    <title>Add New Movie</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { min-height: 100px; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-submit { background: #28a745; color: white; }
        .btn-cancel { background: #6c757d; color: white; }
        .required { color: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <div style="max-width: 600px; margin: 0 auto;">
            <h1>Add New Movie</h1>
            <p>
                <a href="/movies?admin=1" style="color: white; text-decoration: none;">← Back to Movies</a>
            </p>
        </div>
    </div>
    
    <div class="container">
        <form action="/movies?admin=1" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="title">Movie Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" required placeholder="Enter movie title">
            </div>
            
            <div class="form-group">
                <label for="description">Description <span class="required">*</span></label>
                <textarea id="description" name="description" required placeholder="Enter movie description"></textarea>
            </div>
            
            <div class="form-group">
                <label for="duration">Duration (minutes) <span class="required">*</span></label>
                <input type="number" id="duration" name="duration" required min="1" placeholder="e.g., 120">
            </div>
            
            <div class="form-group">
                <label for="release_date">Release Date <span class="required">*</span></label>
                <input type="date" id="release_date" name="release_date" required>
            </div>
            
            <div class="form-group">
                <label for="genre">Genre <span class="required">*</span></label>
                <input type="text" id="genre" name="genre" required placeholder="e.g., Action, Drama, Comedy">
            </div>
            
            <div class="form-group">
                <label for="price">Price ($) <span class="required">*</span></label>
                <input type="number" id="price" name="price" step="0.01" min="0" required placeholder="e.g., 12.99">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-submit">Add Movie</button>
                <a href="/movies?admin=1" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p><strong>Note:</strong> This form demonstrates CRUD operations with validation.</p>
            <p>All fields are validated on the server before saving to the database.</p>
        </div>
    </div>
</body>
</html>
