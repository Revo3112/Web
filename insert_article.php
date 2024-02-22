<?php
include 'database.php';

if (isset($_POST["article-save"])) {

    $user_id = isset($_POST["user-id"]) ? $_POST["user-id"] : "";    
    $query = "INSERT INTO articles(user_id, category_id, published, script, title) VALUES('$user_id', '1', CURRENT_TIMESTAMP, '$articleSave', 'TITLE!');";

    insertUserArticle($query, $user_id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
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

    <!-- S: Nilainya disimpen tag input soalnya kalo ada request POST lagi, nilai sebelumnya ilang -->
    <input type="hidden" id="user_id" name="user-id" value="<?= $_POST['user-id']?>">

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
        <!-- ... -->
        <form action="" method="post" id="article-form" class="ql-formats">
            <span class="ql-formats">
                <input type="hidden" name="user-id">
                <input type="hidden" name="article-save">
                <button type="submit" class="btn btn-primary" id="save-btn">
                    <span class="iconify" data-icon="mdi:content-save" style="color:black;"></span>
                </button>
            </span>
        </form>
    </div>

    <!-- QUILL Recent changes -->
    <div id="editor">
    </div>

    <button type="button" id="myBtn">Console</button>

    <!-- Iconify -->
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Initialize Quill editor
        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Write your article here...',
            theme: 'snow',
        });

        
        document.querySelector('#save-btn').addEventListener('click', () => {
            let quillEditor = document.getElementById("editor");
            var userId = document.getElementById("user_id").value

            document.querySelector('#article-form input[name="user-id"]').value = userId
            document.querySelector('#article-form input[name="article-save"]').value = quillEditor.children[0].innerHTML;
        });

        document.querySelector('#myBtn').addEventListener('click', () => {
            let quillEditor = document.getElementById("editor");
            
            console.log(quillEditor.children[0].innerHTML);
        })
    </script>
</body>

</html>