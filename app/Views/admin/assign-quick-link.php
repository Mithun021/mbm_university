<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Quick_link_model;

$employee_model = new Employee_model();
$quick_link_model = new Quick_link_model();
$viewsPath = ROOTPATH . 'app/Views/';

$viewFiles = array_map(function ($file) {
    return pathinfo($file, PATHINFO_FILENAME);
}, array_filter(scandir($viewsPath), function ($file) use ($viewsPath) {
    $filePath = $viewsPath . DIRECTORY_SEPARATOR . $file;
    return is_file($filePath) && pathinfo($file, PATHINFO_EXTENSION) === 'php';
}));
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form action="<?= base_url() ?>admin/assign-quick-link" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Select Page<span class="text-danger">*</span></span>
                        <select name="page_pane" id="page_pane" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                            <?php foreach ($viewFiles as $webpage): ?>
                                <option value="<?= $webpage ?>"><?= $webpage ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Quick Link<span class="text-danger">*</span></span>
                        <?php foreach ($quick_link as $value) { ?>
                            <p class="m-0"><input type="checkbox" name="quick_link[]" value="<?= $value['id'] ?>"> <?= $value['title'] ?></->
                            <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Page Name</td>
                                <td>Links</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assign_quick_link as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['page_name'] ?></td>
                                    <td> <?php $quick_link = $quick_link_model->get($value['quick_link_id']); echo '<a href='.$quick_link["page_url"].' target="_blank">'.$quick_link['title'].'</a>' ?? '__'; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>