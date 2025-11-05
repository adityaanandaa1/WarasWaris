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
            margin-left: 100px;
            margin-right: 100px;
            margin-top: 60px
        }
        
        .location-header {
            display: flex;
        }

        .location-title {
            padding-left: 10px;
        }

        .location-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            color: #1F4DD9;
            margin: 0;
        }

        .location-subheading {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            color: #5A81FA;
            margin: 0;
        }

        .location-content {
            display: flex;
        }

        .location-description {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            color: #464646;
            padding-left: 90px;
            padding-right: 240px;
        }

        .map-frame {
            box-shadow: 0 5px 16px 0 rgba(0,0,0,0.6)
        }

        .map-caption{
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #5A81FA;
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="location-header">
        <svg width="78" height="82" viewBox="0 0 114 118" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_f_130_13)">
                <ellipse cx="57" cy="105.953" rx="23.4706" ry="8.04706" fill="#D9D9D9"/>
            </g>
            <path d="M57 54.625C53.8506 54.625 50.8301 53.3739 48.6031 51.1469C46.3761 48.9199 45.125 45.8994 45.125 42.75C45.125 39.6006 46.3761 36.5801 48.6031 34.3531C50.8301 32.1261 53.8506 30.875 57 30.875C60.1494 30.875 63.1699 32.1261 65.3969 34.3531C67.6239 36.5801 68.875 39.6006 68.875 42.75C68.875 44.3094 68.5678 45.8536 67.9711 47.2944C67.3743 48.7351 66.4996 50.0442 65.3969 51.1469C64.2942 52.2496 62.9851 53.1243 61.5444 53.7211C60.1036 54.3178 58.5594 54.625 57 54.625ZM57 9.5C48.1816 9.5 39.7243 13.0031 33.4887 19.2387C27.2531 25.4743 23.75 33.9316 23.75 42.75C23.75 67.6875 57 104.5 57 104.5C57 104.5 90.25 67.6875 90.25 42.75C90.25 33.9316 86.7469 25.4743 80.5113 19.2387C74.2757 13.0031 65.8184 9.5 57 9.5Z" fill="#5A81FA"/>
            <defs>
                <filter id="filter0_f_130_13" x="29.5294" y="93.9058" width="54.9412" height="24.0942" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                    <feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_130_13"/>
                </filter>
            </defs>
        </svg>
        <div class="location-title">
            <h1 class="location-heading">Lokasi Klinik</h1>
            <h2 class="location-subheading">Dr. Muh. Abd. Waris</h2>
        </div>
    </section>

    <section class="location-content">
        <div class="location-description">
            <p>
                Klinik kami berlokasi strategis di pusat Kecamatan Kaliwates, Jember. 
                Alamat: Jl. Bromocor No. 2, Kepatihan, Kalisat, Kab. Jember, Jawa Timur 68193.
            </p>
            <p>Lokasi mudah dijangkau dengan kendaraan pribadi maupun transportasi umum. 
                Pasien juga dapat menggunakan Google Maps untuk navigasi langsung ke klinik kami.
            </p>
        </div>

        <div class="location-maps">
            <iframe 
                class="map-frame" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d758251.2525875802!2d110.05828114108525!3d-7.716638213679846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6bf07904e2813%3A0xe6a3d376ea4e071!2sDr.Muh.Abd.Waris!5e0!3m2!1sid!2sid!4v1762161211936!5m2!1sid!2sid" 
                width="400" 
                height="360" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <p class="map-caption">
                Klik pada peta untuk membuka arah menuju Klinik Dr. Muh. Abd. Waris di Google Maps.
            </p>
        </div>
    </section>
</body>
</html>