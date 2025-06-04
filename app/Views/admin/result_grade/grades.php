<!-- app/Views/gradedetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();
?>
<div class="row">
    <!-- Form Section for Adding Grade Details -->
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Grade Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/grades" method="post">
                    <!-- Grade -->
                    <div class="form-group">
                        <span for="Grade">Grade:</span>
                        <input type="text" name="Grade" id="Grade" class="form-control form-control-sm" required>
                    </div>

                    <!-- Grade Point -->
                    <div class="form-group mt-3">
                        <span for="Gradepoint">Grade Point:</span>
                        <input type="number" name="Gradepoint" id="Gradepoint" class="form-control form-control-sm" step="0.1" min="0" >
                    </div>

                    <!-- Performance -->
                    <div class="form-group mt-3">
                        <span for="Performances">Performance Description:</span>
                        <textarea name="Performances" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Grade Details (Optional) -->
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Grade Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Grade</td>
                                <td>Grade Point</td>
                                <td>Performance</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($grade as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['grade'] ?></td>
                                <td><?= $value['grade_point'] ?></td>
                                <td><?= $value['performance'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
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