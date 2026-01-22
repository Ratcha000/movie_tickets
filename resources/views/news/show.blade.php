<title>{{ $news->title }}</title>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./script.js"></script>
@extends('layout')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-4 text-success">{{ $news->title }}</h2>
                <h6 class="mb-4 text-success">
                    <span>{{ $news->category }}</span> |
                    <span class="text-muted">{{ \Carbon\Carbon::parse($news->date)->format('d M Y') }}</span>
                </h6>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img-fluid rounded" style="max-height: 500px">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <div class="mt-4">
                    <h5 class="text-success">รายละเอียดข่าว</h5>
                    <p>{!! nl2br(e($news->description)) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
