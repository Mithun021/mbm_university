<!-- app/Views/academicdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Academic Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Academic Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/academic-details" method="post" enctype="multipart/form-data">
                    <!-- Academic Year -->
                    <div class="form-group">
                        <span for="Acdyear">Session Start Year:<span class="text-danger">*</span></span>
                        <input type="number" name="session_start_year" id="session_start_year" class="form-control form-control-sm" min="2000" required>
                    </div>

                    <div class="form-group">
                        <span for="Acdyear">Session End Year:<span class="text-danger">*</span></span>
                        <input type="number" name="session_end_year" id="session_end_year" class="form-control form-control-sm" min="2000" required>
                    </div>

                    <!-- Upload Academic Calendar -->
                    <div class="form-group mt-3">
                        <span for="Acdcalenderfileupload">Upload Academic Calendar(.pdf):<span class="text-danger">*</span></span>
                        <input type="file" name="acdcalenderfileupload" id="acdcalenderfileupload" class="form-control" accept=".pdf" required>
                    </div>

                    <!-- Upload Academic Fees File -->
                    <div class="form-group mt-3">
                        <span for="Acdfeesfileupload">Upload Fees File(.pdf):<span class="text-danger">*</span></span>
                        <input type="file" name="acdfeesfileupload" id="acdfeesfileupload" class="form-control" accept=".pdf" required>
                    </div>

                    <!-- Upload Academic Calendar -->
                    <!-- <div class="form-group mt-3">
                        <span for="Acdcalenderfileupload">Examination Grading System(.pdf):<span class="text-danger">*</span></span>
                        <input type="file" name="examin_grade_file" id="examin_grade_file" class="form-control" accept=".pdf" required>
                    </div> -->

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Academic Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Academic Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Academic Session</td>
                                <td>Calendar/Fees<!--/Exam. Grad Files--></td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($academic_details as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['session_start'] ?> - <?= $value['session_end'] ?></td>
                                    <td>
                                        <?php if (!empty($value['calendar_file']) && file_exists('public/admin/uploads/academic/' . $value['calendar_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/academic/<?= $value['calendar_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/academic/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['fees_file']) && file_exists('public/admin/uploads/academic/' . $value['fees_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/academic/<?= $value['fees_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/academic/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
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

<?= $this->endSection() ?>