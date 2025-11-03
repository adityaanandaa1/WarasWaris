<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WarasWaris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: linear-gradient(to bottom, #CEDEFF 0%, #FFFFFF 20%);
        }
        
        #judul {
            height: 240px;
            padding-left: 100px;
            padding-top: 50px;
        }

        #subjudul {
            width: 60%;
        }

        #intijudul {
            width: 85%;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 31px;
            color: #5A81FA;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            color: #464646;
        }

        #isi {
            width: 90%;
            height: 350px;
            padding-left: 100px;
        }

        .layanan {
            display: flex;
            align-items: center;
            gap: 20px;
            width: 70%;
        }

        .buttonLayanan {
            background-color: #ffffff;
            padding: 20px 20px;
            border-radius: 100%;
            border: none;
            box-shadow:0 8px 16px 0 rgba(0,0,0,0.6)
        }

        #button {
            padding-left: 100px;
            height: 125px;
        }

        #lihatLayanan {
            background-color: #87A3FB;
            transition: background-color 0.5s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
            color: #ffffff;
            padding: 30px 50px;
            border-radius: 30px;
            border: none;
            box-shadow:0 8px 16px 0 rgba(0,0,0,0.6)
        }

        #lihatLayanan:hover {
            background-color: #5A81FA;
        }
    </style>
</head>
<body>
    <div id="judul">
        <div id="subjudul">
            <h1>Layanan kesehatan yang lebih nyaman dan lebih dekat dengan anda</h1>
        </div>
        <div id="intijudul">
            <p>Kami memahami pentingnya pelayanan kesehatan yang cepat, mudah, dan dapat diandalkan. Dengan sistem digital dan dokter berpengalaman, kami hadir untuk memberikan pengalaman berobat yang lebih praktis dan efisien tanpa mengorbankan kenyamanan Anda.</p>
        </div>
    </div>
    <div id="isi">
        <!-- Layanan 1 -->
        <div class="layanan">
            <button type="button" class="buttonLayanan"><i class="ri-stethoscope-line" style="color: #5A81FA; font-size: 30px;"></i></button>
            <p>Dokter kami siap memberikan diagnosis dan penanganan terbaik dengan pendekatan yang ramah serta terpercaya.</p>
        </div>
        <!-- Layanan 2 -->
        <div class="layanan">
            <button type="button" class="buttonLayanan"><i class="ri-map-pin-line" style="color: #5A81FA; font-size: 30px;"></i></button>
            <p>Klinik kami mudah dijangkau dan dilengkapi fasilitas yang nyaman untuk menunjang kebutuhan pasien.</p>
        </div>
        <!-- Layanan 3 -->
        <div class="layanan">
            <button type="button" class="buttonLayanan"><i class="ri-draft-line" style="color: #5A81FA; font-size: 30px;"></i></button>
            <p>Pesan jadwal konsultasi Anda secara online, dapatkan nomor antrean otomatis, dan datang sesuai waktu tanpa menunggu lama.</p>
        </div>
    </div>
    <div id="button">
        <a href="#" id="lihatLayanan" class="btn">
            Lihat Layanan Pasien Kami
        </a>
    </div>
</body>
</html>