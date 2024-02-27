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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables library -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Include Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #333;
            /* Warna background tema gelap */
            color: #fff;
            /* Warna teks putih */
        }

        /* Custom CSS */
        /* Tambahkan properti border */
        .table {
            background-color: #212529;
            color: #fff;
            border: 1px solid #454d55;
            /* Tambahkan border */
        }

        .table th,
        .table td {
            border-color: #454d55;
            /* Hapus border-color dari sini */
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        /* Styling untuk baris utama */
        .parent {
            background-color: #343a40;
            color: #fff;
            cursor: pointer;
            border-bottom: 1px solid #454d55;
            /* Tambahkan border-bottom */
        }

        /* Styling untuk baris sub */
        .child {
            background-color: #454d55;
            color: #fff;
        }

        /* Styling untuk card */
        .table-card {
            padding: 20px;
            border-radius: 20px;
        }

        /* Hapus styling yang tidak perlu */
        .dataTables_wrapper .dataTables_filter .form-control {
            border-color: #454d55;
        }

        .table .parent .odd {
            background-color: #343a40;
        }

        .dataTables_wrapper .dataTables_filter .form-control {
            border-color: #454d55;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <!-- Tambahkan card untuk memuat tabel -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-body">
                        <div class="Keterangan">
                            <h1 class="text-center">User Articles</h1>
                            <a href="home.php">Go to Homepage</a>
                        </div>
                        <!-- TABLE -->
                        <table id="article-tbl" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($dataUser as $d) : ?>
                                    <tr class="parent" id="<?php echo $d['dataUser']; ?>"> <!-- Tambahkan id pengguna sebagai id baris -->
                                        <td style="border: 1px solid #dee2e6;"><?php echo $i + 1; ?></td>
                                        <td class="d-flex justify-content-between align-items-center" style="border: 1px solid #dee2e6;">
                                            <div><?php echo $user["username"]; ?></div>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-caret-down"></i> <!-- Ikon panah ke bawah -->
                                                </button>
                                                <!-- Tidak ada dropdown menu -->
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($users as $user) : ?>
                            <table id="user-<?php echo $user['id']; ?>" class="table table-hover child" style="display: none;"> <!-- Hapus class "collapse" -->
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #dee2e6;">Article ID</th>
                                        <th style="border: 1px solid #dee2e6;">Article Title</th>
                                        <th style="border: 1px solid #dee2e6;">Article Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($articles_data[$user['id']] as $article) : ?>
                                        <tr>
                                            <td style="border: 1px solid #dee2e6;"><?php echo $article['article_id']; ?></td>
                                            <td style="border: 1px solid #dee2e6;"><?php echo $article['article_title']; ?></td>
                                            <td style="border: 1px solid #dee2e6;"><?php echo $article['category_name']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Convert the PHP array to JSON and store it in a JavaScript variable
        var articlesData = <?php echo json_encode($articles_data); ?>;

        $(document).ready(function() {
            var table = $('#article-tbl').DataTable({
                "paging": true,
                "searching": true,
                "info": false,
            });

            $('#article-tbl tbody').on('click', 'tr.parent', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var userId = tr.attr('id'); // Get the user_id from the parent row's ID

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(userId)).show();
                    tr.addClass('shown');
                }
            });
        });

        // Modify the format function to accept user_id as a parameter
        function format(userId) {
            // Get the articles data for this user
            var articles = articlesData[userId];

            var html = '<div class="child-row">';
            html += '<table class="table table-hover">';
            html += '<thead>';
            html += '<tr>';
            html += '<th style="border: 1px solid #dee2e6;">Article ID</th>';
            html += '<th style="border: 1px solid #dee2e6;">Article Title</th>';
            html += '<th style="border: 1px solid #dee2e6;">Article Category</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            // Loop through the articles and add them to the table
            for (var i = 0; i < articles.length; i++) {
                html += '<tr>';
                html += '<td style="border: 1px solid #dee2e6;">' + articles[i]['article_id'] + '</td>';
                html += '<td style="border: 1px solid #dee2e6;"> <a href="admin_article.php?user_id=' + userId + '&article_id=' + articles[i]['article_id'] + '">' + articles[i]['article_title'] + '</a> </td>';
                html += '<td style="border: 1px solid #dee2e6;">' + articles[i]['category_name'] + '</td>';
                html += '</tr>';
            }

            html += '</tbody>';
            html += '</table>';
            html += '</div>';
            return html;
        }
    </script>
</body>

</html>