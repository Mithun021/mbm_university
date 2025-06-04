<!-- app/Views/empawarddetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>
    #clone_content #clone_employee_data:first-child button#remove-clone {
        display: none;
    }
</style>

<div class="row">
    <!-- Form Section for Adding  Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Edit <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/edit-employee-awards/<?= $emp_awards_id ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $awards_detail['employee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Award Title -->
                                    <div class="form-group">
                                        <span for="Awardtitle">Name of Awarding:</span>
                                        <input type="text" name="Awardtitle" id="" class="form-control form-control-sm" value="<?= $awards_detail['name_of_awarding'] ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Reason of Awarding<span class="text-danger">*</span></span>
                                    <select class="form-control form-control-sm" name="award_reason" required>
                                        <option value="">--Select--</option>
                                        <option value="Academic" <?php if($awards_detail['award_reason'] == "Academic"){ echo "selected"; } ?>>Academic</option>
                                        <option value="Research" <?php if($awards_detail['award_reason'] == "Research"){ echo "selected"; } ?>>Research</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Date of Awarding<span class="text-danger">*</span></span>
                                    <input type="date" name="date_of_awarding" id="" class="form-control form-control-sm" value="<?= $awards_detail['date_of_awarding'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Body name of Awarding<span class="text-danger">*</span></span>
                                    <input type="text" name="body_name_of_awarding" id="" class="form-control form-control-sm" value="<?= $awards_detail['body_name_of_awarding'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Level<span class="text-danger">*</span></span>
                                    <select class="form-control form-control-sm" name="level" required>
                                        <option value="">--Select--</option>
                                        <option value="National" <?php if($awards_detail['level'] == "National"){ echo "selected"; } ?>>National</option>
                                        <option value="International" <?php if($awards_detail['level'] == "International"){ echo "selected"; } ?>>International</option>
                                        <option value="University" <?php if($awards_detail['level'] == "University"){ echo "selected"; } ?>>University</option>
                                        <option value="Industry" <?php if($awards_detail['level'] == "Industry"){ echo "selected"; } ?>>Industry</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Award Photo Upload -->
                                    <div class="form-group">
                                        <span for="Awardphotoupload">Document Upload(.pdf,.jpg,.jpeg,.png):</span>
                                        <input type="file" name="Awardphotoupload" id="Awardphotoupload" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                                        <?php if (!empty($awards_detail['document_file']) && file_exists('public/admin/uploads/employee/' . $awards_detail['document_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $awards_detail['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>

    <!-- Table Section to Display Existing Awards (Optional) -->
    <div class="col-lg-12">
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
                                <td>File</td>
                                <td>Emp. ID</td>
                                <td>Reason of Award</td>
                                <td>Name of Award</td>
                                <td>Award Date</td>
                                <td>Body name of Award</td>
                                <td>Level</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($awards as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['document_file']) && file_exists('public/admin/uploads/employee/' . $value['document_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['award_reason'] ?></td>
                                    <td><?= $value['name_of_awarding'] ?></td>
                                    <td><?= $value['date_of_awarding'] ?></td>
                                    <td><?= $value['body_name_of_awarding'] ?></td>
                                    <td><?= $value['level'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-awards/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-awards/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?= $this->endSection() ?>