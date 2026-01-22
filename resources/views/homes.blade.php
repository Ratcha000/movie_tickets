<title>Home</title>
@extends('layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#newsImageCarousel').carousel({
                interval: 5000,
                wrap: true,
                ride: 'carousel'
            });

            $('#newsImageCarousel').on('slid.bs.carousel', function() {
                const $this = $(this);
                const $active = $this.find('.carousel-item.active');
                const isLastSlide = $active.is(':last-child');
                const isFirstSlide = $active.is(':first-child');

                if (isLastSlide) {
                    $this.find('.carousel-item').eq(0).addClass(
                    'next-seamless'); // เตรียมภาพแรกสำหรับสไลด์ถัดไป
                }
                if (isFirstSlide) {
                    $this.find('.carousel-item').eq(-1).addClass(
                    'prev-seamless'); // เตรียมภาพสุดท้ายสำหรับสไลด์ถัดไป
                }

                // ลบคลาสเมื่อไม่จำเป็นแล้ว
                $this.find('.carousel-item').removeClass('next-seamless prev-seamless');
            });
        });
    </script>

    <style>
        .carousel-item {
            transition: transform 1s ease-in-out, opacity 1s ease-in-out;
        }

        /* ปรับแต่งให้เปลี่ยนภาพได้อย่างสมูท */
        .next-seamless,
        .prev-seamless {
            transition: none !important;
            /* ยกเลิก transition สำหรับการเปลี่ยนแบบวนลูป */
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            max-height: 550px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                max-height: 300px;
            }
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/field.css') }}">

    <div class="container mt-5">
        <div id="newsImageCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                @foreach ($news->take(3) as $key => $newsItem)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <a href="{{ route('news.show', $newsItem->id) }}">
                            <img src="{{ asset($newsItem->imgslide) }}" class="d-block w-100" alt="{{ $newsItem->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#newsImageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="#newsImageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
        </div>
    </div>

    <div class="container mt-5 section-container">
        <h2 class="section-title">กำลังฉาย</h2>
        <div class="row">
            @foreach ($nowShowing as $movie)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a class="nav-link p-0" href="{{ url('/stime/' . $movie->id) }}">
                            <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->name }}">
                            <div class="card-body">
                                <h6 class="card-text text-success">
                                    {{ \Carbon\Carbon::parse($movie->date)->format('d M Y') }}</h6>
                                <h5 class="card-title">{{ $movie->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container section-container">
        <h2 class="section-title">โปรแกรมหน้า</h2>
        <div class="row">
            @foreach ($comingSoon as $movie)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a class="nav-link p-0" href="{{ url('/stime/' . $movie->id) }}">
                            <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->name }}">
                            <div class="card-body">
                                <h6 class="card-text text-success">
                                    {{ \Carbon\Carbon::parse($movie->date)->format('d M Y') }}</h6>
                                <h5 class="card-title">{{ $movie->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('movie') }}" class="btn-custom">
                ภาพยนตร์ทั้งหมด
            </a>
        </div>
    </div><br>

    <div class="container section-container">
        <h2 class="section-title">โปรโมชั่นสุดพิเศษ</h2>
        <div class="row">
            @foreach ($promotions as $promotion)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a class="nav-link p-0" href="{{ route('promotions.show', $promotion->id) }}">
                            <img src="{{ $promotion->image }}" class="card-img-top-pro" alt="{{ $promotion->title }}">
                            <div class="card-body">
                                <h5 class="card-text text-success">{{ $promotion->title }}</h5>
                                <h6 class="card-text">{{ $promotion->description }}</h6>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('promotions') }}" class="btn-custom">
                โปรโมชั่นทั้งหมด
            </a>
        </div>
    </div><br>

    <div class="container section-container">
        <h2 class="section-title">ข่าวสารและกิจกรรม</h2>
        <div class="row">
            @foreach ($news as $newsItem)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a class="nav-link" href="{{ route('news.show', $newsItem->id) }}">
                            <img src="{{ $newsItem->image }}" class="card-img-top-news" alt="{{ $newsItem->title }}">
                            <div class="card-body text-center">
                                <h6 class="card-text text-success">{{ $newsItem->category }}</h6>
                                <h5 class="card-tleti">{{ $newsItem->title }}</h5>
                                <h6 class="card-text text-muted">
                                    {{ \Carbon\Carbon::parse($newsItem->date)->format('d M Y') }}</h6>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('news') }}" class="btn-custom">
                ข่าวสารและกิจกรรมทั้งหมด
            </a>
        </div>
    </div>
@endsection
