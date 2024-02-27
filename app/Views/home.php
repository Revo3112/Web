<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Tangerang Times</title>
    <link rel="icon" href="assets/home/icon.png">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Quill -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

</head>

<body>
    <style>
        @import url('https://fonts.cdnfonts.com/css/chomsky');

        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
        }

        .left-container {
            flex: 1;
            text-align: left;
            font-size: small;
        }

        #current-date {
            font-weight: bold;
        }

        .center-container a {
            flex: 1;
            text-align: center;
            font-family: 'Chomsky', serif;
            font-size: 65px;
            text-decoration: none;
            color: black;
        }

        .right-container {
            flex: 1;
            text-align: right;
        }

        .right-container button {
            font-size: small;
            font-weight: bold;
        }

        .header-divider {
            width: 90%;
            margin: 0 auto;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 160 0 160;
            font-size: small;
        }

        .nav li {
            color: black;
            font-size: 12;
            font-weight: bold;
        }

        .nav li:hover {
            text-decoration: underline;
            text-decoration-style: solid;
        }

        .topic-divider::after {
            content: '';
            border-right: 1px double #C8C8C9;
        }

        .line-1::after {
            margin: 0 auto;
            content: '';
            border-bottom: 1px double black;
            width: 90%;
            display: block;
        }

        .line-2::after {
            margin: 2 auto;
            content: '';
            border-bottom: 1px double black;
            width: 90%;
            display: block;
        }

        /* live news css */
        .live-news-container {
            align-items: center;
            display: flex;
            justify-content: space-between;
            margin: 20 230 20 230;
            font-size: small;
        }

        .live-icon {
            flex: 1;
            font-weight: 800;
            margin-right: -200;
            margin-left: 150;
            color: red;
        }

        .live-location {
            flex: 1;
        }

        .live-location-text {
            font-weight: 800;
        }

        .live-time {
            flex: 1;

        }

        .live-info-text {
            font-weight: 800;
        }

        .live-info {
            flex: 1;

        }

        .live-info-time {
            flex: 1;

        }

        .news-container {
            display: grid;
            grid-template-columns: 65% 25%;
            margin-left: 66;
            margin-right: 136;
            gap: 20px;
        }

        .content-container {
            padding-top: 20px;
            padding-right: 10px;
            padding-bottom: 10px;
            border-top: 1px double #000;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .bar-line::before {
            content: '';
            height: 107em;
            position: absolute;
            top: 210;
            bottom: 0;
            border-left: 1px solid #c7c7c7;
        }

        .bar-container {
            padding-left: 20px;
            padding-top: 20px;
            padding-right: 10px;
            padding-bottom: 10px;
            border-top: 1px double #000;
            display: grid;
            width: 160%;
            grid-template-columns: repeat(2, 1fr);
        }

        .news-divider-container a {
            color: black;
            text-decoration: none;
        }

        .news-bar-container a {
            color: black;
            text-decoration: none;
        }

        .title {
            font-weight: 800;
            font-size: 20;
        }

        .description {
            font-size: 13;
        }

        .news-divider-container a:hover {
            color: #666;
        }

        .news-bar-container a:hover {
            color: #666;
        }
    </style>
    <!-- Header -->
    <div class="container">
        <div class="left-container">
            <span id="current-date"></span><br>
            <span id="current-time"></span>
        </div>
        <div class="center-container">
            <a href="home.php">The Tangerang Times</a>
        </div>
        <div class="right-container">
            <?php if (session()->get('logged_in') == false) : ?>
                <a href="login">
                    <button type="button" class="btn btn-dark btn-sm">MASUK</button>
                </a>
            <?php else : ?>
                <?php if (session()->get('role') == 'Admin') : ?>
                    <a class="nav-link" href="<?= base_url('admin') ?>" style="display: flex; align-items: center;  margin-left: 200px">
                        <p style="display: inline-block; position: relative; top: 10px; margin-right: 10px"><?php echo session()->get('name')  ?></p>
                        <span class=" iconify" data-icon="mdi:account-circle" style="font-size: 50px;"></span>
                    </a>
                <?php else : ?>
                    <a class="nav-link" href="<?= base_url('user') ?>" style="display: flex; align-items: center; margin-left: 200px;">
                        <p style="display: inline-block; position: relative; top: 10px; margin-right: 10px;"><?php echo session()->get('name')  ?></p>
                        <span class="iconify" data-icon="mdi:account-circle" style="font-size: 50px;"></span>
                    </a>
                <?php endif; ?>
            <?php endif ?>
        </div>
    </div>
    <hr class="header-divider">
    <!-- Topics -->
    <nav>
        <ul class="nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Indonesia
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Pemilu</a></li>
                    <li><a class="dropdown-item" href="#">Politik</a></li>
                    <li><a class="dropdown-item" href="#">Jakarta</a></li>
                    <li><a class="dropdown-item" href="#">Tangerang</a></li>
                    <li><a class="dropdown-item" href="#">Iklim</a></li>
                    <li><a class="dropdown-item" href="#">Edukasi</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dunia
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bisnis
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Seni
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Lifestyle
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <!-- divider -->
            <div class="topic-divider"></div>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sains
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Teknologi
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Otomotif
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bolanita
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Lainnya
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
        </ul>
        <div class="line-1"></div>
        <div class="line-2"></div>
    </nav>
    <!-- live news -->
    <div class="live-news-container">
        <div class="live-icon">
            <span class="live-icon-text">LIVE</span>
        </div>
        <div class="live-location">
            <span class="live-location-text">Stadium Gelora Bung Karno</span>
            <span class="live-time-text">10m ago</span>
        </div>
        <div class="live-info">
            <span class="live-info-text">Pemilu 2024</span>
            <span class="live-info-time-text">54m ago</span>
        </div>
    </div>
    <!-- news 1 -->
    <div class="news-container">
        <div class="news-divider-container">
            <a href="https://kumparan.com/kumparannews/satgas-pangan-polri-sidak-gudang-beras-bulog-di-jakut-pastikan-stok-cukup-22DTzse2IsX">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">Satgas Pangan Polri Sidak Gudang Beras Bulog di Jakut, Pastikan Stok Cukup</p>
                        <br>
                        <p class="description">
                            Satgas Pangan Polri melakukan inspeksi mendadak (sidak) ke Gudang Beras Bulog di kawasan Jakarta Utara pada Kamis (22/2). Sidak ini dilakukan untuk mengecek stok beras menjelang bulan Ramadan.
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hq8kpfrxbd7bb1vmpk2zdf06.jpg" alt="image" width="400">
                    </div>
                </div>
            </a>
            <a href="https://kumparan.com/kumparannews/gp-ansor-beberkan-alasan-tolak-pengajian-ustaz-syafiq-basalamah-di-surabaya-22DUDXTYAz5">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">GP Ansor Beberkan Alasan Tolak Pengajian Ustaz Syafiq Basalamah di Surabaya</p>
                        <br>
                        <p class="description">
                            PAC GP Ansor Kecamatan Gunung Anyar, Surabaya, menolak kehadiran Ustaz Syafiq Riza Basalamah di acara Tablik Akbar di Masjid Assalam Purimas, Surabaya, pada Kamis (22/2).
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_1024/v1634025439/01hq8r76ajekydf6rv2xwpg132.jpg" alt="image" width="350">
                    </div>
                </div>
            </a>
            <a href="https://kumparan.com/kumparanbisnis/sri-mulyani-ungkap-prabowo-dapat-rp-500-miliar-buat-rawat-alutsista-22DQn96i7Bt">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">Sri Mulyani Ungkap Prabowo Dapat Rp 500 Miliar buat Rawat Alutsista</p>
                        <br>
                        <p class="description">
                            Menteri Keuangan Sri Mulyani mengungkapkan Kementerian Pertahanan yang dipimpin oleh Prabowo Subianto mendapatkan anggaran senilai Rp 500 miliar di Januari 2024. Anggaran tersebut diberikan untuk merawat Barang Milik Negara (BMN) dan alutsista Kemhan dalam rangka mendukung alat sistem pertahanan pada matra darat, laut, udara.
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hkp7c44hafpc7jqa94d15x5m.png" alt="image" width="350">
                    </div>
                </div>
            </a>
            <a href="https://kumparan.com/kumparanbola/hasil-liga-1-persija-disikat-madura-united-arema-raup-3-poin-22DR7TxlqEU">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">Hasil Liga 1: Persija Disikat Madura United, Arema Raup 3 Poin</p>
                        <br>
                        <p class="description">
                            Persija Jakarta harus menelan kekalahan kala menjamu Madura United dalam lanjutan Liga 1. Berlaga di Stadion Kapten I Wayan Dipta, Gianyar, Kamis (22/2), Persija kalah tipis dengan skor 0-1.
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hq8fgfy2ps8acawmd4y9jw2t.jpg" alt="image" width="350">
                    </div>
                </div>
            </a>
            <a href="https://kumparan.com/kumparansains/prudential-rilis-asuransi-jiwa-buat-milenial-dan-gen-z-namanya-prufuture-22DMVQuHg35">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">Prudential Rilis Asuransi Jiwa buat Milenial dan Gen Z, Namanya PRUFuture</p>
                        <br>
                        <p class="description">
                            Prudential Life Assurance merilis produk asuransi jiwa baru bernama PRUFuture, yang diklaim sangat simpel, mudah diakses, dan premi terjangkau. Asuransi ini khusus ditujukan untuk anak muda, terutama generasi milenial dan Gen Z.
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hq7yv9jqcxncxftdh35zfqmk.jpg" alt="image" width="350">
                    </div>
                </div>
            </a>
            <a href="https://kumparan.com/kumparantravel/traveler-jangan-pakai-baju-loreng-saat-naik-kapal-pesiar-ini-alasannya-221WqrhqLsr/2">
                <div class="content-container">
                    <div class="content-information">
                        <p class="title">Traveler Jangan Pakai Baju Loreng Saat Naik Kapal Pesiar, Ini Alasannya</p>
                        <br>
                        <p class="description">
                            Saat liburan naik kapal pesiar, traveler tentu tahu ada aturan yang harus dipatuhi, termasuk dalam hal berpakaian. Ya, sama seperti di pesawat terbang, ada beberapa aturan berpakaian yang harus kamu perhatikan saat berada di kapal pesiar.
                        </p>
                    </div>
                    <div class="content-figure">
                        <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hmtzy8gw5ge5t1mrje3eyx79.jpg" alt="image" width="350">
                    </div>
                </div>
            </a>
        </div>
        <!-- news 2 -->
        <div class="news-bar-container">
            <div class="bar-line"></div>
            <a href="https://kumparan.com/kumparannews/nasdem-pkb-pks-sepakat-gulirkan-hak-angket-usut-kecurangan-pemilu-22DQTJLxeAl">
                <div class="bar-container">
                    <div class="content-information">
                        <div class="content-figure">
                            <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hq8bkj1e5dpt5bvmh8pb7mxv.jpg" alt="image" width="400">
                        </div>
                        <p class="title">NasDem, PKB, PKS Sepakat Gulirkan Hak Angket Usut Kecurangan Pemilu</p>
                        <br>
                        <p class="description">
                            Partai anggota Koalisi Perubahan, NasDem, PKS, dan PKB sepakat untuk menggulirkan hak angket pengusutan kecurangan Pemilu 2024 di KPU yang diinisiasi oleh PDIP.
                        </p>
                    </div>
                </div>
            </a>
            <div class="bar-line"></div>
            <a href="https://kumparan.com/kumparannews/polling-jika-sampah-baliho-pemilu-dijadikan-tas-kamu-minat-atau-enggak-228viVV0Qg9">
                <div class="bar-container">
                    <div class="content-information">
                        <div class="content-figure">
                            <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hpbhyssa1ewg2ehkc679b2gw.jpg" alt="image" width="400">
                        </div>
                        <p class="title">Polling: Jika Sampah Baliho Pemilu Dijadikan Tas, Kamu Minat atau Enggak?</p>
                        <br>
                        <p class="description">
                            Hari Minggu (11/2) merupakan dimulainya masa tenang kampanye sebelum pencoblosan 14 Februari mendatang. Pada masa jeda ini, tidak ada lagi kegiatan kampanye. Alat peraga kampanye [APK], seperti baliho sebagian besar juga telah dibersihkan.
                            Pantauan kumparan, beberapa jalan yang biasanya ja
                        </p>
                    </div>
                </div>
            </a>
            <div class="bar-line"></div>
            <a href="https://kumparan.com/kumparank-pop/harga-tiket-fancon-cha-eun-woo-di-jakarta-termurah-rp-1-juta-22DRfYXa5KY">
                <div class="bar-container">
                    <div class="content-information">
                        <div class="content-figure">
                            <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01hdtawddcyrz4gwy4xvqde8ag.jpg" alt="image" width="400">
                        </div>
                        <p class="title">Harga Tiket Fancon Cha Eun Woo di Jakarta, Termurah Rp 1 Juta</p>
                        <br>
                        <p class="description">
                            Kabar yang dinanti-nanti para penggemar Cha Eun Woo akhirnya tiba juga. VIU Indonesia yang memboyong member Astro itu ke Jakarta telah merilis daftar harga tiket dan seat plan untuk fancon 2024 Just One 10 Minute Mystery Elevator pada April mendatang.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Iconify -->
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- get date time -->
    <script>
        // Function to get the day of the week in a string format
        function getDayOfWeekString(dayIndex) {
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            return daysOfWeek[dayIndex];
        }

        // Function to get the month in a string format
        function getMonthString(monthIndex) {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return months[monthIndex];
        }

        // Function to get the current date in the format "Wednesday, 10 February 2024"
        function getCurrentDate() {
            var currentDate = new Date();
            var dayOfWeek = getDayOfWeekString(currentDate.getDay());
            var dayOfMonth = currentDate.getDate();
            var month = getMonthString(currentDate.getMonth());
            var year = currentDate.getFullYear();
            return dayOfWeek + ", " + dayOfMonth + " " + month + " " + year;
        }

        // Function to get the current time in the format "10:11 AM"
        function getCurrentTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // Handle midnight (0 hours)
            minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero if minutes < 10
            return hours + ':' + minutes + ' ' + ampm;
        }

        // Update the date container with the current date and time
        function updateDateTime() {
            var dateContainer = document.getElementById("current-date");
            var timeContainer = document.getElementById("current-time");
            dateContainer.textContent = getCurrentDate();
            timeContainer.textContent = getCurrentTime();
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initial update
        updateDateTime();
    </script>
</body>

</html>

<?php

?>