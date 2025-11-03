<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WarasWaris</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 100px;
        }
        
        #judul {
            display: flex;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            color: #1F4DD9;
            margin: 0;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            color: #5A81FA;
            margin: 0;
        }

        #lokasi {
            display: flex;
        }

        #subjudul p {
            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            color: #464646;
        }

        #subjudul {
            padding-left: 100px;
        }

        #maps p {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            color: #5A81FA;
        }
    </style>
</head>
<body>
    <div id="judul">
        <i class="ri-map-pin-2-fill" style="color: #5A81FA; font-size: 75px;"></i>
        <div id="subjudul">
            <h1>Lokasi Klinik</h1>
            <h2>Dr. Muh. Abd. Waris</h2>
        </div>
    </div>
    <div id="lokasi">
        <div id="subjudul">
            <p>Klinik kami berlokasi strategis di pusat Kecamatan Kaliwates, Jember. Alamat: Jl. Bromocor No. 2, Kepatihan, Kalisat, Kab. Jember, Jawa Timur 68193.</p>
            <p>Lokasi mudah dijangkau dengan kendaraan pribadi maupun transportasi umum. Pasien juga dapat menggunakan Google Maps untuk navigasi langsung ke klinik kami.</p>
        </div>
        <div id="maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d758251.2525875802!2d110.05828114108525!3d-7.716638213679846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6bf07904e2813%3A0xe6a3d376ea4e071!2sDr.Muh.Abd.Waris!5e0!3m2!1sid!2sid!4v1762161211936!5m2!1sid!2sid" width="432" height="411" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p>Klik pada peta untuk membuka arah menuju Klinik Dr. Muh. Abd. Waris di Google Maps.</p>
        </div>
    </div>
</body>
</html>