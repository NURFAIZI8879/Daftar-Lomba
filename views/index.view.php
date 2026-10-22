<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KENTEN</title>
    <link rel="stylesheet" href="/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
</head>

<body>
    <div class="wadah-header">
        <header class="header aktif">
            <div class="logo-container">
                <img src="/img/logo_tim.png" alt="Logo" class="logo">
            </div>
            <nav class="navbar">
                <a href="#home" class="nav-link"><i class="ri-home-2-line"></i></a>
                <a href="#sambutan" class="nav-link">Sambutan</a>
                <a href="#timeline" class="nav-link">Timeline</a>
                <a href="#lomba" class="nav-link">Lomba</a>
                <a href="#pengumuman" class="nav-link">Pengumuman</a>
            </nav>
            <a href="/login" class="login desktop">Login</a>
            <a href="#" id="menu-button" onclick="toggleNavbar(); return false;"><i class="ri-menu-line"></i></a>
            <a href="#" id="menu-button-close" onclick="toggleNavbar(); return false;"><i
                    class="ri-close-large-line"></i></a>

        </header>
    </div>

    <div class="wadah-navbar">
        <header class="header-navbar">
            <a href="/login" class="login">Login</a>
        </header>
    </div>


    <section id="home" class="section-home">
        <div class="home-content">
            <div class="description">
                <h2>Deskripsi singkat lomba</h2>
                <p>KENTEN merupakan Kompetisi Inovasi Kota Palembang. Tujuan dari kompetisi ini, yaitu untuk mendorong
                    inovasi tanpa batas dan meningkatkan kualitas serta kelas dari kota Palembang.</p>
                <h3>Waktu Pendaftaran 1 - 31 Juli</h3>
                <div id="timer" class="timer">
                    <div id="days" class="timer-box">00<br><span>HARI</span></div>
                    <div id=":" class="timer-box1">:<br><span></span></div>
                    <div id="hours" class="timer-box">00<br><span>JAM</span></div>
                    <div id=":" class="timer-box1">:<br><span></span></div>
                    <div id="minutes" class="timer-box">00<br><span>MENIT</span></div>
                    <div id=":" class="timer-box1">:<br><span></span></div>
                    <div id="seconds" class="timer-box">00<br><span>DETIK</span></div>
                </div>
            </div>
            <div class="image-placeholder">
                <img src="/img/logo_tim-whitefont.png" alt="Logo" class="image-placeholder" id="maskot-deskripsi">
            </div>
        </div>
    </section>

    <section id="sambutan" class="section-sambutan">
        <h2 class="section-header">Sambutan</h2>
        <div class="sambutan-content">
            <div class="video-placeholder">
                <!-- YouTube embed -->
                <iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="video-placeholder-s">
                <!-- YouTube embed -->
                <iframe width="350" height="315" src="https://www.youtube.com/embed/VIDEO_ID"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="sambutan-description">
                <div class="sambutan-header">
                    <div class="sambutan-logo">
                        <img src="/img/logo_palembang.png" alt="Logo">
                    </div>
                    <h3>Sambutan Walikota Palembang</h3>
                </div>
                <p>Selamat datang di KENTEN, Kompetisi Inovasi Kota Palembang. Kompetisi ini akan membawa semangat baru
                    untuk menyajikan pengalaman berkompetisi yang lebih seru Menuju Palembang Emas 2045, kompetisi ini
                    juga menjadi wadah bagi para masyarakat Palembang untuk mengembangkan inovasi di seluruh bidang ilmu
                    pengetahuan.</p>
                <button class="selengkapnya-button">SELENGKAPNYA</button>
            </div>
        </div>
    </section>

    <!-- Integrasi Timeline Section -->
    <section id="timeline" class="section-timeline">
        <h2 class="section-headers">Timeline</h2>
        <div class="timeline">
            <div class="timeline-container left">
                <div class="content">
                    <h2>01 Juli - 31 Juli</h2>
                    <p>Pendaftaran dan Pengiriman Karya</p>
                </div>
            </div>
            <div class="timeline-container right">
                <div class="content">
                    <h2>01 Agustus - 31 Agustus</h2>
                    <p>Periode Penilaian Karya</p>
                </div>
            </div>
            <div class="timeline-container left">
                <div class="content">
                    <h2>01 September - 31 September</h2>
                    <p>Periode Pengumuman Pemenang</p>
                </div>
            </div>
        </div>
    </section>

    <section id="lomba" class="section-lomba">
        <h2 class="section-header">Lomba</h2>
        <div class="lomba-content">
            <div class="lomba-item show">
                <div class="lomba-inner">
                    <div class="lomba-front">
                        <img src="/img/maskot_game.png" alt="Pengembangan Aplikasi Game">
                        <p>Pengembangan Aplikasi Game</p>
                    </div>
                    <div class="lomba-back">
                        <p>Para pecinta game, bersiaplah! Tunjukkan kemampuanmu dalam menciptakan game seru dan menarik
                            dengan mengikuti Lomba Pengembangan Game yang diadakan dari tanggal 1 September - 30
                            September 2024.</p>
                    </div>
                </div>
            </div>
            <div class="lomba-item show">
                <div class="lomba-inner">
                    <div class="lomba-front">
                        <img src="/img/maskot_animasi.png" alt="Animasi">
                        <p>Animasi</p>
                    </div>
                    <div class="lomba-back">
                        <p>Tunjukkan bakatmu dalam animasi dan ciptakan karya terbaikmu! Ikuti lomba animasi yang
                            diadakan dari tanggal 1 Agustus 2024 - 31 Agustus 2024.</p>
                    </div>
                </div>
            </div>
            <div class="lomba-item show">
                <div class="lomba-inner">
                    <div class="lomba-front">
                        <img src="/img/maskot_website.png" alt="Sistem Informasi">
                        <p>Sistem Informasi</p>
                    </div>
                    <div class="lomba-back">
                        <p>Tunjukkan bakatmu dalam desain dan pengembangan website dengan mengikuti lomba ini. Raih
                            hadiah menarik, tunjukkan karyamu, dapatkan peluang magang, dan bergabunglah dengan
                            komunitas web developer!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pengumuman" class="section-pengumuman">
        <h2 class="section-headers">Pengumuman</h2>
        <div class="pengumuman-content">
            <div class="pengumuman-item">
                <div class="pengumuman-date">12/07/2024</div>
                <div class="pengumuman-title">Panduan Teknis</div>
                <img src="/img/maskot.png" alt="Panduan Teknis">
                <p>Panduan Teknis (Juknis).pdf</p>
                <a href="Panduan_Teknis.pdf" class="download-button" download>Download</a>
            </div>
            <div class="pengumuman-item">
                <div class="pengumuman-date">31/09/2024</div>
                <div class="pengumuman-title">Pengumuman Finalis</div>
                <img src="/img/maskot.png" alt="Pengumuman Finalis">
                <p>Pengumuman Finalis (Detail).pdf</p>
                <a href="#" class="detail-button" onclick="showDetail()">Detail</a>
            </div>
        </div>
    </section>

    <section id="footer" class="footer-image">
    </section>

    <footer>
        <div class="sosial">
            <h1>Follow Me</h1>
            <a href="https://wa.me/6281276301103/"><i class="ri-whatsapp-line"></i></a>
            <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=teamwebpolsri@gmail.com"><i
                    class="ri-google-fill"></i></a>
            <a href="https://www.instagram.com/alfrdhorzky_/"><i class="ri-instagram-line"></i></a>
        </div>

        <div class="credit">
            <i class=>© BAPPEDA Kota Palembang 2024</i>
        </div>

    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.home.js"></script>
</body>

</html>