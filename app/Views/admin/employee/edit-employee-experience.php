<!-- app/Views/empexpdetails_form.php -->

<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>
    #clone_content #clone_employee_data:first-child button#remove-clone {
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Edit <?= $title; ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/edit-employee-experience/<?= $employee_exp_id ?>" method="post">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>
                    <!-- Form Start -->

                    <div class="card card-body mb-1">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <span for="Empid">Employee:<span class="text-danger">*</span></span>
                                <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($value['id'] == $employee_exp_detail['emplyee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Empid -->
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <span for="orgname">Organization Name:<span class="text-danger">*</span></span>
                                    <input type="text" name="orgname" id="orgname" class="form-control form-control-sm" value="<?= $employee_exp_detail['organization_name'] ?>" required>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="startdate">Start Date:<span class="text-danger">*</span></span>
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm" value="<?= $employee_exp_detail['start_date'] ?>" required>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="enddate">End Date:</span>
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm" value="<?= $employee_exp_detail['end_date'] ?>">
                                  	<span for="enddate"><input type="checkbox" name="stillwork" id="stillwork" value="1" <?php if($employee_exp_detail['stillwork'] == 1){ echo "checked"; } ?>> Still Work (check if you are still working):</span>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <span for="expdesc">Experience Designation:</span>
                                    <input type="text" name="expdesc" class="form-control form-control-sm" value="<?= $employee_exp_detail['exp_description'] ?>">
                                    <!-- <textarea name="expdesc[]" class="form-control form-control-sm clone_editor" rows="4"></textarea> -->
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="orgtype">Organization Type:<span class="text-danger">*</span></span>
                                    <select name="orgtype" id="orgtype" class="form-control form-control-sm" required>
                                    <?php foreach($organisation_type as $value){ ?>
                                        <option value="<?= $value['name'] ?>" <?php if($value['name'] == $employee_exp_detail['org_type']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                    <?php } ?>    
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="natureofwork">Nature of Work:<span class="text-danger">*</span></span>
                                    <select name="natureofwork" id="natureofwork" class="form-control form-control-sm">
                                    <?php foreach($nature_of_work as $value){ ?>
                                        <option value="<?= $value['name'] ?>" <?php if($value['name'] == $employee_exp_detail['work_nature']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                    <?php } ?> 
                                    </select>

                                    <div id="work_details" style="display: none;">
                                        <span>Description of Works</span>
                                        <input type="text" name="work_description" id="work_description" class="form-control form-control-sm" value="<?= $employee_exp_detail['work_description'] ?>">
                                    </div>
                                </div>


                            </div><!-- Close row -->
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table to display existing empexpdetails -->
    <div class="col-lg-12">
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
                                <td>Employee</td>
                                <td>Org. Name</td>
                                <td>Start & End Date</td>
                                <td>Org. Type</td>
                                <td>Work Nature</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_exp as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['emplyee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['organization_name'] ?></td>
                                    <td><?= $value['start_date'] . " - " ?> <?php if ($value['end_date'] === '0000-00-00') { if($value['stillwork'] == 1){ echo "Still Work."; } }else { echo $value['end_date']; } ?></td>
                                    <td><?= $value['org_type'] ?></td>
                                    <td><?= $value['work_nature'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-experience/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-experience/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const natureSelect = document.getElementById('natureofwork');
    const workDetails = document.getElementById('work_details');

    function toggleWorkDetails() {
        if (natureSelect.value === 'Teaching') {
            workDetails.style.display = 'none';
        } else {
            workDetails.style.display = 'block';
        }
    }

    // Run once on page load to set the initial state
    toggleWorkDetails();

    // Add event listener to handle selection change
    natureSelect.addEventListener('change', toggleWorkDetails);
});
</script>


<?= $this->endSection() ?>