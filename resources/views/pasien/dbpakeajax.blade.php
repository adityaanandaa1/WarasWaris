<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pasien</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #CEDEFF;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
            max-width: 1280px;
            margin: 0;
        }

        /*buat konten yg kiri*/
        .left-content {
            flex: 1;
            background: #FFFFFF;
            border-radius: 0 20px 20px 0;
            padding: 40px;
            box-shadow: 10px 0px 10px rgba(0, 0, 0, 0.25);
            margin-right: 56px;
            
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .header-left h1 {
            font-size: 27px;
            font-weight: 700;
            color: #464646;
            margin-bottom: 5px;
        }

        .header-left .date {
            font-size: 16px;
            color: #464646;
        }

        /* selamat datang*/
        .welcome-banner {
            background: linear-gradient(135deg, #5A81FA 0%, #587EF4 100%);
            border-radius: 20px;
            padding: 30px;
            padding-left: 250px;  /* Beri ruang untuk gambar */
            margin-bottom: 30px;
            margin-left: 100px;   /* Beri ruang di kiri untuk gambar overflow */
            display: flex;               
            align-items: center;         
            gap: 30px;
            box-shadow: 0px 0px 27px 7px rgba(0, 0, 0, 0.15);
            min-height: 200px;
            position: relative;   /* Penting untuk absolute positioning */
        }

        .welcome-image {
            position: absolute;   /* Keluarkan dari flow normal */
            left: -150px;         /* Geser ke kiri, keluar dari card */
            top: 50%;
            transform: translateY(-50%);  /* Center vertical */
            z-index: 10;          /* Di atas card */
        }

        .welcome-image img {
            width: 403px;
            height: 269px;
            border-radius: 10px;
            display: block;
        }

        .welcome-text {
            flex: 1;
            color: #FFFFFF;
        }

        .welcome-text h2 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-text p {
            font-size: 15px;
            font-weight: 300;
            line-height: 22px;
        }

            
        /* Calendar */
        .calendar-container {
            background: rgba(206, 222, 255, 0.5);
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0px 4px 20px 7px rgba(0, 0, 0, 0.25);
        }

        .calendar-header {
            text-align: center;
            font-size: 27px;
            font-weight: 700;
            color: #5A81FA;
            margin-bottom: 20px;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
            margin-bottom: 15px;
        }

        .day-name {
            font-size: 22px;
            color: #464646;
            font-weight: 400;
        }
        .calendar-dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="left-content">

            <div class="header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                    <div class="date" id="currentDate"></div>
                </div>
            </div>

            <div class="welcome-banner">
                <div class="welcome-image">
                    <img src="{{ asset('images/dbpasien.png') }}" alt="animasi dokter">
                </div>
                
                <div class="welcome-text">
                    <h2>Selamat Datang!</h2>
                    <p>Konsultasikan kesehatanmu sekarang juga!</p>
                </div>
            </div>


            <div class="calendar-container">
                <div class="calendar-header" id="calendarMonth"></div>
                <div class="calendar-days">
                    <div class="day-name">Senin</div>
                    <div class="day-name">Selasa</div>
                    <div class="day-name">Rabu</div>
                    <div class="day-name">Kamis</div>
                    <div class="day-name">Jumat</div>
                    <div class="day-name">Sabtu</div>
                    <div class="day-name">Minggu</div>
                </div>
                <div class="calendar-dates" id="calendarDates"></div>
            </div>
        </div>
    </div>
</body>
<script>
    /* tanggal di pjok kiri atas */
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('id-ID', options);
    document.getElementById('currentDate').textContent = formattedDate;

    // Generate Calendar
    function generateCalendar() {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        const currentDate = today.getDate();

        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        document.getElementById('calendarMonth').textContent = monthNames[month];

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        const calendarDates = document.getElementById('calendarDates');
        let html = '';

        // Previous month days
        const startDay = firstDay === 0 ? 6 : firstDay - 1;
        for (let i = startDay; i > 0; i--) {
            html += `<div class="date-cell prev-month">${daysInPrevMonth - i + 1}</div>`;
        }

        // Current month days
        for (let i = 1; i <= daysInMonth; i++) {
            const isToday = i === currentDate ? 'current' : '';
            html += `<div class="date-cell ${isToday}" onclick="selectDate(${i})">${i}</div>`;
        }

        // Next month days
        const remainingCells = 42 - (startDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
            html += `<div class="date-cell next-month">${i}</div>`;
        }

        calendarDates.innerHTML = html;
    }


</script>
</html>