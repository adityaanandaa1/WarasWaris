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
            padding: 40px;
        }

        #bluebox {
            background-color: #5A81FA;
            width: 100%; 
            height: 575px;
            border-radius: 10px;
        }

        #isi {
            align-content: center;
            padding-top: 75px;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 39px;
            color: #ffffff;
            text-align: center;
            padding-left: 30px;
            padding-right: 10px;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            height: 2px;
            color: #ffffff;
            text-align: center;
            padding-left: 250px;
            padding-right: 250px;
            height: 200px;
        }

        #button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #buttonDaftar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            transition: background-color 2s ease;
            transition: color 2s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            font-weight: 700;
            color: #5A81FA;
            border: none;
            border-radius: 200px;
            padding: 20px 40px;
            box-shadow: 0 5px 10px rgba(90, 129, 250, 0.3);
            cursor: pointer;
        }

        #buttonDaftar i {
            background: #5A81FA;
            color: white;
            border-radius: 50%;
            padding: 10px;
            font-size: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            margin-right: -10px;
        }

        #buttonDaftar:hover {
            background-color: #5A81FA;
            color: #ffffff;
            transition: background-color 1s ease;
        }
    </style>
</head>
<body>
    <div id="bluebox">
        <div id="isi">
            <div id="judul">
                <h1>Bergabung dengan Klinik WarasWaris</h1>
            </div>
            <div id="subjudul">
                <p>Kami hadir untuk memberikan solusi layanan kesehatan yang cepat, aman, dan terpercaya. Pelayanan profesional, kemudahan akses, dan kecepatan respon.</p>
            </div>
        </div>
        <div id="button">
            <button type="button" id="buttonDaftar" >Gabung Klinik WarasWaris
                <i  class="ri-arrow-right-double-line"
                    style="color: #ffffff; font-size: 21px; padding: 20px 20px; background-color: #5A81FA; border-radius: 100%; display: flex;">
                </i>
            </button>
        </div>
    </div>
</body>
</html>