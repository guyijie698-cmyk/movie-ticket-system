<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 500px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        button { background: #28a745; color: white; padding: 10px; border: none; }
    </style>
</head>
<body>
    <h1>Add New Movie</h1>
    <form action="/movies" method="POST">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div>
            <label>Duration (minutes):</label>
            <input type="number" name="duration" required>
        </div>
        <div>
            <label>Release Date:</label>
            <input type="date" name="release_date" required>
        </div>
        <div>
            <label>Genre:</label>
            <input type="text" name="genre" required>
        </div>
        <div>
            <label>Price ($):</label>
            <input type="number" step="0.01" name="price" required>
        </div>
        <button type="submit">Add Movie</button>
    </form>
    <p><a href="/movies">Back to Movies</a></p>
</body>
</html>
