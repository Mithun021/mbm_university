<!-- app/Views/actrulesdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Act_rules_category_model;
use App\Models\Employee_model;

$employee_model = new Employee_model();
$act_rules_category_model = new Act_rules_category_model();
?>

<div class="row">
    <!-- Form Section for Adding Act Rules Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Act Rules Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/act-rules" method="post" enctype="multipart/form-data">

                    <!-- Act Rules Type -->
                    <div class="form-group">
                        <span for="Actrulestype">Act Rules Type:</span>
                        <select name="Actrulestype" id="Actrulestype" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Act Rules Type</option>
                            <?php foreach ($act_rules_category as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Act Rules Title -->
                    <div class="form-group">
                        <span for="Actrulestitle">Act Rules Title:</span>
                        <input type="text" name="Actrulestitle" id="Actrulestitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- Act Rules Description -->
                    <div class="form-group">
                        <span for="Actrulesdesc">Act Rules Description:</span>
                        <textarea name="Actrulesdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                    </div>

                    <!-- Act Rules File Upload -->
                    <div class="form-group">
                        <span for="Actrulesfileupload">Upload Act Rules File:(.pdf,.jpg,.png)</span>
                        <input type="file" name="Actrulesfileupload" id="Actrulesfileupload" class="form-control form-control-sm" accept=".pdf,.jpg,.png" required>
                    </div>

                    <!-- Act Rules File Upload -->
                    <div class="form-group">
                      <span for="Actrulesfileupload">Assign Date<span class="text-danger">*</span></span>
                        <input type="date" name="act_date" id="act_date" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="Actrulesfileupload">Status<span class="text-danger">*</span></span>
                        <select name="act_status" id="act_status" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Act Rules Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Act Rules Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Act Rules Type</td>
                                <td>Act Rules Title</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($act_rules as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/act_rules/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/act_rules/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/act_rules/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $act_rules_category_model->get($value['rules_type'])['name'] ?? '';  ?></td>
                                    <td><?= $value['rules_title'] ?></td>
                                    <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
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

<?= $this->endSection() ?>