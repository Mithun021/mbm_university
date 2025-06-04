<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-md-4 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/alumini-page-notification" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Title</span>
                        <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Description</span>
                        <textarea name="description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="title">File Upload(.pdf)</span>
                        <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="title"><input type="checkbox" name="marquee" value="1"> Marquee Status</span>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-1">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Marquee</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notification as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/alumini/' . $value['file_upload'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/alumini/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/alumini/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['description'] ?></td>
                                    <td><?= ($value['marquee'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($value['marquee'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        if ($emp) {
                                            echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name'];
                                        }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-alumini-page-notification/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are uou sure..!')"><i class="far fa-trash-alt"></i></a>
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