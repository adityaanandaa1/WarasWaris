<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WarasWaris - Dokter')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">

</head>
<body>
    <div class="layout">
        <div class="sidebar">
         @include('partials.sidebar')
        </div>

        <div class="content ">
            @yield('content')
        </div>
    </div>
</body>
</html>