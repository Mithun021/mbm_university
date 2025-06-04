<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>

<style>
    #dashboard-image{
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>

<!-- start page title -->
<div class="row">
  
    <?= view('admin/layouts/dashboard') ?>

</div>

<?= $this->endSection() ?>