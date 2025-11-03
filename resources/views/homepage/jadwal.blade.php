<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WarasWaris</title>

    <style>
        body {
            margin: 75px;
        }

        #judul h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 42px;
            color: #1F4DD9;
            margin: 10px;
            text-align: center;
            font-weight: bold;
        }

        #judul h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 42px;
            color: #5A81FA;
            margin-top: 10px;
            margin-bottom: 40px;
            text-align: center;
            font-weight: bold;
        }

        #box-jadwal {
            background-color: #5A81FA;
            width: 65%;
            border-radius: 15px;
            margin: auto;
            box-shadow:0 4px 16px 0 rgba(0,0,0,0.6)
        }

        #subjudul {
            display: flex;
            justify-content: space-between;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-left: 50px;
            padding-right: 50px;
            align-items: center;
        }

        #subjudul h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 46px;
            color: #ffffff;
            margin: 5px;
            font-weight: bold;
        }

        #gray-box {
            background-color: #D9D9D9;
            height: 25px;
            padding: 0;
        }

        #jam {
            display: flex;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 75px;
        }

        #jam p {
            font-family: 'Poppins', sans-serif;
            font-size: 46px;
            color: #ffffff;
            font-weight: bold;
        }

        h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #ffffff;
            font-weight: bold;
            margin: 0;        
            text-align: center;    
        }

        #jam h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 64px;
            color: #ffffff;
            margin: 10px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="judul">
        <h1>Jadwal Klinik</h1>
        <h2>Dr. Muh. Abd. Waris</h2>
    </div>
    <div id="box-jadwal">
        <div id="subjudul">
            <h2>Jam Praktik</h2>
            <div class="date-container">
                <input type="date" id="tanggal" />
                <i class="ri-calendar-2-line"></i>
            </div>
        </div>
        <div id="gray-box"></div>
        <div id="jam">
            <div id="jam-buka">
                <h3>Buka</h3>
                <h1>09.00</h1>
            </div>
            <p>-</p>
            <div>
                <h3>Tutup</h3>
                <h1>21.00</h1>
            </div>
        </div>
    </div>
</body>
</html>