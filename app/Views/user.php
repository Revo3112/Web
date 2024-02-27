<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<button type="submit" class="btn btn-primary" onclick="window.location.href = '<?= base_url('user/new-article'); ?>'">
    <span class="iconify" data-icon="mdi-plus"></span>
    Tambah Article
</button>

<button type="submit" class="btn btn-primary" onclick="window.location.href = '<?= base_url('auth/logout'); ?>'"></button>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <strong>Success</strong> | <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>Failed</strong> | <?= session()->getFlashdata('failed'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form id="article-form" action="<?= base_url('user/edit-article') ?>" method="post">
    <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
    <input type="hidden" name="article_id">
    <input type="hidden" name="title">
    <input type="hidden" name="content">

    <table id="article-tbl">
        <thead>
            <th>No.</th>
            <th>Title</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php foreach ($dataUser as $d) : ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= $d["title"] ?></td>
                    <td>
                        <button type="submit" class="btn btn-warning edit-btn" data-article_id="<?= $d['id'] ?>" data-title="<?= $d['title'] ?>" data-content="<?= htmlspecialchars($d['script']) ?>">
                            <span class="iconify" data-icon="mdi-pencil">
                        </button>
                        <button type="button" class="btn btn-danger delete-btn" data-title="<?= $d['title'] ?>" data-article_id="<?= $d['id'] ?>">
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
    <input type="hidden" name="_method" value="DELETE">

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

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    $(document).ready(function() {
        initDataTable('#article-tbl');

        $('#article-tbl').on('click', '.edit-btn', function() {
            const data = {
                id: $(this).data('article_id'),
                title: $(this).data('title'),
                content: $(this).data('content'),
            }
            $('#article-form input[name="article_id"]').val(data.id);
            $('#article-form input[name="title"]').val(data.title);
            $('#article-form input[name="content"]').val(data.content);
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