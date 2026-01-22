<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movie - {{ $movie->title }}</title>
</head>
<body>
    <h1>Are you sure you want to delete "{{ $movie->title }}"?</h1>
    
    <p>Director: {{ $movie->director }}</p>
    <p>Release Date: {{ $movie->release_date }}</p>
    <p>Genre: {{ $movie->genre }}</p>
    <p>Rating: {{ $movie->rating }}/10</p>
    <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }} Poster" style="width: 300px;">

    <!-- ฟอร์มสำหรับยืนยันการลบหนัง -->
    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this movie?');">Delete Movie</button>
    </form>
</body>
</html>