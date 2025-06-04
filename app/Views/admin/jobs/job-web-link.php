<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/job-web-link') ?>">
                    <div class="form-group">
                        <span for="">Job id<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="job_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($job_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Link Description<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="link_description" required>
                    </div>
                    <div class="form-group">
                        <span for="">Job URL Link<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="job_link" required>
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
                            <td>Event Name</td>
                            <td>Event Description</td>
                            <td>Upload By</td>
                            <td>Upload Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($job_weblink as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $job_detail_model->get($value['job_id'])['title'] ?? '' ?></td>
                            <td><a href="<?= $value['job_url'] ?>" target="_blank"><?= $value['link_description'] ?></a></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/event-category/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('admin/event-category/'.$value['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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