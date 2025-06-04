<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Employee_model;
use App\Models\Program_model;
use App\Models\Student_achievement_mapping_model;

$department_model = new Department_model();
$program_model = new Program_model();
$employee_model = new Employee_model();
$student_achievement_mapping_model = new Student_achievement_mapping_model();
?>
<style>
    #addServicetable #memberTbody #memberTrow:first-child td:last-child button {
        display: none;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Student Achievements </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/student-achievements') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Upload File(JPG,PNG)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png" required>
                        </div>

                        <div class="form-group col-md-12">
                            <span for="">Desription</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td>Student Name</td>
                                            <td>Department</td>
                                            <td>Course Details</td>
                                            <td>Superviser</td>
                                            <td><button type="button" class="btn btn-sm btn-primary" id="addnewMemberRow">+</button></td>
                                        </tr>
                                    </thead>
                                    <tbody id="memberTbody">
                                        <tr id="memberTrow">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="student_name[]" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="department[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($department as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="course[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($program as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="supervisor[]" required>
                                                        <option value="">--Select--</option>
                                                        <?php foreach ($employee as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>.
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-sm btn-danger" id="removenewMemberRow">-</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <span for="">Awards Date</span>
                            <input type="date" class="form-control form-control-sm" name="awards_date">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Awarding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="agency_name">
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
                <h4 class="card-title m-0">Student Achievements List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Files</td>
                                <td>Title</td>
                                <td>Student Name(Department/Course) : Supervisor</td>
                                <td>Award Date</td>
                                <td>Agency Name</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($student_acchievement as $key => $value) { ?>
                        <?php $mapping_data = $student_achievement_mapping_model->get_by_student_achiv_id($value['id']); ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/achievements/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/achievements/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/achievements/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/achievements/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td>
                                <?php if (!empty($mapping_data)){ ?>
                                    <ul style="padding: 10px; margin : 0;">
                                    <?php foreach ($mapping_data as $key => $value2) { ?>
                                        <li>
                                            <?= $value2['student_name'] ?>
                                            (
                                                <?= $department_model->get($value2['department_id'])['name'] ?? '' ?> / 
                                                <?= $program_model->get($value2['course_id'])['name'] ?? '' ?>

                                            ) :
                                            <?php
                                                $supervisor = $employee_model->get($value2['supervisor_id']);

                                                if ($supervisor) {
                                                    echo $supervisor['first_name'] . " " . $supervisor['middle_name'] . " " . $supervisor['last_name'];
                                                } else {
                                                    echo "Supervisor not found"; // or handle the error in a different way
                                                }
                                            ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                                </td>
                                <td><?= $value['award_date'] ?></td>
                                <td><?= $value['agency_name'] ?></td>
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
<script>
    $(document).ready(function() {
        // Create Service Clone for add and remove rows also calculate price
        var cloneLimit = 10;
        var currentClones = 0;
        $("#addnewMemberRow").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#memberTrow').clone().appendTo('#memberTbody');
                $(cloneCatrow).find('input').val('');
            }

        });

        $('#memberTbody').on('click', '#removenewMemberRow', function() {
            $(this).closest('tr').remove();
        });

    });
</script>

<?= $this->endSection() ?>