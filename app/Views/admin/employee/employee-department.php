<!-- app/Views/empdeptdetails_form.php -->
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>

            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="/empdeptdetails/store" method="post">
                    <?= csrf_field() ?>

                    <!-- Deptid Field -->
                    <div class="row">
                        <span for="Deptid">Department ID: <span class="text-danger">*</span></span>
                        <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                            <option value="">Select Department</option>
                        </select>
                    </div>
                    <br>

                    <!-- Empid Field -->
                    <div class="row">
                        <span for="Empid">Employee ID: <span class="text-danger">*</span></span>
                        <select name="Empid" id="Empid" class="form-control form-control-sm" required >
                            <option value="">Select Employee ID</option>
                        </select>
                    </div>
                    <br>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table to display existing empdeptdetails -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Department ID</td>
                                <td>Employee ID</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>