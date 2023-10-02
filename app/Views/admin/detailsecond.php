<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
$time = strtotime($date);
?>
<div class="card">
  <h5 class="card-header">Month</h5>
  <div class="card-body">
    <div class="row">
      <?php for($i = 0; $i < 12;$i++) :
        $check = $presence->check(date('Y-m', $time), $username);
        if($check === true) : ?>
      <div class="col-xl-2 col-md-6">
        <div class="card bg-white text-white mb-4">
            <a class="text-dark text-decoration-none" href="<?= site_url('admin/detailuserslast'); ?>/<?= $id ?>/<?= date('Y/m', $time); ?>"><div class="card-body"><?= date('M', $time); ?></div></a>
        </div>
      </div>
      <?php endif;
        $time = strtotime("+1 month " . date('Y-m-d', $time));
        endfor; ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>