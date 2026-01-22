<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="{{ asset('sccs/show.css') }}">
    
</head>

<body>
    <div class="container">
        <!-- ปุ่มกลับไปยัง Movie Reviews List -->
        <a href="{{ route('movies.index') }}" class="back-button">
            <img src="{{ asset('storage/download1.jpg') }}" alt="Back" width="30" height="30">
            Back 
        </a>

        @if ($movie)
            <div class="movie-card">
                <!-- Display movie poster using URL -->
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="Movie Poster" class="movie-poster">
                <div class="movie-details">
                    <h1>{{ $movie->title }}</h1>
                    <p><strong>Director:</strong> {{ $movie->director }}</p>
                    <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                    <p><strong>IMDb:</strong> {{ $movie->rating }}/10</p>
                </div>
            </div>
            
            <!-- Form for deleting the movie -->
            @if(Auth::check() && Auth::user()->is_admin)
            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this movie?');">Delete Movie</button>
            </form>
           @endif
        
       

            <!-- Display movie reviews -->
            <h2>Reviews</h2>
            <ul>
                @foreach ($movie->comments as $comment)
                    <li>
                        <strong>{{ $comment->reviewer_name }}</strong>: {{ $comment->review }} <br> (Rating: {{ $comment->rating }}/5)
                    </li>
                @endforeach
            </ul>
    
            <!-- Form for submitting a new review -->
            <h3>Submit a Review</h3>
            <form action="{{ route('comments.store', $movie->id) }}" method="POST">
                @csrf
                <label for="reviewer_name">Name:</label>
                <input type="text" name="reviewer_name" id="reviewer_name" required>
    
                <label for="review">Review:</label>
                <textarea name="review" id="review" rows="5" required></textarea>
    
                <label for="rating">Rating:</label>
                <input type="number" name="rating" id="rating" min="1" max="5" required>
    
                <button type="submit" onclick="return confirm('Are you sure you want to review this movie?');">Submit Review</button>
            </form>
        @else
            <!-- Error message if movie is not found -->
            <div class="not-found">
                <h1>Movie Not Found</h1>
                <p>The movie you are looking for does not exist.</p>
            </div>
        @endif
    </div>
</body>

</html>