<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
$time = strtotime($date);
?>
<div class="card mb-3">
  <h5 class="card-header">Year</h5>
  <div class="card-body">
    <div class="row">
      <?php for($i = 0; $i < 5;$i++) :
        $check = $presence->check(date('Y', $time), $username);
        if($check === true) : ?>
      <div class="col-xl-2 col-md-6">
        <div class="card bg-white text-white mb-4">
            <a class="text-dark text-decoration-none" href="<?= site_url('admin/detailuserssecond'); ?>/<?= $id ?>/<?= date('Y', $time); ?>"><div class="card-body"><?= date('Y', $time); ?></div></a>
        </div>
      </div>
      <?php endif;
        $time = strtotime("+1 year " . date('Y-m-d', $time));
        endfor; ?>
    </div>
  </div>
</div>
<a href="<?= site_url('admin/absent'); ?>/<?= $id; ?>" class="btn btn-primary">Check Absent</a>
<?= $this->endSection(); ?>