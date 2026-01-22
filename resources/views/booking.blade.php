<title>{{ $movie->name }}</title>
@extends('layout2')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
       
        <script>
            function changeImg(id, checkbox) {
                let img = document.getElementById(id);

                if (img.src.includes("5.png")) {
                    img.src = "{{ asset('images/pngegg.png') }}";
                    checkbox.checked = true;
                } else if (img.src.includes("99.png")) {
                    img.src = "{{ asset('images/pngegg.png') }}";
                    checkbox.checked = true;
                } else if (img.src.includes("pngegg.png")) {
                    if (id.startsWith('imgC')) {
                        img.src = "{{ asset('images/99.png') }}";
                    } else {
                        img.src = "{{ asset('images/5.png') }}";
                    }
                    checkbox.checked = false;
                }

                calculateTotal();
            }

            function calculateTotal() {
    const checkboxes = document.querySelectorAll('input[name="ticket[]"]:checked');
    let total = 0;
    let tickets = [];

    checkboxes.forEach((checkbox) => {
        tickets.push(checkbox.value);

        if (checkbox.value.startsWith('C')) {
            total += 380;
        } else {
            total += 180;
        }
    });

    // จัดการแสดงผลที่นั่งที่เลือก และใส่ br ทุก 5 ตัว
    let formattedTickets = '';
    tickets.forEach((ticket, index) => {
        formattedTickets += ticket;

        // ใส่ comma (,) ระหว่างที่นั่ง ยกเว้นตัวสุดท้าย
        if (index < tickets.length - 1) {
            formattedTickets += ', ';
        }

        // ใส่ <br> หลังจากแสดงครบ 5 ตัว
        if ((index + 1) % 8 === 0) {
            formattedTickets += '<br>';
        }
    });

    
    document.getElementById('totalPriceDisplay').innerHTML = `ราคารวมทั้งหมด: ${total} บาท`;
    document.getElementById('selectedSeats').innerHTML = `ที่นั่งที่เลือก: ${formattedTickets}`;

    document.getElementById('totalPrice').value = total;
}
        </script>

        <link rel="stylesheet" href="{{ asset('s.css') }}">
        <link rel="stylesheet" href="{{ asset('s1.css') }}">

    </head>

    <body>
        <div>
            <div class="rectangle"></div>
            <div class="text">SCREEN</div>
            <div class="screen"></div>
            <div class="menu"></div>
            <div class="Seattext">Deluxe 180</div>
            <div class="Seattext2">Luxury 380</div>
            <img src="{{ asset('images/5.png') }}" alt="" class="a0">

            <img src="{{ asset('images/99.png') }}" alt="" class="aa1">
        </div>


        <form id="bookingForm" action="{{ route('booking.save') }}" method="POST">
            @csrf



            {{-- ทำต่อ --}}

            {{-- @php
       $firstMovie = $movies->first();
       @endphp

       
       
       @if ($firstMovie)
           <div class="movie-item">
              <img src="{{ $firstMovie->poster }}" alt="Movie Poster" class="imgd" style="max-width:200px;">
               <p class="name_m"> <b>{{ $firstMovie->name }}</b></p>
               <p class="date_m"> <b> {{ $firstMovie->date }}    |   </b></p>
               <p class="time_m"> <b>{{ $firstMovie->time }} </b></p>
               <p class="loca_m"> <b> {{ $firstMovie->location }} </b></p>
               <px class="map_m"> <b> {{ $firstMovie->map }} </b></px>
           </div>
       @endif
    
       @php
       $secondMovie = $movies->skip(1)->first();
       @endphp
       <div class="text-end">
       @if ($secondMovie)
           <div class="movie-item">
               <p class="name_m2"><b>หนัง{{ $secondMovie->name }}</b></p>
               <p> <b> <span class="date_m2">รอบฉาย</span> <span class="date_m2_2">{{ $secondMovie->date }} </span> </b>  </p>
               <p> <b> <span class="time_m2">เวลา</span> <span class="time_m2_2">{{  $secondMovie->time}} </span> </b>  </p>
               <p class="loca_m2"> <b> {{ $secondMovie->location }} </b></p>
               <p class="map_m2"> <b> {{ $secondMovie->map }} </b></p>
       </div>
       @endif --}}

            @if ($movie)
                <div class="movie-item">
                    <img src="{{ $movie->poster }}" alt="Movie Poster" class="imgd" style="max-width:200px;">
                    <p class="name_m"> <b>{{ $movie->name }}</b></p>
                    <p class="date_m"> <b> {{ $movie->date }} | </b></p>
                    <p class="time_m"> <b>{{ \Carbon\Carbon::parse($movie->time)->format('H:i') }}</b></p>
                    <p class="loca_m"> <b> {{ $movie->location }} </b></p>
                    <p class="map_m"> <b> {{ $movie->map }} </b></p>
                </div>
            @endif

            @if ($movie)
                <div class="movie-item">
                    <img src="{{ $movie->poster }}" alt="Movie Poster" class="imgd" style="max-width:200px;">
                    <p class="name_m2"> <b>{{ $movie->name }}</b></p>
                    <p class="date_m2"> <b> {{ $movie->date }} </b></p>
                    <p class="time_m2"> <b>{{ \Carbon\Carbon::parse($movie->time)->format('H:i') }}</b></p>
                    <p class="loca_m2"> <b> {{ $movie->location }} </b></p>
                    <p class="map_m2"> <b> {{ $movie->map }} </b></p>
                </div>
            @endif

            
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <div id="a1">
                <input type="checkbox" id="checkbox1" name="ticket[]" value="A1" style="display:none;"
                    {{ in_array('A1', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A1', $bookedSeats) ? '3.png' : '5.png')) }}" id="img1"
                    onclick="changeImg('img1', document.getElementById('checkbox1'))"
                    {{ in_array('A1', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a2">
                <input type="checkbox" id="checkbox2" name="ticket[]" value="A2" style="display:none;"
                    {{ in_array('A2', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A2', $bookedSeats) ? '3.png' : '5.png')) }}" id="img2"
                    onclick="changeImg('img2', document.getElementById('checkbox2'))"
                    {{ in_array('A2', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>

            </div>
            <div id="a3">
                <input type="checkbox" id="checkbox3" name="ticket[]" value="A3" style="display:none;"
                    {{ in_array('A3', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A3', $bookedSeats) ? '3.png' : '5.png')) }}" id="img3"
                    onclick="changeImg('img3', document.getElementById('checkbox3'))"
                    {{ in_array('A3', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>

            </div>
            <div id="a4">
                <input type="checkbox" id="checkbox4" name="ticket[]" value="A4" style="display:none;"
                    {{ in_array('A4', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A4', $bookedSeats) ? '3.png' : '5.png')) }}" id="img4"
                    onclick="changeImg('img4', document.getElementById('checkbox4'))"
                    {{ in_array('A4', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a5">
                <input type="checkbox" id="checkbox5" name="ticket[]" value="A5" style="display:none;"
                    {{ in_array('A5', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A5', $bookedSeats) ? '3.png' : '5.png')) }}" id="img5"
                    onclick="changeImg('img5', document.getElementById('checkbox5'))"
                    {{ in_array('A5', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a6">
                <input type="checkbox" id="checkbox6" name="ticket[]" value="A6" style="display:none;"
                    {{ in_array('A6', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A6', $bookedSeats) ? '3.png' : '5.png')) }}" id="img6"
                    onclick="changeImg('img6', document.getElementById('checkbox6'))"
                    {{ in_array('A6', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a7">
                <input type="checkbox" id="checkbox7" name="ticket[]" value="A7" style="display:none;"
                    {{ in_array('A7', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A7', $bookedSeats) ? '3.png' : '5.png')) }}" id="img7"
                    onclick="changeImg('img7', document.getElementById('checkbox7'))"
                    {{ in_array('A7', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a8">
                <input type="checkbox" id="checkbox8" name="ticket[]" value="A8" style="display:none;"
                    {{ in_array('A8', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A8', $bookedSeats) ? '3.png' : '5.png')) }}" id="img8"
                    onclick="changeImg('img8', document.getElementById('checkbox8'))"
                    {{ in_array('A8', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a9">
                <input type="checkbox" id="checkbox9" name="ticket[]" value="A9" style="display:none;"
                    {{ in_array('A9', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A9', $bookedSeats) ? '3.png' : '5.png')) }}" id="img9"
                    onclick="changeImg('img9', document.getElementById('checkbox9'))"
                    {{ in_array('A9', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="a10">
                <input type="checkbox" id="checkbox10" name="ticket[]" value="A10" style="display:none;"
                    {{ in_array('A10', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('A10', $bookedSeats) ? '3.png' : '5.png')) }}" id="img10"
                    onclick="changeImg('img10', document.getElementById('checkbox10'))"
                    {{ in_array('A10', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>


            <div id="b1">
                <input type="checkbox" id="checkboxB1" name="ticket[]" value="B1" style="display:none;"
                    {{ in_array('B1', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B1', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB1"
                    onclick="changeImg('imgB1', document.getElementById('checkboxB1'))"
                    {{ in_array('B1', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b2">
                <input type="checkbox" id="checkboxB2" name="ticket[]" value="B2" style="display:none;"
                    {{ in_array('B2', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B2', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB2"
                    onclick="changeImg('imgB2', document.getElementById('checkboxB2'))"
                    {{ in_array('B2', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b3">
                <input type="checkbox" id="checkboxB3" name="ticket[]" value="B3" style="display:none;"
                    {{ in_array('B3', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B3', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB3"
                    onclick="changeImg('imgB3', document.getElementById('checkboxB3'))"
                    {{ in_array('B3', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b4">
                <input type="checkbox" id="checkboxB4" name="ticket[]" value="B4" style="display:none;"
                    {{ in_array('B4', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B4', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB4"
                    onclick="changeImg('imgB4', document.getElementById('checkboxB4'))"
                    {{ in_array('B4', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b5">
                <input type="checkbox" id="checkboxB5" name="ticket[]" value="B5" style="display:none;"
                    {{ in_array('B5', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B5', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB5"
                    onclick="changeImg('imgB5', document.getElementById('checkboxB5'))"
                    {{ in_array('B5', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b6">
                <input type="checkbox" id="checkboxB6" name="ticket[]" value="B6" style="display:none;"
                    {{ in_array('B6', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B6', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB6"
                    onclick="changeImg('imgB6', document.getElementById('checkboxB6'))"
                    {{ in_array('B6', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b7">
                <input type="checkbox" id="checkboxB7" name="ticket[]" value="B7" style="display:none;"
                    {{ in_array('B7', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B7', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB7"
                    onclick="changeImg('imgB7', document.getElementById('checkboxB7'))"
                    {{ in_array('B7', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b8">
                <input type="checkbox" id="checkboxB8" name="ticket[]" value="B8" style="display:none;"
                    {{ in_array('B8', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B8', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB8"
                    onclick="changeImg('imgB8', document.getElementById('checkboxB8'))"
                    {{ in_array('B8', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b9">
                <input type="checkbox" id="checkboxB9" name="ticket[]" value="B9" style="display:none;"
                    {{ in_array('B9', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B9', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB9"
                    onclick="changeImg('imgB9', document.getElementById('checkboxB9'))"
                    {{ in_array('B9', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="b10">
                <input type="checkbox" id="checkboxB10" name="ticket[]" value="B10" style="display:none;"
                    {{ in_array('B10', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('B10', $bookedSeats) ? '3.png' : '5.png')) }}" id="imgB10"
                    onclick="changeImg('imgB10', document.getElementById('checkboxB10'))"
                    {{ in_array('B10', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>


            <div id="c1">
                <input type="checkbox" id="checkboxC1" name="ticket[]" value="C1" style="display:none;"
                    {{ in_array('C1', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('C1', $bookedSeats) ? '88.png' : '99.png')) }}" id="imgC1"
                    onclick="changeImg('imgC1', document.getElementById('checkboxC1'))"
                    {{ in_array('C1', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>
            <div id="c2">
                <input type="checkbox" id="checkboxC2" name="ticket[]" value="C2" style="display:none;"
                    {{ in_array('C2', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('C2', $bookedSeats) ? '88.png' : '99.png')) }}" id="imgC2"
                    onclick="changeImg('imgC2', document.getElementById('checkboxC2'))"
                    {{ in_array('C2', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>

            <div id="c3">
                <input type="checkbox" id="checkboxC3" name="ticket[]" value="C3" style="display:none;"
                    {{ in_array('C3', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('C3', $bookedSeats) ? '88.png' : '99.png')) }}" id="imgC3"
                    onclick="changeImg('imgC3', document.getElementById('checkboxC3'))"
                    {{ in_array('C3', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>

            <div id="c4">
                <input type="checkbox" id="checkboxC4" name="ticket[]" value="C4" style="display:none;"
                    {{ in_array('C4', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('C4', $bookedSeats) ? '88.png' : '99.png')) }}" id="imgC4"
                    onclick="changeImg('imgC4', document.getElementById('checkboxC4'))"
                    {{ in_array('C4', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>

            <div id="c5">
                <input type="checkbox" id="checkboxC5" name="ticket[]" value="C5" style="display:none;"
                    {{ in_array('C5', $bookedSeats) ? 'disabled' : '' }}>
                <img src="{{ asset('images/' . (in_array('C5', $bookedSeats) ? '88.png' : '99.png')) }}" id="imgC5"
                    onclick="changeImg('imgC5', document.getElementById('checkboxC5'))"
                    {{ in_array('C5', $bookedSeats) ? 'style=cursor:not-allowed;' : '' }}>
            </div>

            


            <input type="hidden" name="total_price" id="totalPrice" value="0">
            <button type="submit" class="btn btn-outline-secondary" onsubmit="">ดำเนินการต่อ</button>
        </form>
        


        <div id="result" class="sub">
            <div id="totalPriceDisplay">ราคารวมทั้งหมด: 0</div>
            <div id="selectedSeats">ที่นั่งที่เลือก: </div>
            
    @endsection

</body>

</html>
