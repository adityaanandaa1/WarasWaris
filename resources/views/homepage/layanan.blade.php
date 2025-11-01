<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WarasWaris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
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
            <button type="button" class="buttonLayanan"><i class="fa-solid fa-stethoscope" style="color: #5a81fa;"></i></button>
            <p>Dokter kami siap memberikan diagnosis dan penanganan terbaik dengan pendekatan yang ramah serta terpercaya.</p>
        </div>
        <!-- Layanan 2 -->
        <div class="layanan">
            <button type="button" class="buttonLayanan"><i class="fa-solid fa-location-dot fa-xl" style="color: #5a81fa;"></i></button>
            <p>Klinik kami mudah dijangkau dan dilengkapi fasilitas yang nyaman untuk menunjang kebutuhan pasien.</p>
        </div>
        <!-- Layanan 3 -->
        <div class="layanan">
            <button type="button" class="buttonLayanan"><i class="fa-regular fa-calendar-days fa-xl" style="color: #5a81fa;"></i></button>
            <p>Pesan jadwal konsultasi Anda secara online, dapatkan nomor antrean otomatis, dan datang sesuai waktu tanpa menunggu lama.</p>
        </div>
    </div>
    <div id="button">
        <button type="button" id="lihatLayanan">Lihat Layanan Pasien Kami</button>
    </div>
</body>
</html>