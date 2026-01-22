<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($movie) ? 'Edit Movie' : 'Add New Movie' }}</title>
    <link rel="stylesheet" href="{{ asset('sccs/create.css') }}">
</head>
<body>

    <!-- ฟอร์มสำหรับสร้างหรือแก้ไขหนัง -->
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">        @csrf
        @if(isset($movie))
            @method('PUT') <!-- ใช้ PUT สำหรับแก้ไขหนัง -->
        @endif
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ isset($movie) ? $movie->title : '' }}" required><br>

        <label for="director">Director:</label>
        <input type="text" name="director" id="director" value="{{ isset($movie) ? $movie->director : '' }}" required><br>

        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" id="release_date" value="{{ isset($movie) ? $movie->release_date : '' }}" required><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" value="{{ isset($movie) ? $movie->genre : '' }}" required><br>

        <label for="rating">Rating IMDb (1-10):</label>
        <input type="number" name="rating" id="rating" min="1" max="10" step="0.1" value="{{ isset($movie) ? $movie->rating : '' }}" required><br>

        <label for="poster">Movie Poster:</label>
        <input type="file" name="poster" id="poster" accept="image/*"><br>
    
        <button type="submit">{{ isset($movie) ? 'Update Movie' : 'Add Movie' }}</button>
    </form>
</body>
</html>