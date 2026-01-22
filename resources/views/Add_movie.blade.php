<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('CSS/addstyle.css')}}">
</head>
<nav><h1>SIGMAPLEX</h1></nav>
<h2>{{ isset($MovieEdit) ? 'Update Movie' : 'Add Movie' }}</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<body>
<form action="{{ isset($MovieEdit) ? '/Add_movie/updated' : '/Add_movie/insert' }}" method="POST" >
    @csrf
    @if(isset($MovieEdit))
            <input type="hidden" name="id" value="{{ $MovieEdit->id }}">
            <label for="id">Movie ID:</label>
            <input type="text" id="id" name="id" value="{{ $MovieEdit->id }}" readonly><br><br>
        @endif
    <label for="poster">Movie Poster:</label>
    <input type="url" id="poster" name="poster"  value="{{ isset($MovieEdit) ? $MovieEdit->poster : '' }}" required><br>

    <label for="name">Movie Name:</label>
    <input type="text" id="name" name="name" value="{{ isset($MovieEdit) ? $MovieEdit->name : '' }}" required><br>

    <label for="name">Location:</label>
    <input type="text" id="location" name="location"  value="{{ isset($MovieEdit) ? $MovieEdit->location : '' }}" required><br>

    <label for="name">Place:</label>
    <input type="text" id="map" name="map"  value="{{ isset($MovieEdit) ? $MovieEdit->map : '' }}" required><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date"  value="{{ isset($MovieEdit) ? $MovieEdit->date : '' }}" required><br>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time"  value="{{ isset($MovieEdit) ? $MovieEdit->time : '' }}" required><br>

    <button type="submit" class="btn {{ isset($MovieEdit) ? 'text-bg-warning' : 'text-bg-primary' }}">Upload</button>
    <a href="/HomeAdmin" class="btn btn-secondary">Back</a>
</form>

</body>
</html>