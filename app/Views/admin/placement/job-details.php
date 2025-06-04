<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
use App\Models\Placement_company_detail_model;
$employee_model = new Employee_model();
$placement_company_detail_model = new Placement_company_detail_model();
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
            <form action="<?= base_url() ?>admin/placement-job-details" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Company Name</span>
                            <select class="form-control form-control-sm" name="company_name" required>
                                <option value="">--Select--</option>
                            <?php foreach ($company_details as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['company_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Job Title</span>
                            <input type="text" class="form-control form-control-sm" name="job_title" id="job_title" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <span for="title">Job Description</span>
                            <textarea name="job_description" id="editor" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <span for="title">Number of positions</span>
                            <input type="text" name="no_of_position" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Minimum Salary</span>
                            <input type="number" name="minimum_salary" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Maximum Salary</span>
                            <input type="number" name="maximun_salary" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Hiring Date and time</span>
                            <input type="datetime-local" name="hiring_date_time" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Venue</span>
                            <input type="text" name="venue" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Meeting link</span>
                            <input type="url" name="meeting_link" class="form-control form-control-sm" required>
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
                                <td>Company Name</td>
                                <td>Job Title</td>
                                <td>Job Description</td>
                                <td>Number of positions</td>
                                <td>Minimum Salary</td>
                                <td>Maximum Salary</td>
                                <td>Hiring Date and time</td>
                                <td>Venue</td>
                                <td>Meeting link</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_details as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $placement_company_detail_model->get($value['company_name'])['company_name'] ?? '' ?></td>
                                    <td><?= $value['job_title'] ?></td>
                                    <td><?= $value['job_description'] ?></td>
                                    <td><?= $value['no_of_position'] ?></td>
                                    <td><?= $value['minimum_salary'] ?></td>
                                    <td><?= $value['maximun_salary'] ?></td>
                                    <td><?= $value['hiring_date_time'] ?></td>
                                    <td><?= $value['venue'] ?></td>
                                    <td><?= $value['meeting_link'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-placement-job-details/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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