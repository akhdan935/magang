<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
    </div>
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
            <div class="col">
                <a href="<?= site_url('admin/addusers') ?>" class="btn btn-primary mb-4 float-end">Add Users</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach($users as $user) :?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['type']; ?></td>
                        <td>
                            <form action="<?= site_url('admin/deleteusers'); ?>/<?= $user['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</button>
                            </form>
                            <a href="<?= site_url('admin/editusers'); ?>/<?= $user['id']; ?>" class="btn btn-warning">Edit</a>
                            <?php if($user['type'] == 'user') :?>
                            <a href="<?= site_url('admin/detailusersfirst'); ?>/<?= $user['id']; ?>" class="btn btn-success">Detail</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="">
                <?= $pager->links('users', 'my_pager'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>