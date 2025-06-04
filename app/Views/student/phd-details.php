<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/phd-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Phd Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="phd_title" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Description<span class="text-danger">*</span></span>
                                <textarea class="form-control form-control-sm" name="description" id="editor"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="relegion">Supervisor Name :<span class="text-danger">*</span></span>
                                <select name="supervisor_name" id="supervisor_name" class="form-control form-control-sm" required>
                                    <option value="">Select Supervisor</option>
                                <?php foreach ($employeeData as $emp): ?>
                                    <option value="<?= $emp['id'] ?>"><?= $emp['sir_name']." ".$emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Current Status <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="current_status" id="current_status" required>
                                    <option value="">Select Degree Type</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Submitted">Submitted</option>
                                    <option value="Awarded">Awarded</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Date of Registration<span class="text-danger">*</span></span>
                                <input type="date" class="form-control form-control-sm" name="registration_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-4" id="submission_date_div" style="display: none;">
                            <div class="form-group">
                                <span>Date of Submission<span class="text-danger">*</span></span>
                                <input type="date" class="form-control form-control-sm" name="submission_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-4" id="award_date_div" style="display: none;">
                            <div class="form-group">
                                <span>Date of Award <span class="text-danger">*</span></span>
                                <input type="date" class="form-control form-control-sm" name="award_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-1">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="datatable-buttons">
                        <thead>
                            <tr>
                                <td>Phd Title</td>
                                <td>Description</td>
                                <td>Supervisor Name</td>
                                <td>Current Status</td>
                                <td>Date of Registration</td>
                                <td>Date of Submission</td>
                                <td>Date of Award</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($studentData as $phd): ?>
                            <tr>
                                <td><?= $phd['phd_title'] ?></td>
                                <td><?= $phd['description'] ?></td>
                                <td><?php $emp = $employee_model->get($phd['supervisor_name']);
                                        if($emp) { echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                <td><?= $phd['current_status'] ?></td>
                                <td><?= $phd['registration_date'] ?></td>
                                <td><?= $phd['submission_date'] ?></td>
                                <td><?= $phd['award_date'] ?></td>
                                <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $phd['file_upload'] ?>" target="_blank">View File</a></td>
                                <td><a href="<?= base_url() ?>student/delete-phd-details/<?= $phd['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
document.getElementById('current_status').addEventListener('change', function() {
    var status = this.value;
    var submissionDiv = document.getElementById('submission_date_div');
    var awardDiv = document.getElementById('award_date_div');

    // Hide all by default
    submissionDiv.style.display = 'none';
    awardDiv.style.display = 'none';

    if (status === 'Submitted') {
        submissionDiv.style.display = 'block';
    } else if (status === 'Awarded') {
        // submissionDiv.style.display = 'none';
        awardDiv.style.display = 'block';
    }
});
</script>


<?= $this->endSection() ?>