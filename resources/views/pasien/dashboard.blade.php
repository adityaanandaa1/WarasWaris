<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard pasien</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        .halaman {
            font-size: 27px;
            font-weight: 700px;
            color:#464646;
        }
        .tanggal{
            font-size: 16px;
            font-weight: 400;
        }
        .card1{
            color:white;
            font-size: 16px;
            background-color:#5A81FA;
        }

    </style>
</head>
<body>
<<<<<<< HEAD

    <div class="halaman">Dashboard</div>
    <div class="tanggal">{{ \Carbon\Carbon::now()->format('d F Y') }}</div>

    <div class="card1">
        <p><b>Selamat datang!</b></p>
        <p>Konsultasikan kesehatanmu sekarang juga!</p>
    </div>
=======
    <h1>INI DASHBOARD PASIEN</h1>
    <form action="{{ route('logout') }}" method="POST" style="display:inline">
    @csrf
    <button type="submit">Keluar</button>
    </form>
>>>>>>> f8c2bae6f126737dfa55b9d6e2545a762d993a94

</body>
</html>