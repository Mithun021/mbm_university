<?= $this->extend("student/stdlayouts/master") ?>

<?=  $this->section("student-content"); ?>

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
            <h1>Welcome to NIPER Student Portal</h1>
        </div>
    </div>
</div>

<?= $this->endSection() ?>