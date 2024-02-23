<?php
require_once 'database.php';

// Ambil user_id dan article_id dari parameter URL
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$article_id = isset($_GET['article_id']) ? $_GET['article_id'] : '';

// Jika ada permintaan POST, simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $user_id = $_POST['user_id'];
    $article_id = $_POST['article_id'];
    $content = $_POST['content'];

    // Panggil fungsi saveScript
    saveScript($user_id, $article_id, $content);
    header("Location: admin.php");
    exit;
}

// Pastikan user_id dan article_id memiliki nilai yang valid sebelum memanggil fungsi getScriptfromarticles
if (!empty($user_id) && !empty($article_id)) {
    // Cek apakah ada konten yang tersimpan dari artikel sebelumnya
    $text = getScriptfromarticles($user_id, $article_id);
} else {
    // Tampilkan pesan kesalahan jika user_id atau article_id kosong
    echo "<script>
        alert('User ID or Article ID is empty!');
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Quill -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <link rel="stylesheet" href="css/table_edit.css">

    <form id="saveForm" method="POST" action="admin_article.php">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
        <input type="hidden" name="published" id="publishedInput">
        <input type="hidden" name="content" id="contentInput">
    </form>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div id="toolbar-container">
                    <div id="toolbar-container">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-strike"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-script" value="sub"></button>
                            <button class="ql-script" value="super"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-list" value="ordered"></button>
                            <button class="ql-list" value="bullet"></button>
                            <button class="ql-indent" value="-1"></button>
                            <button class="ql-indent" value="+1"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-direction" value="rtl"></button>
                            <select class="ql-align"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                            <button class="ql-video"></button>
                            <button class="ql-formula"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>

                        <span class="ql-formats">
                            <!-- Tombol "Save" -->
                            <button id="saveButton" class="btn btn-primary">
                                <span class="iconify" data-icon="mdi:content-save" style="color:black;"></span>
                            </button>
                        </span>
                    </div>
                </div>
                <!-- Cek jika ada konten yang tersimpan sebelumnya -->
                <?php if (isset($text)) : ?>
                    <div id="editor">
                        <?php if (isset($text)) : ?>
                            <div id="editor">
                                <?php
                                if (is_array($text)) {
                                    echo implode(" ", $text);
                                } else {
                                    echo $text;
                                }
                                ?>
                            </div>
                        <?php else : ?>
                            <div id="editor"></div>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div id="editor"></div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>

    <script>
        // Initialize Quill editor
        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });

        // Event listener untuk tombol Save
        document.getElementById('saveButton').addEventListener('click', (event) => {
            // Mencegah form dikirimkan secara default
            event.preventDefault();

            // Dapatkan konten dari Quill editor
            let content = quill.root.innerHTML;

            // Set nilai dari input content dengan konten dari Quill editor
            document.getElementById('contentInput').value = content;

            // Kirim form
            document.getElementById('saveForm').submit();
        });
    </script>
</body>

</html>