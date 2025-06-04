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
                <form action="<?= base_url() ?>admin/assignCourseList" method="post">

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
                                <h3 class="mb-2">Course Details:</h3>
                                <div class="student-details">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="long-datatable">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Course Details</td>
                                                    <td>Credits</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($courses as $key => $value) { ?>
                                                    <tr>
                                                        <td><span><?= $value['id'] ?> <input type="checkbox" name="course_id[]" value="<?= $value['id'] ?>"></span></td>
                                                        <td><?= $value['course_name'] ?> - <?= $value['course_code'] ?></td>
                                                        <td><input type="number" class="form-control form-control-sm" name="credit_score[]"></td>
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
                                    <td><?php $program = $program_model->getProgramWithBatch($value['program_id']); echo $program['program_name']. ' - '.$program['batch_start']. ' - '.$program['batch_end'] ?? '__'; ?></td>
                                    <td><?= $value['semester'] ?></td>
                                    <td><?php $course = $courses_model->get($value['course_id']); echo $course['course_name'] ?? '__'; echo " - " . $course['course_code'] ?? '__' ?></td>
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

<script>
    $(document).ready(function () {
        // Object to store the state of checkboxes and input fields
        let state = {};

        // Initialize DataTable
        const table = $('#long-datatable').DataTable({
            "pageLength": 100,
            "lengthMenu": [5, 10, 20, 50, 100],
        });

        // Save the state of checkboxes and inputs on change
        $('#long-datatable').on('change', 'input[type="checkbox"][name="course_id[]"], input[name="credit_score[]"]', function () {
            const row = $(this).closest('tr');
            const rowId = row.find('input[type="checkbox"]').val();

            if (!state[rowId]) {
                state[rowId] = {};
            }

            // Save checkbox state
            state[rowId].checked = row.find('input[type="checkbox"]').is(':checked');

            // Save input value
            state[rowId].creditScore = row.find('input[name="credit_score[]"]').val();
        });

        // Restore the state after each redraw
        table.on('draw', function () {
            $('#long-datatable tbody tr').each(function () {
                const row = $(this);
                const rowId = row.find('input[type="checkbox"]').val();

                if (state[rowId]) {
                    // Restore checkbox state
                    row.find('input[type="checkbox"]').prop('checked', state[rowId].checked || false);

                    // Restore input value
                    row.find('input[name="credit_score[]"]').val(state[rowId].creditScore || '');
                }
            });
        });

        // Ensure all states are preserved on form submission
        $('form').on('submit', function (e) {
            // Prevent duplicate data by using a Set to track processed IDs
            const processedIds = new Set();

            // Clear any previously appended hidden inputs
            $(this).find('input[type="hidden"]').remove();

            // Append the state data to hidden inputs for submission
            for (const [key, value] of Object.entries(state)) {
                if (value.checked && !processedIds.has(key)) {
                    processedIds.add(key); // Mark the ID as processed
                    $(this).append(`<input type="hidden" name="course_id[]" value="${key}">`);
                    $(this).append(`<input type="hidden" name="credit_score[]" value="${value.creditScore || ''}">`);
                }
            }
        });
    });
</script>



<?= $this->endSection() ?>