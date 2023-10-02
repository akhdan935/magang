<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('warning'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <div class="mb-3 col-6">
                        <label for="explanation" class="form-label">Explanation</label>
                        <textarea class="form-control <?= (!empty($explanation)) ? 'is-invalid' : '' ?>" name="explanation" id="explanation" rows="5" autofocus><?= old('explanation') ?></textarea>
                        <div class="invalid-feedback">
                        <?= (!empty($explanation)) ? $explanation : '' ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="image" class="form-label">Image for absent</label>
                        <input class="form-control <?= (!empty($image)) ? 'is-invalid' : '' ?>" type="file" id="image" name="image">
                        <div class="invalid-feedback">
                        <?= (!empty($image)) ? $image : '' ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="from" class="form-label">From</label>
                        <input class="form-control <?= (!empty($from)) ? 'is-invalid' : '' ?>" type="date" name="from" id="from">
                        <div class="invalid-feedback">
                        <?= (!empty($from)) ? $from : '' ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="to" class="form-label">To</label>
                        <input class="form-control <?= (!empty($to)) ? 'is-invalid' : '' ?>" type="date" name="to" id="to">
                        <div class="invalid-feedback">
                        <?= (!empty($to)) ? $to : '' ?>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="sick">Sick</option>
                            <option value="permit">Permit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>