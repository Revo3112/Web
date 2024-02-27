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
                            <a href="<?= base_url() ?>">Go to Homepage</a>
                        </div>
                        <!-- TABLE -->
                        <table id="article-tbl" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Created_at</th>
                                    <th>Last_active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($dataUser as $d) : ?>
                                    <tr class="parent" id="<?php echo $d['id']; ?>"> <!-- Tambahkan id pengguna sebagai id baris -->
                                        <td style="border: 1px solid #dee2e6;"><?php echo $i + 1; ?></td>
                                        <td class="d-flex justify-content-between align-items-center" style="border: 1px solid #dee2e6;">
                                            <div><?php echo $d["username"]; ?></div>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-caret-down"></i> <!-- Ikon panah ke bawah -->
                                                </button>
                                            </div>
                                        </td>
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

    <script>
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
                "searching": true,
                "info": false,
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
    </script>
</body>

</html>