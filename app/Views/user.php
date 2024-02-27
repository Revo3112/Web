<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between">
        <div>
            <a class="navbar-brand" href="<?= base_url() ?>">Tangerang Times</a>
        </div>
        <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="iconify" data-icon="mdi:account-circle"></span>
                            <?= $username; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                            <span class="iconify" data-icon="mdi:logout"></span> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>List of Articles</h2>
        <a href="<?= base_url('user/new-article'); ?>" class="btn btn-primary">
            <span class="iconify" data-icon="mdi:plus"></span>
            Add Article
        </a>
    </div>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (session()->getFlashdata('failed')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed:</strong> <?= session()->getFlashdata('failed'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <form action="<?= base_url('user/edit-article') ?>" method="post" id="article-form">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="article_id">
            <input type="hidden" name="title">
            <input type="hidden" name="content">
            <input type="hidden" name="category_id">

            <table class="table table-striped" id="article-tbl">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataUser)) : ?>
                        <?php foreach ($dataUser as $i => $d) : ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= $d["title"] ?></td>
                                <td><?= $d['category_name'] ?></td>
                                <td>
                                    <button type="submit" class="btn btn-warning edit-btn" data-article_id="<?= $d['id'] ?>" data-title="<?= $d['title'] ?>" data-content="<?= htmlspecialchars($d['script']) ?>" data-category_id="<?= $d['category_id'] ?>">
                                        <span class="iconify" data-icon="mdi-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete-btn" data-title="<?= $d['title'] ?>" data-article_id="<?= $d['id'] ?>">
                                        <span class="iconify" data-icon="mdi-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<!-- Modal -->
<form action="" method="post" id="article-delete-form">
    <input type="hidden" name="_method" value="DELETE">

    <div class="modal fade" id="modal-delete-article" tabindex="-1" aria-labelledby="modal-delete-article" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteArticleTitle">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete "<span name="article-title"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    $(document).ready(function() {
        $('#article-tbl').on('click', '.edit-btn', function() {
            const data = {
                id: $(this).data('article_id'),
                title: $(this).data('title'),
                content: $(this).data('content'),
                category_id: $(this).data('category_id'),
            }
            $('#article-form input[name="article_id"]').val(data.id);
            $('#article-form input[name="title"]').val(data.title);
            $('#article-form input[name="content"]').val(data.content);
            $('#article-form input[name="category_id"]').val(data.category_id);
            $('#article-form').submit();
        });

        $('#article-tbl').on('click', '.delete-btn', function() {
            const data = {
                title: $(this).data('title'),
                article_id: $(this).data('article_id'),
            }

            var form = $('#article-delete-form');
            var base_url = "<?= base_url("user/delete-article/$user_id/") ?>" + data.article_id;
            form.attr('action', base_url);

            $('#modal-delete-article span[name="article-title"]').text(data.title);
            $('#article-delete-form input[name="delete-article-id"]').val(data.article_id);
            $('#modal-delete-article').modal('show');
        });
    });
</script>

<?= $this->endSection(); ?>