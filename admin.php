<?php
include "database.php";

// Ambil data pengguna dari tabel users
$query = "SELECT id, username FROM users";
$users = getData($query);

// Inisialisasi array untuk menyimpan data artikel untuk setiap pengguna
$articles_data = [];

// Loop melalui setiap pengguna
foreach ($users as $user) {
    // Ambil data artikel yang sesuai dengan pengguna saat ini
    $user_id = $user['id'];
    $articles_data[$user_id] = readArticles($user_id);
}
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

        /* Styling untuk background tabel */
        .table {
            background-color: #212529;
            /* Warna background tabel gelap */
            color: #fff;
            /* Warna teks putih */
            border-radius: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: #343a40;
            /* Warna hover row yang lebih gelap */
        }

        .table th,
        .table td {
            border-color: #454d55;
            /* Warna border tabel */
        }

        .table th {
            background-color: #343a40;
            /* Warna background header tabel yang lebih gelap */
        }

        /* Styling untuk baris utama */
        .parent {
            background-color: #343a40;
            /* Warna background baris utama yang lebih gelap */
            color: #fff;
            /* Warna teks putih */
            cursor: pointer;
        }

        /* Styling untuk baris sub */
        .child {
            background-color: #454d55;
            /* Warna background baris sub yang lebih gelap */
            color: #fff;
            /* Warna teks putih */
        }

        /* Styling untuk card */
        .table-card {
            padding: 20px;
        }

        .dataTables_wrapper .dataTables_filter .form-control {
            border-radius: 20px;
            border-color: #454d55;
        }

        .table .parent .odd {
            background-color: #343a40;
        }


        .dataTables_wrapper {
            border-color: #454d55;
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
                        </div>
                        <!-- TABLE -->
                        <table id="article-tbl" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th></th> <!-- Tambahkan kolom kosong untuk tombol dropdown -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="parent"> <!-- Add the class "parent" to the parent row -->
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $user["username"]; ?></td>
                                        <td class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#user-<?php echo $user['id']; ?>"><i class="bi bi-caret-down-fill text-light"></i></td> <!-- Tambahkan tombol dropdown -->
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($users as $user) : ?>
                            <table id="user-<?php echo $user['id']; ?>" class="table table-hover child collapse" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Article ID</th>
                                        <th>Article Title</th>
                                        <th>Article Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($articles_data[$user['id']] as $article) : ?>
                                        <tr>
                                            <td><?php echo $article['article_id']; ?></td>
                                            <td><?php echo $article['article_title']; ?></td>
                                            <td><?php echo $article['category_name']; ?></td>
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
                var userId = $(this).find('td').first().text(); // Get the user_id from the first cell

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
            html += '<th>Article ID</th>';
            html += '<th>Article Title</th>';
            html += '<th>Article Category</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            // Loop through the articles and add them to the table
            for (var i = 0; i < articles.length; i++) {
                html += '<tr>';
                html += '<td>' + articles[i]['article_id']; + '</td>';
                html += '<td><a href="user_article.php?article_id=' + articles[i]['article_id'] + '&user_id=<?php echo $user["id"]; ?>">' + articles[i]['article_title'] + '</a></td>';
                html += '<td>' + articles[i]['category_name']; + '</td>';
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