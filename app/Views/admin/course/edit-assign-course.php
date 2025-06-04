<!-- app/Views/progdeptstudentmap_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Employee_model;
use App\Models\Program_model;

$employee_model = new Employee_model();
$courses_model = new Courses_model();
$department_model = new Department_model();
$program_model = new Program_model();
?>

<style>
    .student-details {
        position: relative;
    }

    .student-details span {
        float: left;
        width: 32%;
        margin-bottom: 10px;
    }
</style>

<div class="row">
    <!-- Form Section for Adding  -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/edit-assign-course/<?= $assign_course_id ?>" method="post">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span for="Deptid">Department ID:</span>
                                <select name="Deptid" id="Deptid" class="form-control form-control-sm" required>
                                    <option value="">Select Deparrtment</option>
                                    <?php foreach ($department as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($value['id'] == $edit_assign_courses['dept_id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Program ID -->
                            <div class="form-group">
                                <span for="Progid">Program ID:</span>
                                <select name="Progid" id="Progid" class="form-control form-control-sm" required>
                                    <option value="">Select Program</option>
                                    <?php foreach ($program as $key => $value) { ?>
                                        <option value="<?= $value['program_id'] ?>" <?php if($value['program_id'] == $edit_assign_courses['program_id']) { echo "selected"; } ?>><?= $value['program_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Semester -->
                            <div class="form-group">
                                <span for="semester">Semester:</span>
                                <select name="semester" id="semester" class="form-control form-control-sm" required>
                                    <option value="I" <?php if($edit_assign_courses['semester'] == "I") { echo "selected"; } ?>>I</option>
                                    <option value="II" <?php if($edit_assign_courses['semester'] == "II") { echo "selected"; } ?>>II</option>
                                    <option value="III" <?php if($edit_assign_courses['semester'] == "III") { echo "selected"; } ?>>III</option>
                                    <option value="IV" <?php if($edit_assign_courses['semester'] == "IV") { echo "selected"; } ?>>IV</option>
                                    <option value="V" <?php if($edit_assign_courses['semester'] == "V") { echo "selected"; } ?>>V</option>
                                    <option value="VI" <?php if($edit_assign_courses['semester'] == "VI") { echo "selected"; } ?>>VI</option>
                                    <option value="VII" <?php if($edit_assign_courses['semester'] == "VII") { echo "selected"; } ?>>IVI</option>
                                    <option value="VIII" <?php if($edit_assign_courses['semester'] == "VIII") { echo "selected"; } ?>>VIII</option>
                                    <option value="IX" <?php if($edit_assign_courses['semester'] == "IX") { echo "selected"; } ?>>IX</option>
                                    <option value="X" <?php if($edit_assign_courses['semester'] == "X") { echo "selected"; } ?>>X</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Select Course</span>
                                <select name="course_id" id="course_id" class="form-control form-control-sm" required>
                                    <option value="">Select Course</option>
                                    <?php foreach ($courses as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($value['id'] == $edit_assign_courses['course_id']) { echo "selected"; } ?>><?= $value['course_name'] ?> - <?= $value['course_code'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Credit Score</span>
                                <input type="text" name="credit_score" id="credit_score" class="form-control form-control-sm" value="<?= $edit_assign_courses['credits'] ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Mappings (Optional) -->
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
                                <td>Department</td>
                                <td>Program</td>
                                <td>Semester</td>
                                <td>Course</td>
                                <td>Credits</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assign_courses as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $department_model->get($value['dept_id'])['name'] ?? '__' ?></td>
                                    <td><?php $program = $program_model->getProgramWithBatch($value['program_id']);
                                        echo $program['program_name'] . ' - ' . $program['batch_start'] . ' - ' . $program['batch_end'] ?? '__'; ?></td>
                                    <td><?= $value['semester'] ?></td>
                                    <td><?php $course = $courses_model->get($value['course_id']);
                                        echo $course['course_name'] ?? '__';
                                        echo " - " . $course['course_code'] ?? '__' ?></td>
                                    <td><?= $value['credits'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/edit-assign-course/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/delete-assign-course/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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
        
        // Fetch Programs based on Department
        $('#Deptid').change(function() {
            var dept_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>fetch-programs',
                type: 'post',
                data: {
                    dept_id: dept_id
                },
                success: function(response) {
                    // console.log(response);
                    let dataList = $('#Progid');
                    dataList.empty();
                    dataList.append('<option value="">Select Program</option>');
                    $.each(response, function(index, item) {
                        dataList.append('<option value="' + item.program_id + '">' + item.program_name + "(" + item.batch_start + "-" + item.batch_end + ")" + '</option>');
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>