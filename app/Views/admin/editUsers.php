<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="<?= site_url('admin/updateusers') ?>/<?= $users['id']; ?>" method="post">
                    <?php csrf_field(); ?>
                    <div class="mb-3 col-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php if(!empty($validation)) echo ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $users['username']; ?>" placeholder="Username" autofocus>
                        <div class="invalid-feedback">
                        <?php if(!empty($validation)) echo $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Reset Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="user" <?= ($users['type'] == 'user') ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?= ($users['type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>