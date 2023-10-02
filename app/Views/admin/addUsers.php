<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="<?= site_url('admin/saveusers') ?>" method="post">
                    <?php csrf_field(); ?>
                    <div class="mb-3 col-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php if(!empty($validation)) echo ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username') ?>" placeholder="Username" autofocus>
                        <div class="invalid-feedback">
                        <?php if(!empty($validation)) echo $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?php if(!empty($validation)) echo ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password') ?>" placeholder="Password">
                        <div class="invalid-feedback">
                        <?php if(!empty($validation)) echo $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>