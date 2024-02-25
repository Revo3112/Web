<?php

include "database.php";

$user_id = $_GET["id"];

$query = "SELECT * FROM users WHERE id=$user_id";
$dataUser = getData($query);

$query = "SELECT * FROM articles WHERE user_id=$user_id";
$dataArticle = getData($query);

if (isset($_GET["status"])) {
    if ($_GET["status"] == "success") {
        echo "<script>
            alert('Berhasil');
        </script>";
    }
}

if (isset($_POST['delete-article-id'])) {
    $article_id = $_POST['delete-article-id'];

    deleteUserArticle($user_id, $article_id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <!-- S: Ketika user tambah article -->
    <!-- TODO: hilangkan form ketika statusnya bergantung pada articleid dari get -->

    <form action="insert_article.php" method="post">
        <input type="hidden" name="user-id" value="<?= $user_id ?>">
        <button type="submit" class="btn btn-primary">
            <span class="iconify" data-icon="mdi-plus"></span>
            Tambah Article
        </button>
        <a href="home.php" style="margin-left: 20px;">Go to Homepage</a>
    </form>


    <!-- S: Ketika user edit article -->
    <form id="article-form" action="edit_article.php" method="post">
        <input type="hidden" name="user-id" value="<?= $user_id ?>">
        <input type="hidden" name="article-id" value="">
        <input type="hidden" name="article-script" value="">
        <table id="article-tbl">
            <thead>
                <th>No.</th>
                <th>Title</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach ($dataArticle as $d) : ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $d["title"] ?></td>
                        <td>
                            <button type="submit" class="btn btn-warning edit-btn" data-article_id="<?= $d['id'] ?>" data-article_script="<?= $d['script'] ?>">
                                <span class="iconify" data-icon="mdi-pencil">
                            </button>
                            <button type="button" class="btn btn-danger delete-btn" data-article_title="<?= $d['title'] ?>" data-article_id="<?= $d['id'] ?>">
                                <span class="iconify" data-icon="mdi-trash">
                            </button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

    <!-- Modal -->
    <form action="" method="post" id="article-delete-form">
        <input type="hidden" name="delete-article-id" value="">
        <div class="modal fade" id="modal-delete-article" tabindex="-1" aria-labelledby="modal-delete-article" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteArticleTitle">Yakin?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin untuk menghapus <b><span name="article-title"></span></b></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Iconify -->
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a74f1ef5b0.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            initDataTable('#article-tbl');

            $('#article-tbl').on('click', '.edit-btn', function() {
                const data = {
                    id: $(this).data('article_id'),
                    script: $(this).data('article_script'),
                }
                $('#article-form input[name="article-id"]').val(data.id);
                $('#article-form input[name="article-script"]').val(data.script);
            });

            $('#article-tbl').on('click', '.delete-btn', function() {
                const data = {
                    title: $(this).data('article_title'),
                    article_id: $(this).data('article_id'),
                }
                console.log(data.title)
                $('#modal-delete-article span[name="article-title"]').text(data.title);
                $('#article-delete-form input[name="delete-article-id"]').val(data.article_id);
                $('#modal-delete-article').modal('show');
            });
        });
    </script>
</body>

</html>