<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Department_photos_file_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$department_photos_file_model = new Department_photos_file_model();
$department_model = new Department_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form  action="<?= base_url() ?>admin/departments-photos" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Select Department<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="dept_id">
                        <?php foreach($department as $value){ ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,JPEG)</span>
                        <input type="file" class="form-control form-control-sm" name="album_file[]" accept=".jpg, .png, .jpeg" required multiple>
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
                            <td>Department</td>
                            <td>Files</td>
                            <td>Upload by</td>
                            <td>Created at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($albums as $key => $value){ ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?php $department = $department_model->get($value['dept_id']); echo $department['name']; ?></td>
                            <td>
                                <?php
                                    $albums = $department_photos_file_model->getByAlbumId($value['id']);
                                    foreach ($albums as $key => $files) {
                                        if($value['id'] == $files['dept_photos_id']){
                                ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/department/<?= $files['file_name'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/department/<?= $files['file_name'] ?>" alt="Department Photos" height="40px"></a>
                                <?php
                                        }
                                    }
                                ?>
                            </td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= $value['created_at'] ?></td>
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