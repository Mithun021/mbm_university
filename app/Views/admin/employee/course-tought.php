<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$courses_model = new Courses_model();
$department_model = new Department_model();
?>
<style>
    #addServicetable #coAuthorTbody #coAuthorRow:first-child td:last-child button {
        display: none;
    }
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
                <form method="post" action="<?= base_url('admin/course-tought') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm my-select" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Department:</span>
                            <select name="department_id" id="department_id" class="form-control form-control-sm" required>
                                <option value="">Select Department</option>
                                <?php foreach ($department as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="course_name">Course Name<span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm my-select2" name="course_name[]" id="course_name" multiple required></select>
                        </div>
                        <div class="col-lg-12 form-group">
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
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Department</td>
                                <td>Course Name</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($course_tought as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td><?= $department_model->get($value['department_id'])['name'] ?? '' ?></td>
                                <td><?php $course_id = explode(',',$value['course_name']); 
                                        foreach($course_id as $course){
                                            $course_name = $courses_model->get($course);
                                            echo '<i class="fa fa-angle-right"></i> '.$course_name['course_name'] . " - " . $course_name['course_code'] . "<br>";
                                        }
                                ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script>
    // $(document).ready(function() {
    //     $('#department_id').change(function() {
    //         var department_id = $(this).val();
    //         $.ajax({
    //             url: '<?= base_url('getCourseByDepartment') ?>',
    //             type: 'post',
    //             data: {
    //                 department_id: department_id
    //             },
    //             success: function(response) {
    //                 //console.log(response);
    //                 $('#course_name').empty();
    //                 $('#course_name').append('<option value="" selected default>Select Course</option>');
    //                 $.each(response, function(key, value) {
    //                     $('#course_name').append('<option value="' + value.course_id + '">' + value.course_name + ' - ' + value.course_code + '</option>');
    //                 });
    //             }
    //         });
    //     });
    // });

    $(document).ready(function() {
        // Initialize Select2
        $('.my-select2').select2({
            placeholder: "Select Course",
            allowClear: true
        });

        $('#department_id').change(function() {
            var department_id = $(this).val();
            if(department_id) {
                $.ajax({
                    url: '<?= base_url('getCourseByDepartment') ?>',
                    type: 'POST',
                    data: { department_id: department_id },
                    dataType: 'json',
                    success: function(response) {
                        $('#course_name').empty();
                        $.each(response, function(key, value) {
                            $('#course_name').append('<option value="' + value.course_id + '">' + value.course_name + ' - ' + value.course_code + '</option>');
                        });
                    }
                });
            } else {
                $('#course_name').empty();
            }
        });
    });


</script>

<?= $this->endSection() ?>