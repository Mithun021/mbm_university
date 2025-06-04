<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Student_model;

$employee_model = new Employee_model();
$student_model = new Student_model();
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
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/mphil-ug-pg-detail') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm my-select" name="employee_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <span for="">Student Title<span class="text-danger">*</span></span>
                            <input type="text" name="student_title" id="" class="form-control form-control-sm" required>
                        </div> -->
                        <div class="form-group col-md-6">
                            <span for="">Name of the Student</span>
                            <select name="student_name" id="" class="form-control form-control-sm my-select" required>
                                <option value="">--Select--</option>
                            <?php foreach ($student as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name'] ?> <?= $value['middle_name'] ?> <?= $value['last_name'] ?> - <?= $value['enrollment_no'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-4">
                            <span for="">Student Category</span>
                            <select name="student_category" id="" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="EWS">EWS</option>
                            </select>
                        </div> -->
                        <div class="form-group col-md-4">
                            <span for="">Name of the Synopsis</span>
                            <input type="text" name="synopsis_name" id="" class="form-control form-control-sm">
                        </div>
                        <!-- <div class="form-group col-md-4">
                            <span for="">Roll No</span>
                            <input type="text" name="roll_no" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Semester</span>
                            <select name="semester" id="" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                                <option value="VII">VII</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                                <option value="X">X</option>
                            </select>
                        </div> -->
                        <div class="form-group col-md-4">
                            <span for="">Remarks</span>
                            <input type="text" name="remarks" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Name of the University</span>
                            <input type="text" name="university_name" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Registration Date</span>
                            <input type="date" name="registration_date" id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Document File(.jpg,.png,.jpeg,.pdf)</span>
                            <input type="file" name="documemt_file" id="" class="form-control form-control-sm" accept=".jpg,.png,.jpeg,.pdf">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">Status </span>
                            <select name="status" id="status" class="form-control form-control-sm" onchange="toggleRegDateField()">
                                <option value="">--Select--</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Awarded">Awarded</option>
                            </select>
                        </div>
                        <div class="form-group submission_date col-md-4" style="display : none;">
                            <span for="">Submission Date</span>
                            <input type="date" name="submission_date" id="" class="form-control form-control-sm">
                        </div>

                        <div class="form-group award_date col-md-4" style="display : none;">
                            <span for="">Award Date</span>
                            <input type="date" name="award_date" id="" class="form-control form-control-sm">
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                <!-- <td>Student Title</td> -->
                                <td>Student Name</td>
                                <!-- <td>Category</td> -->
                                <td>Synopsis</td>
                                <!-- <td>Roll No</td> -->
                                <td>Remarks</td>
                                <td>University Name</td>
                                <td>Reg. Date</td>
                                <td>Status</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($mphil_ug_pg as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['documemt_file']) && file_exists('public/admin/uploads/employee/' . $value['documemt_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['documemt_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                   
                                    <td><?php $student = $student_model->get($value['student_name']); if($student){ echo $student['first_name']." ".$student['middle_name']." ".$student['last_name']." - ".$student['enrollment_no']; }  ?></td>
                                    
                                    <td><?= $value['synopsis_name'] ?></td>
                                    
                                    <td><?= $value['remarks'] ?></td>
                                    <td><?= $value['university_name'] ?></td>
                                    <td><?= $value['registration_date'] ?></td>
                                    <td><?= $value['status'] ?> <?php if($value['submission_date']!=="0000-00-00"){ echo $value['submission_date']; }else{ echo ""; } ?></td>
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

<script>
function toggleRegDateField() {
    const status = document.getElementById('status').value;
    const submissionDate = document.querySelector('.submission_date');
    const awardDate = document.querySelector('.award_date');

    if (status === 'Submitted') {
        submissionDate.style.display = 'block';
        awardDate.style.display = 'none';
    } else if (status === 'Awarded') {
        submissionDate.style.display = 'block';
        awardDate.style.display = 'block';
    } else {
        submissionDate.style.display = 'none';
        awardDate.style.display = 'none';
    }
}

// Optional: Run on page load to handle form repopulation scenarios
document.addEventListener('DOMContentLoaded', toggleRegDateField);
</script>


<?= $this->endSection() ?>