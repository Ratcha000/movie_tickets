<title>Movie</title>
@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/field.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./script.js"></script>
    <div class="container mt-5">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Now">กำลังฉาย</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Coming">โปรแกรมหน้า</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content mt-4">
            <div id="Now" class="tab-pane fade show active">
                <div class="row">
                    @foreach ($nowShowing as $movie)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a class="nav-link p-0" href="{{ url('/stime/' . $movie->id) }}">
                                    <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->name }}">
                                    <div class="card-body">
                                        <h6 class="card-text text-success">
                                            {{ \Carbon\Carbon::parse($movie->date)->format('d M Y') }}</h6>
                                        <h4 class="card-title">{{ $movie->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="Coming" class="tab-pane fade">
                <div class="row">
                    @foreach ($comingSoon as $movie)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a class="nav-link p-0" href="{{ url('/stime/' . $movie->id) }}">
                                    <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->name }}">
                                    <div class="card-body">
                                        <h6 class="card-text text-success">
                                            {{ \Carbon\Carbon::parse($movie->date)->format('d M Y') }}</h6>
                                        <h4 class="card-title">{{ $movie->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
