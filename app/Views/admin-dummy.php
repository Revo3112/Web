<?php
// include "database.php";

// // Ambil data pengguna dari tabel users
// $query = "SELECT id, username FROM users WHERE role = 'User'";
// $users = getData($query);

// // Inisialisasi array untuk menyimpan data artikel untuk setiap pengguna
// $articles_data = [];

// // Loop melalui setiap pengguna
// foreach ($users as $user) {
//     // Ambil data artikel yang sesuai dengan pengguna saat ini
//     $user_id = $user['id'];
//     $articles_data[$user_id] = readArticles($user_id);
// }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="<?php echo base_url("css/admin.css") ?>"> -->
    <style>
        /* import */
        @import url('https://fonts.cdnfonts.com/css/chomsky');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:wght@500;600;700&display=swap');

        :root {
            --app-bg: #000000;
            --sidebar: #121212;
            --sidebar-text: #B3B3B3;
            --sidebar-text-active: #fff;
            --dropdown-bg: #282828;
            --active-hover: #3D3D3E;
            --widgets-active: #242424;
        }


        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        body {
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: var(--app-bg);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .app-logo-text {
            display: flex;
            align-items: center;
            border-radius: 7px;
            background: linear-gradient(135deg, #4300ff 0%, #717371 100%);
            width: 50px;
            height: 50px;
            justify-content: center;
            font-family: 'Chomsky';
            font-size: 40;
            font-weight: 100;
        }

        .app-icon p {
            color: var(--sidebar-text-active);
            margin-right: 2px;
        }

        .app-icon {
            display: flex;
            align-items: center;
            padding: 0 10 0 10;
            border-radius: 10px;
            transition: background-color 200ms;
            cursor: pointer;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            border-radius: 3px;
            width: 90px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 3px 0 rgba(0, 0, 0, 0.19);
            /* Box shadow added */
            background-color: var(--dropdown-bg);
            z-index: 1;
        }

        .profile-dropdown a {
            padding: 7px;
            font-size: 13;
            color: var(--sidebar-text-active);
            text-decoration: none;
            display: block;
        }

        .app-icon:hover {
            #username {
                color: var(--sidebar-text-active);
                transition: 200ms;
            }

            background-color: var(--active-hover);
            transition: 200ms;
        }

        .dropdown-hover {
            border-radius: 5px;
            margin: 3;
        }

        .dropdown-hover:hover {
            background-color: var(--active-hover);
            transition: 200ms;
        }

        #username {
            font-size: 15;
            color: var(--sidebar-text);
            margin-top: -17;
            transition: color 200ms;
        }


        .app-container {
            border-radius: 4px;
            width: 100%;
            height: 100%;
            max-height: 100%;
            display: flex;
            overflow: hidden;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            max-width: 2000px;
        }

        .app-logo-admin {
            margin-left: 15;
        }

        .sidebar {
            border-radius: 10px;
            margin: 10;
            padding: 10;
            flex-basis: 250px;
            max-width: 300px;
            flex-shrink: 0;
            background-color: var(--sidebar);
            display: flex;
            flex-direction: column;
        }

        .sidebar-list-item a {
            text-decoration: none;
            color: var(--sidebar-text);
            font-size: 18px;
            align-items: center;
            display: flex;
            width: 100%;
        }

        .sidebar-list-item {
            display: flex;
            list-style: none;
            height: 30px;
            margin-bottom: 20px;
            margin-left: -27px;
            transition: color 200ms;
        }

        .sidebar-list-item.active a {
            color: var(--sidebar-text-active);
        }

        .sidebar-list-item a:hover {
            color: var(--sidebar-text-active);
            transition: 200ms;
        }

        .app-content {
            border-radius: 10px;
            margin: 10 0 10 0;
            padding: 0 0 0 10;
            max-width: 2300px;
            flex-shrink: 0;
            background-color: var(--sidebar);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        svg {
            margin-right: 20px;
            width: 25;
            height: 25;
        }

        .app-content-image {
            width: 970px;
            height: 200px;
            margin-left: -10px;
            border-radius: 10px 10px 0px 0px;
            object-fit: cover;
            background-size: cover;
            background-image: linear-gradient(360deg, rgba(0, 0, 0, 1.6601015406162465) 0%, rgba(92, 0, 0, 0.0678606442577031) 80%), url("https://wallpapercave.com/wp/wp3396925.jpg");
            object-position: 100% 0;
            image-rendering: pixelated;
            -ms-interpolation-mode: nearest-neighbor;
            -webkit-transform: scale(0.999);
            transform: scale(0.999);
        }

        .app-content-headerText {
            color: var(--sidebar-text-active);
            position: relative;
            bottom: 160px;
            margin-left: 20px;
            font-size: 2.5rem;
        }

        .app-content-headerBrand svg {
            position: relative;
            bottom: 2px;
            right: 2px;
            width: 18px;
            height: 18px;
            fill: #0c67d3;
        }

        .app-content-headerBrand {
            position: relative;
            bottom: 70px;
            right: 30px;
            justify-content: right;
            align-items: center;
            display: flex;
        }

        .app-content-headerBrand h1 {
            position: relative;
            bottom: 2px;
            margin-right: 10px;
            font-weight: normal;
            font-family: 'Chomsky', serif;
            font-size: 25px;
            color: var(--sidebar-text-active);
        }

        .circle-spot-brand {
            background-color: white;
            border-radius: 50%;
            height: 13px;
            width: 13px;
        }

        .search-bar-container {
            position: relative;
            background-color: #0c67d3;
            display: flex;
            align-items: center;
            padding-left: 12px;
            margin-top: 10px;
            max-width: 450px;
            width: 280px;
            height: 40px;
            background-color: var(--widgets-active);
            border-radius: 20px;
            border: 1px solid transparent;
        }

        .search-bar {
            position: relative;
            color: var(--sidebar-text-active);
            width: 400px;
            font-family: 'Poppins';
            font-size: 14px;
            background-color: transparent;
            outline-width: 0;
            border: 1px solid transparent;
        }

        .search-bar-container:hover {
            border: 1px solid var(--sidebar-text);
        }

        .app-content-actions {
            position: relative;
            bottom: 170px;
            display: flex;
            align-items: center;
        }

        .app-content-actions .edit-button {
            align-items: center;
            display: flex;
            margin-top: 10px;
            max-width: 300px;
            position: relative;
            left: 490px;
            width: 65px;
            margin-right: 10px;
            height: 40px;
            border-radius: 20px;
            background-color: var(--widgets-active);
            color: var(--sidebar-text-active);
        }

        .app-content-actions .create-button {
            align-items: center;
            display: flex;
            margin-top: 10px;
            max-width: 300px;
            position: relative;
            left: 490px;
            width: 85px;
            height: 40px;
            border-radius: 20px;
            background-color: var(--widgets-active);
            color: var(--sidebar-text-active);
        }

        .app-content-actions .edit-button p {
            margin-left: 17px;
        }

        .app-content-actions .create-button p {
            margin-left: 15px;
        }

        .edit-button:hover {
            cursor: pointer;
            background-color: var(--active-hover);
        }

        .create-button:hover {
            cursor: pointer;
            background-color: var(--active-hover);
        }

        .app-content-middle {
            position: relative;
            bottom: 170px;
        }

        .content-header-overview h1 {
            margin-top: 30px;
            margin-left: 15px;
            color: white;
            font-size: 25px;
        }

        .content-image img {
            border-radius: 7px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            object-position: 100% 0;
            -ms-interpolation-mode: nearest-neighbor;
            -webkit-transform: scale(0.999);
            transform: scale(0.999);
        }

        .content-row-overview {
            color: white;
            display: flex;
            align-items: center;
        }

        .content-overview {
            margin-right: 10px;
            padding: 15px;
            justify-self: center;
            align-items: center;
            width: 150px;
            height: 250px;
            background-color: #181818;
            border-radius: 10px;
            transition: background-color 100ms;
        }

        .content-overview:hover {
            cursor: pointer;
            background-color: #272727;
            transition: 200ms;
        }

        .title-desc h1 {
            position: relative;
            bottom: 25px;
        }

        .title-status p {
            color: var(--sidebar-text);
            position: relative;
            bottom: 50px;
            font-size: 12px;
        }

        .content-chart-preview {
            display: flex;
            justify-content: space-between;
            width: 400px;
            height: 200px;
            margin: 0 auto;
            background-color: #3D3D3E;
            padding: 10px;
        }

        .content-body-overview {
            margin: 0 auto;
            width: 900px;
        }

        .table-body-header {
            display: flex;
            align-items: center;
            background-color: var(--active-hover);
            color: var(--sidebar-text-active);
            border-radius: 4px;
            width: 900px;
            margin: 0 auto;
        }

        .table-body-content {
            display: flex;
            align-items: center;
            color: var(--sidebar-text);
            border-radius: 4px;
            width: 900px;
            margin: 0 auto;
        }

        .user-data {
            display: flex;
            align-items: center;
            margin: 0 auto;
            padding: 5px;
        }

        .user-cell {
            display: flex;
            align-items: center;
            margin: 0 auto;
            padding: 5px;
        }

        .sort-button {
            display: flex;
            padding: 0;
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: var(--sidebar-text);
            margin-left: 4px;
            align-items: center;

            &:hover {
                color: var(--sidebar-text-active);
            }

            svg {
                width: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon" onclick="toggleAppIconDropdown()">
                    <div class="app-logo-text">
                        <p>T</p>
                    </div>
                    <div class="app-logo-admin">
                        <p>Admin Panel</p>
                        <p id="username">Logged in as <?php echo session()->get('username'); ?></p>
                    </div>
                </div>
                <div class="profile-dropdown" id="profile-dropdown">
                    <div class="dropdown-hover">
                        <a href="#">
                            Profile
                        </a>
                    </div>
                    <div class="dropdown-hover">
                        <a href="#">
                            Settings
                        </a>
                    </div>
                    <div class="dropdown-hover">
                        <a href="#">
                            Log out
                        </a>
                    </div>
                </div>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item active">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                        <span>Tables</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Articles</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Tools</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Charts</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Widgets</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Gallery</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12" />
                            <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
                        </svg>
                        <span>Inbox</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span>Notifications</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span>Extras</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- content -->
        <div class="app-content">
            <div class="app-content-header">
                <div class="app-content-image"></div>
                <div class="app-content-headerBrand">
                    <h1>The Tangerang Times</h1>
                    <div class="circle-spot-brand">
                        <svg data-encore-id="icon" role="img" aria-hidden="true" class="Svg-sc-ytk21e-0 gxNUVX b0NcxAbHvRbqgs2S8QDg" viewBox="0 0 24 24">
                            <path d="M10.814.5a1.658 1.658 0 0 1 2.372 0l2.512 2.572 3.595-.043a1.658 1.658 0 0 1 1.678 1.678l-.043 3.595 2.572 2.512c.667.65.667 1.722 0 2.372l-2.572 2.512.043 3.595a1.658 1.658 0 0 1-1.678 1.678l-3.595-.043-2.512 2.572a1.658 1.658 0 0 1-2.372 0l-2.512-2.572-3.595.043a1.658 1.658 0 0 1-1.678-1.678l.043-3.595L.5 13.186a1.658 1.658 0 0 1 0-2.372l2.572-2.512-.043-3.595a1.658 1.658 0 0 1 1.678-1.678l3.595.043L10.814.5zm6.584 9.12a1 1 0 0 0-1.414-1.413l-6.011 6.01-1.894-1.893a1 1 0 0 0-1.414 1.414l3.308 3.308 7.425-7.425z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="app-content-headerText">Dashboard</h1>
                <div class="app-content-actions">
                    <div class="search-bar-container" onclick="toggleSearchBar()">
                        <svg class="svg-icon search-icon" aria-labelledby="title desc" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7">
                            <g class="search-path" fill="none" stroke="#fff">
                                <path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4" />
                                <circle cx="8" cy="8" r="7" />
                            </g>
                        </svg>
                        <input type="text" class="search-bar" placeholder="What do you want to access?">
                    </div>
                    <div class="edit-button">
                        <p>Edit</p>
                    </div>
                    <div class="create-button">
                        <p>Create</p>
                    </div>
                </div>
            </div>
            <div class="app-content-middle">
                <div class="content-header-overview">
                    <h1>Overview</h1>
                </div>
                <div class="content-row-overview">
                    <div class="content-overview">
                        <div class="content-image">
                            <img src="https://i.pinimg.com/564x/e3/7b/40/e37b4010be5d8e889692354fb6b7c9dd.jpg" alt="ct image">
                        </div>
                        <div class="title-info">
                            <p>Articles</p>
                        </div>
                        <div class="title-desc">
                            <h1>294.738</h1>
                        </div>
                        <div class="title-status">
                            <p>Successfully Published</p>
                        </div>
                    </div>
                    <div class="content-overview">
                        <div class="content-image">
                            <img src="https://i.pinimg.com/564x/71/ac/90/71ac90996a962ea92772e0507857f14e.jpg" alt="ct image">
                        </div>
                        <div class="title-info">
                            <p>Active Users</p>
                        </div>
                        <div class="title-desc">
                            <h1>1.728.300</h1>
                        </div>
                        <div class="title-status">
                            <p>Rapid Growth</p>
                        </div>
                    </div>
                    <div class="content-overview">
                        <div class="content-image">
                            <img src="https://i.pinimg.com/736x/33/3e/be/333ebe37db59afdf8837243bd782df2f.jpg" alt="ct image">
                        </div>
                        <div class="title-info">
                            <p>Acceptance Rate</p>
                        </div>
                        <div class="title-desc">
                            <h1>95.73%</h1>
                        </div>
                        <div class="title-status">
                            <p>High Rate</p>
                        </div>
                    </div>
                    <div class="content-overview">
                        <div class="content-image">
                            <img src="https://i.pinimg.com/564x/98/ee/3b/98ee3b2e9beb1fc8c48501008b4e283e.jpg" alt="ct image">
                        </div>
                        <div class="title-info">
                            <p>Unique Visitors</p>
                        </div>
                        <div class="title-desc">
                            <h1>45.771</h1>
                        </div>
                        <div class="title-status">
                            <p>Everyday Growth by 50%</p>
                        </div>
                    </div>
                    <div class="content-overview">
                        <div class="content-image">
                            <img src="https://i.pinimg.com/564x/46/24/5d/46245dcd001e3639b2cd4c4a8bf1292c.jpg" alt="ct image">
                        </div>
                        <div class="title-info">
                            <p>Total Users</p>
                        </div>
                        <div class="title-desc">
                            <h1>9.722.441</h1>
                        </div>
                        <div class="title-status">
                            <p>#1 Best Article Publisher</p>
                        </div>
                    </div>
                </div>
                <div class="content-chart">
                    <div class="content-header-overview">
                        <h1>Monthly Users Analytic</h1>
                    </div>
                    <div class="content-body-overview">
                        <canvas id="user-analytic"></canvas>
                    </div>
                </div>
                <div class="content-chart">
                    <div class="content-header-overview">
                        <h1>Most Active Users by Country</h1>
                    </div>
                    <div class="content-body-overview">
                        <canvas id="active-user-states"></canvas>
                    </div>
                </div>
                <div class="content-chart">
                    <div class="content-header-overview">
                        <h1>User Table</h1>
                    </div>
                    <div class="table-body-header">
                        <div class="user-cell">
                            User Tag
                            <button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="user-cell">
                            Username
                            <button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="user-cell">
                            Status
                            <button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="user-cell">
                            Created Since
                            <button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="table-body-content">
                        <?php $i = 0; ?>
                        <?php foreach ($dataUser as $user) : ?>
                            <div class="user-data"><?php echo $user['id']; ?></div>
                            <div class="user-data"><?php echo $user['id']; ?></div>
                            <div class="user-data"><?php echo $user['id']; ?></div>
                            <div class="user-data"><?php echo $user['id']; ?></div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script>
        // tb script

        // charts
        const userData = document.getElementById("user-analytic");
        const userDataStates = document.getElementById("active-user-states");

        Chart.defaults.color = "#fff";

        const xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "October",
            "November", "Desember"
        ];
        const xValues2 = ["U.S.A", "Indonesia", "China", "Argentina", "New Zealand", "Singapore", "Malaysia", "Canada", "France", "UAE", "Turkey"];
        const yValues = [1293, 1732, 9283, 1000, 1923, 1488, 10231, 7402, 100, 1392, 18888];
        const yValues2 = [1293, 12312, 9283, 1000, 32142, 1488, 10231, 1231, 11100, 1392, 2322];
        const barColors = ["#969696", "#969696", "#969696", "#969696", "#969696", "#969696", "#969696", "#969696", "#969696", "#969696", "#969696"];

        const stateChart = new Chart(userDataStates, {
            type: "bar",
            data: {
                labels: xValues2,
                datasets: [{
                    backgroundColor: barColors,
                    hoverBackgroundColor: "#fff",
                    data: yValues2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            }
        })
        const myChart = new Chart(userData, {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    hoverBackgroundColor: "#fff",
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            }
        });

        // Toggle dropdown from app-icon
        function toggleAppIconDropdown() {
            var dropdown = document.getElementById("profile-dropdown");
            var toggleButton = document.getElementsByClassName("app-icon")[0];
            var username = document.getElementById("username");

            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
                // Reset background color
                toggleButton.style.backgroundColor = ""; // Customize as needed
                username.style.color = "";
            } else {
                dropdown.style.display = "block";
                // Adjusting position based on window boundaries
                var dropdownWidth = dropdown.offsetWidth;
                var dropdownHeight = dropdown.offsetHeight;
                var windowWidth = window.innerWidth;
                var windowHeight = window.innerHeight;
                var posX = event.clientX + window.pageXOffset + 10;
                var posY = event.clientY + window.pageYOffset - 10;
                if (posX + dropdownWidth > windowWidth) {
                    posX -= dropdownWidth;
                }
                if (posY + dropdownHeight > windowHeight) {
                    posY -= dropdownHeight;
                }
                dropdown.style.left = posX + "px";
                dropdown.style.top = posY + "px";

                // Set background color when dropdown opens
                toggleButton.style.backgroundColor = "#333333"; // Customize as needed
                username.style.color = "#fff";
            }
        }

        function toggleSearchBar() {
            var searchBar = document.getElementsByClassName("search-bar-container")[0];
            if (!event.target.closest('.search-bar-container')) {
                searchBar.style.border = "";
            } else {
                searchBar.style.border = "2px solid #fff";
            }
        }

        window.onclick = function(event) {
            toggleSearchBar(event);
        };

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('.app-icon')) {
                var dropdown = document.getElementById("profile-dropdown");
                dropdown.style.display = "none";
                // Reset background color to transparent
                var toggleButton = document.getElementsByClassName("app-icon")[0];
                toggleButton.style.backgroundColor = ""; // Customize as needed
                username.style.color = "";
            }
        };
    </script>
</body>

</html>