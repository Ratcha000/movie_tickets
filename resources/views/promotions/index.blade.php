<title>Promotion</title>
@extends('layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                $(target).addClass('show');
            });

            $('a[data-toggle="tab"]').on('hide.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                $(target).removeClass('show');
            });
        });
    </script>
    <link rel="stylesheet" href="{{ asset('css/pro&news.css') }}">

    <div class="container mt-5">
        <h2 class="mb-4 text-success text-center">โปรโมชั่นสุดพิเศษ</h2>

        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#all">ทั้งหมด</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#movie">Movie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#food">Food & Beverage</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <div id="all" class="tab-pane fade-tab show active">
                <div class="row">
                    @foreach ($promotions as $promotion)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a class="nav-link" href="{{ route('promotions.show', $promotion->id) }}">
                                    <img src="{{ $promotion->image }}" class="card-img-top-pro" alt="{{ $promotion->title }}">
                                    <div class="card-body">
                                        <h5 class="card-text text-success">{{ $promotion->title }}</h5>
                                        <h5 class="card-text">{{ $promotion->description }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="movie" class="tab-pane fade-tab">
                <div class="row">
                    @foreach ($Movies as $promotion)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a class="nav-link" href="{{ route('promotions.show', $promotion->id) }}">
                                    <img src="{{ $promotion->image }}" class="card-img-top-pro" alt="{{ $promotion->title }}">
                                    <div class="card-body">
                                        <h5 class="card-text text-success">{{ $promotion->title }}</h5>
                                        <h5 class="card-text">{{ $promotion->description }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="food" class="tab-pane fade-tab">
                <div class="row">
                    @foreach ($Foods as $promotion)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a class="nav-link" href="{{ route('promotions.show', $promotion->id) }}">
                                    <img src="{{ $promotion->image }}" class="card-img-top-pro" alt="{{ $promotion->title }}">
                                    <div class="card-body">
                                        <h5 class="card-text text-success">{{ $promotion->title }}</h5>
                                        <h5 class="card-text">{{ $promotion->description }}</h5>
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
