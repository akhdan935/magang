<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if((!empty($validation)) ? $validation->hasError('date') : false) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $validation->getError('date'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search something here..." name="keyword" value="<?= $keyword; ?>">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" name="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addFolder">
                Add Folder
                </button>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php foreach($folders as $folder) : ?>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-white text-white mb-4">
                    <a class="text-dark text-decoration-none" href="<?= site_url('user/record'); ?>/<?= $folder['segment']; ?>"><div class="card-body"><?= $folder['name'] ?></div></a>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div></div>
                        <form action="<?= site_url('user/deletefolder'); ?>/<?= $folder['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="row">
            <div class="">
                <?= $pager->links('folder', 'my_pager'); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addFolder" tabindex="-1" aria-labelledby="addFolderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addFolderLabel">Add Folder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= site_url('user/addfolder'); ?>" method="post">
      <?= csrf_field(); ?>
      <div class="modal-body">
            <input class="form-control" type="date" name="date">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>