<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>ini dashboard dokter</h1>
    <form action="{{ route('logout') }}" method="POST" style="display:inline">
    @csrf
    <button type="submit">Keluar</button>
    </form>

    <div class="welcome-card">
        <div class="welcome-text">
            <div class="date">

            </div>
            <h2>Selamat Datang!</h2>
            <p>Semoga harimu indah!</p>
        </div>
    </div>

    <div class="info-card">
        <div class="antrian-card">
            <div class="antrian-text">
                <label for="">
                    Nomor Antrean Berjalan
                </label>
                <div class="antrian-btn">

                </div>
            </div>
        </div>

        <div class="jampraktik-card">
            <div class="jampraktik-text">
                <label for="">Jam Praktik</label>
            <div class="jampraktik-btn">

            </div>
            </div>
        </div>
    </div>

    <div class="statistik-card">
        <div class="statistik-text">
            <label for="">Statistik Laporan</label>
            <div class="statistik-wrap">
                <div class="statistik-info"></div>
            </div>
        </div>
    </div>

    <div class="profil-card">
        <header>
            <div class="header-card">

            </div>
        </header>
        <div class="profil-info">

        </div>
    </div>

    <div class="calender-card">

    </div>
</body>
</html>