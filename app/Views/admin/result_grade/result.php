<!-- app/Views/resultdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
use App\Models\Department_model;
use App\Models\Employee_model;
use App\Models\Program_model;
$employee_model = new Employee_model();
$department_model = new Department_model();
$program_model = new Program_model();
?>

<div class="row">
    <!-- Form Section for Adding Result Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Result Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/result" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Result Description -->
                            <div class="form-group">
                                <span for="resultdesc">Result Description:<span class="text-danger">*</span></span>
                                <textarea name="resultdesc" id="editor" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Deptid">Department ID:<span class="text-danger">*</span></span>
                                <select name="Deptid" id="Deptid" class="form-control form-control-sm" required>
                                    <option value="">Select Deparrtment</option>
                                    <?php foreach ($department as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Progid">Program ID:<span class="text-danger">*</span></span>
                                <select name="Progid" id="Progid" class="form-control form-control-sm" required>
                                    <option value="">Select Program</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Convnumber">Academic Session Start Year:<span class="text-danger">*</span></span>
                                <input type="number" name="academic_start_year" id="academic_start_year" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Convnumber">Academic Session End Year:<span class="text-danger">*</span></span>
                                <input type="number" name="academic_end_year" id="academic_end_year" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6"><!-- Semester -->
                            <div class="form-group">
                                <span for="semester">Semester:<span class="text-danger">*</span></span>
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Convnumber">Result Notification Date:<span class="text-danger">*</span></span>
                                <input type="date" name="notification_date" id="academic_end_year" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Result File Upload -->
                            <div class="form-group mt-3">
                                <span for="Resultfileupload">Upload Result File(.pdf):<span class="text-danger">*</span></span>
                                <input type="file" name="file_upload" id="file_upload" class="form-control form-control-sm" accept=".pdf" required>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Result Details (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Result Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Result Description</td>
                                <td>Program</td>
                                <td>Dept.</td>
                                <td>Academic Year</td>
                                <td>Semester</td>
                                <td>Notification Date</td>
                                <td>Upload by</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td>
                                <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/result/' . $value['file_upload'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/result/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/result/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                </td>
                                <td><?= $value['resultdesc'] ?></td>
                                <td><?php echo $department_model->get($value['department_id'])['name'] ?? ''  ?></td>
                                <td><?php echo $program_model->get($value['program_id'])['name'] ?? '' ?></td>
                                <td><?= $value['academic_start_year'] ?> - <?= $value['academic_end_year'] ?></td>
                                <td><?= $value['semester'] ?></td>
                                <td><?= $value['notification_date'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= date("d-M-Y h:i A", strtotime($value['created_at'])) ?> </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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