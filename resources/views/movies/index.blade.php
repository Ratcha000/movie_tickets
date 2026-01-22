<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Reviews</title>
    <link rel="stylesheet" href="{{ asset('sccs/review.css') }}">
</head>

<body>
    <a href="/" class="btn-back">Back</a>
    <div class="container">
        <h1>Movie Reviews List</h1>
        <div class="movie-grid">
            @foreach ($movies as $movie)
                <div class="movie-card">
                    <a href="/movies/{{ $movie->id }}">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="Movie Poster" class="movie-poster">
                    <h3>{{ $movie->title }}</h3>
                    <p>Director: {{ $movie->director }}</p>
                    <p>IMDb: {{ $movie->rating }}/10</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
