<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card">
  <div class="card-body">
    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-header">
            Information
          </div>
          <div class="card-body">
            <h5 class="card-title">Username : <?= $user['username']; ?></h5>
            <p class="card-text">Type : <?= $user['type'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Attendance</h5>
            <p class="card-text"><?= $presence; ?> Days.</p>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Absent
            <a href="<?= site_url('admin/absent'); ?>/<?= $id; ?>" class="btn btn-primary float-end">Check Absent</a>
            </h5>
            <p class="card-text"><?= $days; ?> Days.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>