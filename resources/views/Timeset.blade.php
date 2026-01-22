<title>{{ $movie->name }}</title>
@extends('layout')
<link rel="stylesheet" href="{{ asset('s.css') }}">
@section('content')

@if($movie)
<div class="rectangle"></div>
<div class="movie-item">
   <img src="{{ $movie->poster }}" alt="Movie Poster" class="imgd" style="max-width:200px;">
    <p class="name_m"> <b>{{ $movie->name }}</b></p>
    <p class="date_m"> <b> {{ $movie->date }}  |  </b></p>
    <p class="time_m"> <b> {{ \Carbon\Carbon::parse($movie->time)->format('H:i') }}</b></p>
    <p class="loca_m"> <b> {{ $movie->location }} </b></p>
    <p class="map_m"> <b> {{ $movie->map }} </b></p>
</div>
@endif

<hr style="margin-top: 6cm">

<div class="buttontime container">
    <a href="{{ route('booking.index', ['id' => $movie->id]) }}" class="btn btn-outline-success">
        {{ \Carbon\Carbon::parse($movie->time)->format('H:i') }}
    </a>
</div>

<hr style="margin-top: 4cm">
<!--<div class="buttontime2 container">
    <a href="#" class="btn btn-outline-success">13:00</a>
</div>

<div class="buttontime3 container">
    <a href="#" class="btn btn-outline-success">21:00</a>
</div>-->

@endsection
