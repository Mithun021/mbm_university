<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Job_detail_model;

$job_detail_model = new Job_detail_model();
$employee_model = new Employee_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/job-extension" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <span for="">Job id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="job_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($job_details as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Extension notice title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="ext_notice_title">
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Extension notice file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                            <input type="file" class="form-control form-control-sm" name="ext_notice_file" accept=".jpg, .png, .pdf" required>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised application last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised hardcopy last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Job id</td>
                                <td>Revised application last datetime</td>
                                <td>Revised hardcopy last datetime</td>
                                <td>Notice Title</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_extension as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['ext_notice_file']) && file_exists('public/admin/uploads/jobs/' . $value['ext_notice_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $value['ext_notice_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $job_detail_model->get($value['job_id'])['title'] ?? '' ?></td>
                                    <td><?= date("d:M:Y", strtotime($value['revised_app_last_date'])) ?> <?= date("h:i A", strtotime($value['revised_app_last_time'])) ?> </td>
                                    <td><?= date("d:M:Y", strtotime($value['revised_copy_last_date'])) ?> <?= date("h:i A", strtotime($value['revised_copy_last_time'])) ?></td>
                                    <td><?= $value['ext_notice_title'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
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