<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Caring, Better Doctor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .container {
            position: relative;
            width: 100vw;
            min-width: 1280px;
            height: 832px;
            background: #FFFFFF;
            overflow: hidden;
        }

        /* Background Elements */
        .bg-k3 {
            position: absolute;
            width: 100%;
            height: 437px;
            left: 0px;
            top: 395px;
            background: #CEDEFF;
        }

        .bg-v1 {
            position: absolute;
            width: 100%;
            height: 755px;
            left: 0px;
            top: 0px;
            overflow: hidden;
        }

        .bg-v1 svg {
            width: 100%;
            height: 100%;
            min-width: 1280px;
        }

        .bg-k2 {
            position: absolute;
            width: 100%;
            height: 70px;
            left: 0px;
            top: 0px;
            background: #CEDEFF;
        }

        .bg-k1 {
            position: absolute;
            width: calc(100% - 336px);
            max-width: 957px;
            height: 248px;
            left: 50%;
            transform: translateX(-50%);
            top: 560px;
            background: #5A81FA;
            box-shadow: 0px 4px 27.7px 7px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
        }

        /* Doctor Image */
        .doctor-image {
            position: absolute;
            width: 464px;
            height: 436px;
            left: 150px;
            top: 133px;
            filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
        }

        .doctor-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Main Heading */
        .main-heading {
            position: absolute;
            width: 614px;
            left: 577px;
            top: 183px;
            font-weight: 700;
            font-size: 70px;
            line-height: 71px;
            color: #FFFFFF;
        }

        .main-heading .better-doctor {
            color: #1F4DD9;
        }

        /* Description Text */
        .description {
            position: absolute;
            width: 499px;
            left: 582px;
            top: 330px;
            font-weight:100;
            font-size: 16px;
            line-height: 26px;
            color: #FFFFFF;
        }

        /* Buttons */
        .btn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10px;
            gap: 10px;
            position: absolute;
            background: #87A3FB;
            box-shadow: 0px 4px 27.7px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            font-weight: 700;
            font-size: 19px;
            line-height: 28px;
            text-align: center;
            color: #FFFFFF;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            background: #6B8EF5;
            transform: translateY(-2px);
            box-shadow: 0px 6px 30px 5px rgba(0, 0, 0, 0.3);
        }

        .btn-register {
            width: 193px;
            height: 53px;
            left: 582px;
            top: 481px;
        }

        .btn-schedule {
            width: 249px;
            height: 53px;
            left: 794px;
            top: 481px;
        }

        /* Feature Cards */
        .feature-card {
            position: absolute;
        }

        .feature-icon {
            position: absolute;
            width: 56px;
            height: 56px;
            background: #FFFFFF;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .feature-icon svg {
            width: 34px;
            height: 34px;
        }

        .feature-title {
            font-weight:550;
            font-size: 22px;
            line-height: 33px;
            color: #FFFFFF;
        }

        .feature-description {
            font-weight: 250;
            font-size: 14px;
            line-height: 21px;
            color: #FFFFFF;
        }

        /* Feature 1 - Pelayanan Terpercaya */
        .feature-1 {
            left: 286px;
            top: 584px;
            width: 279px;
        }

        .feature-1 .feature-icon {
            left: 0px;
            top: 0px;
        }

        .feature-1 .feature-title {
            position: absolute;
            left: 0px;
            top: 65px;
        }

        .feature-1 .feature-description {
            position: absolute;
            left: 0px;
            top: 109px;
            width: 252px;
        }

        /* Feature 2 - Konsultasi Mudah */
        .feature-2 {
            left: 732px;
            top: 584px;
            width: 252px;
        }

        .feature-2 .feature-icon {
            left: 0px;
            top: 3px;
        }

        .feature-2 .feature-title {
            position: absolute;
            left: 0px;
            top: 68px;
        }

        .feature-2 .feature-description {
            position: absolute;
            left: 0px;
            top: 112px;
            width: 252px;
        }
    </style>
</head>
<body>
    
  <div class="bg-k3"></div>
  <div class="bg-v1">
      <svg width="100%" height="755" viewBox="0 0 1280 755" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
          <mask id="mask0_627_2221" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="-169" y="-229" width="1620" height="984">
              <path d="M1451 263C1451 534.724 1088.35 755 641 755C193.649 755 -169 534.724 -169 263C-169 -8.72409 193.649 -229 641 -229C1088.35 -229 1451 -8.72409 1451 263Z" fill="#5A81FA"/>
          </mask>
          <g mask="url(#mask0_627_2221)">
              <rect x="-1" y="71" width="1282" height="685" fill="#5A81FA"/>
          </g>
      </svg>
  </div>
  <div class="bg-k2"></div>
  <div class="bg-k1"></div>

  <!-- Doctor Image --> 
  <div class="doctor-image">
      <img src="{{ asset('images/Dokter Waris.png') }}" alt="Dokter Waris" width="300">
  </div>

  <!-- Main Heading -->
  <div class="main-heading">
      Best Caring,<br>
      <span class="better-doctor">Better Doctor</span>
  </div>

  <!-- Description -->
  <div class="description">
      Kami berkomitmen memberikan pelayanan kesehatan terbaik dengan dokter berpengalaman dan fasilitas modern. Kenyamanan serta keselamatan pasien adalah prioritas utama kami. Dapatkan pengalaman konsultasi yang mudah, cepat, dan terpercaya di Klinik WarasWaris.
  </div>

  <!-- Buttons -->
  <button class="btn btn-register">Daftar Akun</button>
  <button class="btn btn-schedule">Lihat Jadwal Dokter</button>

  <!-- Feature 1 - Pelayanan Terpercaya -->
  <div class="feature-card feature-1">
      <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 6H17.5C17.5 4.067 15.933 2.5 14 2.5C13.063 2.5 12.213 2.913 11.625 3.563L10 5.5L8.375 3.563C7.787 2.913 6.937 2.5 6 2.5C4.067 2.5 2.5 4.067 2.5 6H0V20C0 21.103 0.897 22 2 22H18C19.103 22 20 21.103 20 20V6ZM6 4.5C6.827 4.5 7.5 5.173 7.5 6C7.5 6.827 6.827 7.5 6 7.5C5.173 7.5 4.5 6.827 4.5 6C4.5 5.173 5.173 4.5 6 4.5ZM14 4.5C14.827 4.5 15.5 5.173 15.5 6C15.5 6.827 14.827 7.5 14 7.5C13.173 7.5 12.5 6.827 12.5 6C12.5 5.173 13.173 4.5 14 4.5ZM18 20H2V8H4.5C4.5 9.933 6.067 11.5 8 11.5C8.937 11.5 9.787 11.087 10.375 10.437L12 8.5L13.625 10.437C14.213 11.087 15.063 11.5 16 11.5C17.933 11.5 19.5 9.933 19.5 8H18V20Z" fill="#5A81FA"/>
              <circle cx="10" cy="15" r="3" fill="#5A81FA"/>
          </svg>
      </div>
      <div class="feature-title">Pelayanan Terpercaya</div>
      <div class="feature-description">
        Kami menyediakan layanan medis berkualitas tinggi dengan tenaga ahli yang berpengalaman di bidangnya.
      </div>
  </div>

  <!-- Feature 2 - Konsultasi Mudah -->
  <div class="feature-card feature-2">
      <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="8" r="4" fill="#5A81FA"/>
              <path d="M12 14C8.13 14 5 15.79 5 18V20H19V18C19 15.79 15.87 14 12 14Z" fill="#5A81FA"/>
              <path d="M17 12H19V14H21V16H19V18H17V16H15V14H17V12Z" fill="#5A81FA"/>
          </svg>
      </div>
      <div class="feature-title">Konsultasi Mudah</div>
      <div class="feature-description">
          Reservasi jadwal dokter kini lebih cepat dan praktis melalui sistem online kami.
      </div>
  </div>
 
</body>
</html>