<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WarasWaris - Resepsionis')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/resepsionis/layouts_res.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resepsionis/laporan_res.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resepsionis/sidebar_res.css') }}">

</head>
<body>
    <div class="layout">
        <div class="sidebar">
         @include('partials.sidebar_resepsionis')
        </div>

        <div class="content ">
            @yield('content')
        </div>
    </div>
</body>
</html>