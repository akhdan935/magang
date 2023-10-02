<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('warning'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('warning-array') !== null) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php foreach(session()->getFlashdata('warning-array') as $warning) : ?>
        <?= $warning; ?>.<br>
        <?php endforeach; ?>
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
            <?php if(session()->get('type_account') == 'user') : ?>
                <?php if($dateFolder == date('Y/m/d')) : ?>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addRecord">
                    Add Record
                    </button>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <hr>
        <div class="row">
            <?php foreach($presences as $presence) : ?>
            <div class="col-xl-3 col-md-6 mr-5 mb-5">
                <div class="card" style="max-width: 100%;">
                    <img src="<?= base_url('img/presence') ?>/<?= $presence['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= explode("_", $presence['image_slug'])[1] . " | " . explode("_", $presence['image_slug'])[0] ?></h5>
                        <p class="card-text"><?= $presence['created_at'] ?></p>
                        <?php if($presence['username'] == session()->get('username_account') || session()->get('username_account') == 'admin') : ?>
                        <form action="<?= site_url('user/deleterecord'); ?>/<?= $presence['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="date" value="<?= $dateFolder; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="row">
            <div class="">
                <?= $pager->links('record', 'my_pager'); ?>
            </div>
        </div>
    </div>
</div>
<?php if($dateFolder == date('Y/m/d')) : ?>
<div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addRecordLabel">Add Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= site_url('user/addrecord'); ?>/<?= $dateFolder ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="mb-3">
                <label for="image" class="form-label">Image for presence</label>
                <input class="form-control" type="file" id="image" name="image">
                <label for="type" class="form-label">Type of presence</label>
                <select class="form-select" id="type" name="type">
                    <option value="depart">Depart</option>
                    <option value="return">Return</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?= $this->endSection(); ?>