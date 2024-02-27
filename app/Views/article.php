<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('css/article.css') ?>">

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
    <form action="<?= base_url('user/save-article'); ?>" method="post" id="article-form" class="ql-formats">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="article_id" value="<?= $article_id ?? "" ?>">
        <input type="hidden" name="title">
        <input type="hidden" name="content">

        <button type="submit" class="btn btn-primary" id="save-btn">
            <span class="iconify" data-icon="mdi:content-save" style="color:black;"></span>
        </button>
    </form>
    <input type="text" name="title" id="article-title" class="ql-formats mt-4 p-2 border-0" placeholder="Enter article title" value="<?= $title ?? "" ?>">
</div>

<div id="editor">
    <?= $title ?? ""; ?>
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
    });
</script>

<?= $this->endSection(); ?>