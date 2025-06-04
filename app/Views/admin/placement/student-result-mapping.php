<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
use App\Models\Job_result_stage_mapping_model;
use App\Models\Placement_job_details_model;
use App\Models\Student_model;

$employee_model = new Employee_model();
$placement_job_result_model = new Placement_job_details_model();
$student_model = new Student_model();
$job_result_stage_mapping_model = new Job_result_stage_mapping_model();
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
            <form action="<?= base_url() ?>admin/student-result-mapping" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="form-group">
                        <span for="title">Job id</span>
                        <select class="form-control form-control-sm my-select" name="job_id" id="job_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($job_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['job_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Job Stage</span>
                        <select class="form-control form-control-sm" name="job_stage" id="job_stage" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Student ID</span>
                        <select class="form-control form-control-sm my-select" name="student_id" id="" required>
                            <option value="">--Select--</option>
                        <?php foreach ($student_details as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name']." (".$value['enrollment_no'].")" ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="title">Result</span>
                        <input type="text" class="form-control form-control-sm" name="result" required>
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
                                <td>Job Stage</td>
                                <td>Student ID</td>
                                <td>Result</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_result_stage_mapping as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $placement_job_result_model->get($value['job_id'])['job_title'] ?? '' ?></td>
                                    <td><?= $job_result_stage_mapping_model->get($value['job_stage'])['result_title'] ?? '' ?></td>
                                    <td><?php $student = $student_model->get($value['student_id']); if($student){ echo $student['first_name']." ".$student['middle_name']." ".$student['last_name']." (".$student['enrollment_no'].")"; } ?></td>
                                    <td><?= $value['result'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-student-result-mapping/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#job_id').on('change', function() {
            var job_id = $(this).val();
            if (job_id) {
                $.ajax({
                    url: '<?= base_url() ?>get-job-restult-stage/' + job_id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('#job_stage').html('<option value="">Select Stage</option>');
                    },
                    success: function(response) {
                        $('#job_stage').empty();
                        if (response.length > 0) {
                            $.each(response, function(index, stage) {
                                $('#job_stage').append('<option value="' + stage.id + '">' + stage.result_title + '</option>');
                            });
                        } else {
                            $('#job_stage').html('<option value="">No stage available</option>');
                        }
                    }
                });
            } else {
                $('#job_stage"]').empty();
            }
        });
    });
</script>
<?= $this->endSection() ?>