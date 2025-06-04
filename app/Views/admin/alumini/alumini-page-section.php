<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php

use App\Models\Alumini_page_section_images_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$alumini_page_section_images_model = new Alumini_page_section_images_model();
?>
<style>
    img.section-image {
        margin-bottom: 5px;
        margin-right: 5px;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/alumini-page-section" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Section Title</span>
                        <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Description</span>
                        <textarea name="description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="title">Section priority</span>
                        <input type="number" name="priority" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <span for="title">Section image (Multiple image option )</span>
                        <input type="file" class="form-control form-control-sm" name="file_upload[]" accept=".jpg,.png,.jpeg" multiple required>
                    </div>
                </div>
                <div class="card-footer p-2">
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
                                <td>Priority</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($section as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                    <?php
                                        $section_images = $alumini_page_section_images_model->getBysection($value['id']);
                                        if ($section_images) {
                                            foreach ($section_images as $key => $image) {
                                                if (file_exists("public/admin/uploads/alumini/" . $image['file_upload'])) {
                                                    echo '<img src="' . base_url() . '/public/admin/uploads/alumini/' . $image['file_upload'] . '" width="30" height="30" class="section-image">';
                                                } else {
                                                    echo '<img src="' . base_url() . '/public/admin/uploads/no-image.png" width="50" height="50">';
                                                }
                                            }
                                        }
                                    ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['description'] ?></td>
                                    <td><?= $value['priority'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        if ($emp) {
                                            echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name'];
                                        }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-alumini-page-section/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are uou sure..!')"><i class="far fa-trash-alt"></i></a>
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