<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('css/article.css') ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-4 d-flex justify-content-between">
    <div>
        <?php if (session()->get('role') == 'Admin') : ?>
            <a class="navbar-brand" href="<?= base_url('admin') ?>">
                <span class="iconify" data-icon="mdi-arrow-back"></span>
                Back to my articles
            </a>
        <?php else : ?>
            <a class="navbar-brand" href="<?= base_url('user') ?>">
                <span class="iconify" data-icon="mdi-arrow-back"></span>
                Back to my articles
            </a>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="mr-3">
        <form action="<?= base_url('user/save-article'); ?>" method="post" id="article-form" class="form-inline my-2 my-lg-0">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="article_id" value="<?= $article_id ?? "" ?>">
            <input type="hidden" name="title">
            <input type="hidden" name="content">
            <input type="hidden" name="category_id">

            <div class="form-group" style="display: inline-block;">
                <select class="form-control" name="category_id" id="article_category">
                    <option value="">Pilih Kategori</option>

                    <?php foreach ($categories as $cat) : ?>
                        <?php if (isset($category_id) && ($category_id == $cat['id'])) : ?>
                            <option value="<?= $cat['id'] ?>" selected><?= $cat['category_name']; ?></option>
                        <?php else : ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['category_name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success ml-lg-2" id="save-btn">
                <span class="iconify" data-icon="mdi:content-save" style="color:white;"></span>
                Save
            </button>
        </form>
    </div>
</nav>

<script>
    function selectOption(element) {
        var selectedOptionInput = document.getElementById("selectedOption");
        selectedOptionInput.value = element.textContent;
        var dropdownToggle = document.getElementById("dropdownMenuButton");
        dropdownToggle.textContent = element.textContent;
    }
</script>

<div id="toolbar-container" style="border: none;">
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

    <input type="text" name="title" id="article-title" class="ql-formats mt-4 ml-2 p-2 border-0" placeholder="Enter article title" value="<?= $title ?? "" ?>">

    <div id="editor" style="border: none;">
        <?= $content ?? ""; ?>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

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
        // Article title
        article_title = document.querySelector('#article-title');
        title = document.querySelector('#article-form input[name="title"]');
        title.value = article_title.value;

        // Article content
        content = document.querySelector('#article-form input[name="content"]');
        quillEditor = document.querySelector('#editor');
        content.value = quillEditor.children[0].innerHTML;

        // Article category
        article_category = document.querySelector('#article_category');
        category_id = document.querySelectory('#article-form input[name="category_id"]');
        category_id.value = article_category.value;
    });
</script>

</script>

<?= $this->endSection(); ?>