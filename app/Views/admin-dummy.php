<html lang="en">


<head>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Include DataTables library -->
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url("css/admin.css") ?>">

    <style>
        .dataTables_wrapper .dataTables_filter .form-control {
            border-radius: 20px;
        }

        th,
        td {
            border-color: #fff;
            /* Hapus border-color dari sini */
        }

        th {
            background-color: #3D3D3E;
            color: #fff;
        }

        .table {
            background-color: #3D3D3E;
            color: #fff;
            border: 1px solid #fff;
            /* Tambahkan border */
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
                        <p id="username">Logged in as <?php echo $dataUser[0]['username']; ?></p>
                    </div>
                </div>
                <div class="profile-dropdown" id="profile-dropdown">
                    <div class="dropdown-hover">
                        <a href="<?= base_url() ?>">
                            Home
                        </a>
                    </div>
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
                        <a href="<?= base_url('auth/logout') ?>">
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
                    <!-- TABLE -->
                    <div class="d-flex">
                        <table id="article-tbl" class="table table-hover" style="color: white; margin-right: 10px;">
                            <thead style="width: 10%;">
                                <tr>
                                    <th style="background-color: #3D3D3E;">No.</th>
                                    <th style="background-color: #3D3D3E;">Username</th>
                                    <th style="background-color: #3D3D3E;">Created_at</th>
                                    <th style="background-color: #3D3D3E;">Last_active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($dataUser as $d) : ?>
                                    <tr class="parent" id="<?php echo $d['id']; ?>"> <!-- Tambahkan id pengguna sebagai id baris -->
                                        <td style="border: 1px solid #dee2e6;"><?php echo $i + 1; ?></td>
                                        <td class="d-flex justify-content-between align-items-center" style="border: 1px solid #dee2e6;">
                                            <div><?php echo $d["username"]; ?></div>
                                        </td>
                                        <!-- Tambahkan kolom Created_at dan Last_active -->
                                        <td style="border: 1px solid #dee2e6;"><?php echo $d["created_at"]; ?></td>
                                        <td style="border: 1px solid #dee2e6;"><?php echo $d["last_active"]; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
        var articlesData = <?php
                            // Function to recursively apply htmlspecialchars to string values
                            function htmlspecialcharsRecursive($array)
                            {
                                foreach ($array as $key => $value) {
                                    if (is_array($value)) {
                                        // If the value is an array, apply htmlspecialchars recursively
                                        $array[$key] = htmlspecialcharsRecursive($value);
                                    } elseif (is_string($value)) {
                                        // If the value is a string, apply htmlspecialchars
                                        $array[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                                    }
                                }
                                return $array;
                            }
                            // Encode the articles data and apply htmlspecialchars recursively
                            $encodedArticles = json_encode(htmlspecialcharsRecursive($articlesByUser), JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
                            echo $encodedArticles;
                            ?>;

        $(document).ready(function() {
            var table = $('#article-tbl').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });

            // Menampilkan sub-row saat baris utama diklik
            $('#article-tbl tbody').on('click', 'tr.parent', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var userId = tr.attr('id'); // Dapatkan user_id dari ID baris utama

                if (row.child.isShown()) {
                    // Baris ini sudah terbuka - tutup
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Buka baris ini
                    row.child(format(userId)).show();
                    tr.addClass('shown');
                }
            });
        });

        // Fungsi untuk menghasilkan HTML untuk sub-row
        function format(userId) {
            // Dapatkan data artikel untuk pengguna ini
            var articles = articlesData[userId]; // Mengakses data artikel berdasarkan ID pengguna
            console.log(articles);
            var html = '<div class="child-row">';
            html += '<table class="table table-hover">';
            html += '<thead>';
            html += '<tr>';
            html += '<th style="border: 1px solid #dee2e6;">Article ID</th>';
            html += '<th style="border: 1px solid #dee2e6;">Article Title</th>';
            html += '<th style="border: 1px solid #dee2e6;">Article Category</th>';
            html += '<th style="border: 1px solid #dee2e6;">Action</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            // Melakukan loop melalui artikel dan menambahkannya ke tabel
            count = 0;
            for (var i = 0; i < articles.length; i++) {
                html += '<tr>';
                html += '<td style="border: 1px solid #dee2e6;">' + (count + 1) + '</td>';
                html += '<td style="border: 1px solid #dee2e6;">' + articles[i]['article_title'] + '</td>';
                html += '<td style="border: 1px solid #dee2e6;">' + articles[i]['category_name'] + '</td>';
                html += '<td style="border: 1px solid #dee2e6;"><a href="#" onclick="editArticle(' + userId + ', ' + articles[i]['article_id'] + ', \'' + articles[i]['article_title'] + '\', \'' + articles[i]['article_script'] + '\')">Edit</a></td>';
                html += '</tr>';
                count++;
            }

            html += '</tbody>';
            html += '</table>';
            html += '</div>';
            return html;
        }

        function editArticle(userId, articleId, articleTitle, articleScript) {
            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '<?= base_url("user/edit-article") ?>');

            var articleIdField = document.createElement('input');
            articleIdField.setAttribute('type', 'hidden');
            articleIdField.setAttribute('name', 'article_id');
            articleIdField.setAttribute('value', articleId);
            form.appendChild(articleIdField);

            var userIdField = document.createElement('input');
            userIdField.setAttribute('type', 'hidden');
            userIdField.setAttribute('name', 'user_id');
            userIdField.setAttribute('value', userId);
            form.appendChild(userIdField);

            var articleTitleField = document.createElement('input');
            articleTitleField.setAttribute('type', 'hidden');
            articleTitleField.setAttribute('name', 'title');
            articleTitleField.setAttribute('value', articleTitle);
            form.appendChild(articleTitleField);

            var articleScriptField = document.createElement('input');
            articleScriptField.setAttribute('type', 'hidden');
            articleScriptField.setAttribute('name', 'content');
            articleScriptField.setAttribute('value', articleScript);
            form.appendChild(articleScriptField);

            document.body.appendChild(form);
            form.submit();
        }
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