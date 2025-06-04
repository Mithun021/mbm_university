<!-- app/Views/progdeptstudentmap_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
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
                <form action="<?= base_url() ?>admin/program-dept-std-mapping" method="post">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span for="Deptid">Department ID:</span>
                                <select name="Deptid" id="Deptid" class="form-control form-control-sm" required>
                                    <option value="">Select Deparrtment</option>
                                    <?php foreach ($department as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
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
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Semester -->
                            <div class="form-group">
                                <span for="semester">Semester:</span>
                                <select name="semester" id="semester" class="form-control form-control-sm" required>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">IVI</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h3 class="mb-2">Student Details:</h3>
                                <div class="student-details">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="basic-datatable">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Student Details with Roll no</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($students as $key => $value) { ?>
                                                <tr>
                                                    <td><input type="checkbox" name="student_id[]" id="" value="<?= $value['matched_std_id'] ?>"></td>
                                                    <td><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] . " - " . $value['enrollment_no'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
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
                                <td>Student</td>
                                <td>Department</td>
                                <td>Program</td>
                                <td>Semester</td>
                                <td>Upload by</td>
                                <td>Upload Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students_mapped_data as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></td>
                                    <td><?= $value['department_name'] ?></td>
                                    <td><?= $value['program_name'] ?></td>
                                    <td><?= $value['semester'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                       if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td><?= $value['created_at'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/edit-program-dept-std-mapping/<?= $value['student_mapping_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/delete-program-dept-std-mapping/<?= $value['student_mapping_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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