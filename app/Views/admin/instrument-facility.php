<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Employee_model;
    $employee_model = new Employee_model();
    $department_model = new Department_model();
?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/instrument-facility" method="post" enctype="multipart/form-data">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Instrument Title:</span>
                        <input type="text" name="Recruitertitle" id="Recruitertitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- Recruiter Description -->
                    <div class="form-group">
                        <span>Instrument Description:</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <!-- Recruiter Image Upload -->
                    <div class="form-group">
                        <span for="Recruiterimage">Upload Image(.jpg,.jpeg,.png):</span>
                        <input type="file" name="upload_file" id="Recruiterimage" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <div class="form-group">
                        <span>Department</span>
                        <select name="department" id="department" class="form-control form-control-sm">
                            <option value="">--Select--</option>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <span for="Recruiterimage">Gallery Image(.jpg,.jpeg,.png):</span>
                        <input type="file" name="gallery_file[]" id="Recruiterimage" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" multiple>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Recruiter Details (Optional) -->
    <div class="col-lg-8">
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
                                <td>File</td>
                                <td>Instrument Title</td>
                                <td>Dept.</td>
                                <td>Instrument Description</td>
                                <td>Instrument Image</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($instruments as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/instrument/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/instrument/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/instrument/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/instrument/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $department_model->get($value['department_id'])['name'] ?? '' ?></td>
                                <td><?= $value['description'] ?></td>
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