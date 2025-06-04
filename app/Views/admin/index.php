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
    <div class="col-lg-12">
        <div class="card card-body">
            <img src="<?= base_url() ?>public/admin/assets/images/niperclg.jpg" alt="" id="dashboard-image">
        </div>
    </div>
</div>

<?= $this->endSection() ?>