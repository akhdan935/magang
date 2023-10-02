<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search something here..." name="keyword">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" name="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php foreach($absents as $absent) : ?>
            <?php $slug = explode("_", $absent['slug']) ?>
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card" style="max-width: 100%;">
                    <img src="<?= base_url('img/absent'); ?>/<?= $absent['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $absent['username']; ?></h5>
                        <p class="card-text">Reason : <?= $slug[0]; ?></p>
                        <p class="card-text">From <?= $slug[1]; ?> <?= $slug[2]; ?> <?= $slug[3]; ?></p>
                        <p class="card-text">Total : <?= $absent['days']; ?> Days.</p>
                        <hr>
                        <h5 class="card-title">Explanation</h5>
                        <p class="card-text"><?= $absent['explanation']; ?></p>
                        <hr>
                        <form action="<?= site_url('admin/deleteabsent'); ?>/<?= $absent['id']; ?>/<?= $id2; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger float-end" onclick="return confirm('Are you sure to delete?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="">
                <?= $pager->links('absent', 'my_pager'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>