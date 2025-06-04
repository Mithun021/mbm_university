<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
use App\Models\Placement_job_details_model;
$employee_model = new Employee_model();
$placement_job_result_model = new Placement_job_details_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/result-details" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Job id</span>
                            <select class="form-control form-control-sm" name="job_id" required>
                                <option value="">--Select--</option>
                            <?php foreach ($job_details as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['job_title'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Result Title</span>
                            <input type="text" class="form-control form-control-sm" name="result_title" id="job_title" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <span for="title">Result Description</span>
                            <textarea name="result_description" id="editor" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Result File(.pdf)</span>
                            <input type="file" name="result_file" class="form-control form-control-sm" accept=".pdf" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Result Notification Date</span>
                            <input type="date" name="notification_date" class="form-control form-control-sm" required>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Job id</td>
                                <td>Result Title</td>
                                <td>Result Description</td>
                                <td>Notification Date</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result_details as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['result_file']) && file_exists('public/admin/uploads/placement/' . $value['result_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/placement/<?= $value['result_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/placement/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $placement_job_result_model->get($value['job_id'])['job_title'] ?? '' ?></td>
                                    <td><?= $value['result_title'] ?></td>
                                    <td><?= $value['result_description'] ?></td>
                                    <td><?= $value['notification_date'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-result-details/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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