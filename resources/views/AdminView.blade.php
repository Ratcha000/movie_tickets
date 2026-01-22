   
@php

$totalPrice = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('s.css') }}">
</head>
<body>

<div>

    <main>
        <div>
            @if ($orderticket->isEmpty())
                <h1 class="nf">**ยังไม่มีเก้าอี้ที่ถูกจองในระบบนะจะจุ็บๆ**</h1>
            @else
                <h1>ตารางแสดงข้อมูล {{ $movie->name }} เวลา {{ $movie->time }}</h1>
                <table class="table table-striped-columns" border="1">
                    <thead>
                        <tr>
                            <td class="table-warning">ไอดี</td>
                            <td class="table-warning">ที่นั่ง</td>
                            <td class="table-warning">ราคาราคาตั๋วหนัง</td>
                            <td class="table-warning">เวลา</td>
                            <td class="table-warning">รายการเพิ่มเติม</td>
                            <td class="table-warning">ราคา</td>
                            <td class="table-warning">โค้ดส่วนลด</td>
                            <td class="table-warning">ราคาหลังจากใช้โค้ดส่วนลด</td>
                            <td class="table-danger">ลบ</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPrice = 0;
                        @endphp
                       @foreach ($orderticket as $m)
                       @php
                           $p = $pnd->where('orderticketid', $m->id)->first();
                           $s = $dis->where('orderticketid', $m->id)->first();
                           $totalPrice += $m->total_price;
                   @endphp
                       <tr>
                           <td>{{  $m->id }}</td>
                           <td>{{  $m->tickets }}</td>
                           <td>{{  $m->total_price }}</td>
                           <td>{{  $m->created_at }}</td>
                           <td>{{ $p ? $p->p_n_d : 'ไม่มีข้อมูล' }}</td>
                           <td>{{ $p ? $p->price : 'ไม่มีข้อมูล' }}</td>
                           <td>{{ $s ? $s->lodprice : 'ไม่มีข้อมูล' }}</td>
                           <td>{{ $s ? $s->afprice : 'ไม่มีข้อมูล' }}</td></td>
                           <td> <form action="/view/delete/{{ $m->id }}" method="GET" onsubmit="return confirmDelete();">
                               <button type="submit" class="btn btn-danger">Delete</button>
                           </form></td>
                       </tr>
                       @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="table-success">ราคารวมทั้งหมด:</td>
                            <td class="table-success">{{ $totalPrice }}</td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            @endif
            <button onclick="refreshPage()" class="nb btn btn-primary">Refresh</button>
            <a href="/HomeAdmin" class="btn btn-secondary">Back</a>
        </div>
    </main>
    

</div>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this Seat");
}
function refreshPage() {
    location.reload(); 
}
</script>
</body>
</html>