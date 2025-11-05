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
            margin: 50px;
            margin-bottom: 10px;
        }
        
        .service-header {
            height: 185px;
            padding-left: 100px;
        }

        .service-subtitle {
            width: 55%;
        }

        .service-heading {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            color: #5A81FA;
        }

        .service-description {
            width: 80%;
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            color: #464646;
        }

        .service-list {
            width: 90%;
            height: 330px;
            padding-left: 100px;
        }

        .service-item {
            display: flex;
            align-items: center;
            gap: 20px;
            width: 70%;
        }

        .service-button {
            background-color: #ffffff;
            padding: 15px 15px;
            border-radius: 100%;
            border: none;
            box-shadow:0 8px 16px 0 rgba(0,0,0,0.6)
        }

        .service-button i {
            color: #5A81FA; 
            font-size: 30px;
        }

        .service-text {
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            color: #464646;
        }

        .service-footer {
            padding-left: 100px;
            height: 80px;
        }

        .btn {
            background-color: #87A3FB;
            transition: background-color 0.5s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 700;
            text-decoration: none;
            color: #ffffff;
            padding: 30px 50px;
            border-radius: 30px;
            border: none;
            box-shadow:0 8px 16px 0 rgba(0,0,0,0.6)
        }

        .btn:hover {
            background-color: #5A81FA;
        }
    </style>
</head>
<body>
    <section class="service-header">
        <div class="service-subtitle">
            <h1 class="service-heading">
                Layanan kesehatan yang lebih nyaman dan lebih dekat dengan anda
            </h1>
        </div>
        <div class="service-description">
            <p>
                Kami memahami pentingnya pelayanan kesehatan yang cepat, mudah, dan dapat diandalkan. 
                Dengan sistem digital dan dokter berpengalaman, kami hadir untuk memberikan 
                pengalaman berobat yang lebih praktis dan efisien tanpa mengorbankan kenyamanan Anda.
            </p>
        </div>
    </section>

    <section class="service-list">
        <!-- Layanan 1 -->
        <div class="service-item">
            <button type="button" class="service-button">
                <i class="ri-stethoscope-line"></i>
            </button>
            <p class="service-text">
                Dokter kami siap memberikan diagnosis dan penanganan terbaik dengan 
                pendekatan yang ramah serta terpercaya.
            </p>
        </div>

        <!-- Layanan 2 -->
        <div class="service-item">
            <button type="button" class="service-button">
                <i class="ri-map-pin-line"></i>
            </button>
            <p class="service-text">
                Klinik kami mudah dijangkau dan dilengkapi fasilitas yang nyaman untuk menunjang 
                kebutuhan pasien.
            </p>
        </div>

        <!-- Layanan 3 -->
        <div class="service-item">
            <button type="button" class="service-button">
                <i class="ri-draft-line"></i>
            </button>
            <p class="service-text">
                Pesan jadwal konsultasi Anda secara online, dapatkan nomor antrean otomatis, 
                dan datang sesuai waktu tanpa menunggu lama.
            </p>
        </div>
    </section>

    <div class="service-footer">
        <a href="#" class="btn btn-primary">
            Lihat Layanan Pasien Kami
        </a>
    </div>
</body>
</html>