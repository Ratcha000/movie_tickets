<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('CSS/adminstyle.css')}}">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Movie");
        }
        </script>
    <style>
        /* จัดการปุ่มด้วย Flexbox */
        .button-container {
            display: flex;
            justify-content: flex-end; /* จัดให้ชิดขวา */
            align-items: center; /* จัดให้อยู่ตรงกลางในแนวตั้ง */
            margin-bottom: 20px; /* เพิ่มระยะห่างจากตาราง */
        }

        .button-container .btn-create, .button-container .btn-home {
            margin-right: 20px; /* ระยะห่างระหว่างปุ่ม */
        }

        .btn-create{
            background-color: #6b1b89; /* สีปุ่ม */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-home {
            background-color: #28a745; /* สีปุ่ม */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-logout {
            background-color: #ff0000; /* สีปุ่ม */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-right: 1090px;
        }
    </style>
</head>
<nav><h1>SIGMAPLEX</h1></nav>
<div class="button-container">
    <a href="/adminHome" class="btn-logout">Log out</a>
    
    <a href="{{ route('homes') }}" class="btn-home">Home</a>

    <a href="/movies/create" class="btn-create">Create Movie Review</a>
</div>
<aside><button type="button" onclick="window.location.href='/Add_movie'">+</button></aside>


<body>
    <table border="1">
        <tr>
            <th class="id">id</th>
            <th>Poster</th>
            <th>name</th>
            <th>date</th>
            <th>time</th>
        </tr>
        @foreach ($movie as $movies)
        <tr>
            <td>{{$movies->id}}</td>
            <td><img src="{{$movies->poster}} " width = 80></td>
            <td>{{$movies->name}}</td>
            <td>{{$movies->date}}</td>
            <td>{{$movies->time}}</td>
            <td>
                <form action="/Add_movie" method="GET">
                    <button type="submit" class="btn text-bg-warning" name="edit_id" value="{{ $movies->id }}">Edit</button>
                </form>
            </td>
            <td>
                <form action="/HomeAdmin/delete/{{ $movies->id }}" method="GET" onsubmit="return confirmDelete();">
                    <button type="submit" class="btn text-bg-danger" name="id" >Delete</button>
                </form>
            </td>
            <td>
                <form action="/view/{{ $movies->id }}" method="GET">
                    <button type="submit" class="btn text-bg-success" name="id">Detail</button>
                </form>
                
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>