<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/job-result-stage-mapping" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Job id</span>
                        <select class="form-control form-control-sm" name="job_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($job_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['job_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Result Title</span>
                        <input type="text" class="form-control form-control-sm" name="result_title" id="job_title" placeholder="Enter Company Name" required>
                    </div>
                    <div class="form-group">
                        <span for="title">Result Description</span>
                        <textarea name="result_description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
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
                                <td>Job id</td>
                                <td>Result Title</td>
                                <td>Result Description</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_result_stage_mapping as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $placement_job_result_model->get($value['job_id'])['job_title'] ?? '' ?></td>
                                    <td><?= $value['result_title'] ?></td>
                                    <td><?= $value['result_description'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-job-result-stage-mapping/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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