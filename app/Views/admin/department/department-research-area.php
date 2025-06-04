<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$department_model = new Department_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/department-research-area" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Department Id</span>
                        <select name="department_id" class="form-control form-control-sm">
                            <option value="">--Select--</option>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Research area title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title" required minlength="5">
                    </div>
                    <div class="form-group">
                        <span for="">Research area short desc</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Research area file upload (pdf)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_file">
                    </div>
                    <div class="form-group">
                        <span for="">Research area image upload (jpegjpgpng)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_image">
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
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
                            <td>Files</td>
                            <td>Dept Name</td>
                            <td>Title</td>
                            <td>Desc</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($department_research_area as $key => $value) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/department/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/department/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/department/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                <?php if (!empty($value['upload_image']) && file_exists('public/admin/uploads/department/' . $value['upload_image'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/department/<?= $value['upload_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/department/<?= $value['upload_image'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/department/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $department_model->get($value['department_id'])['name'] ?? '' ?></td>
                            <td><?= $value['title'] ?></td>
                            <td><?= $value['description'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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