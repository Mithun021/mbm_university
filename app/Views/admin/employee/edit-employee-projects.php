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
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/edit-employee-projects/<?= $emp_project_id ?>" method="post">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>

                    <!-- Form Start -->

                    <div class="card card-body mb-1">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <span for="Empid">Employee:</span>
                                <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value) { ?>
                                        <option value="<?= $value['id'] ?>" <?php if($value['id'] == $employee_projects_detail['emplyee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <span for="projecttitle">Project Title:<span class="text-danger">*</span></span>
                                    <textarea type="text" name="projecttitle" id="editor" class="form-control form-control-sm clone_editor"><?= $employee_projects_detail['project_title'] ?></textarea>
                                </div>
                                <!-- <div class="col-lg-12">
                            <span for="projectdesc">Project Description:</span>
                            <textarea name="projectdesc" id="" class="form-control form-control-sm clone_editor" rows="4"></textarea>
                        </div> -->
                                <div class="col-lg-4 form-group">
                                    <span for="projectstartdatetime">Project Start Date:<span class="text-danger">*</span></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="project_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?= $employee_projects_detail['start_date'] ?>">
                                        <!-- <input type="text" class="form-control form-control-sm" name="project_start_time"  placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')"> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectenddatetime">Project End Date:<span class="text-danger">*</span></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="project_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?= $employee_projects_detail['end_date'] ?>">
                                        <!-- <input type="text" class="form-control form-control-sm" name="project_end_time"  placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')"> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectenddatetime">Sanctioned Year:</span>
                                    <input type="number" class="form-control form-control-sm" name="sanctioned_year" placeholder="Sanctioned  Year" value="<?= $employee_projects_detail['sanctioned_year'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectstatus">Project Status:<span class="text-danger">*</span></span>
                                    <select name="projectstatus" id="projectstatus" class="form-control form-control-sm" required>
                                        <option value="Not Started" <?php if($employee_projects_detail['project_status'] == "Not Started"){ echo "selected"; } ?>>Not Started</option>
                                        <option value="In Progress" <?php if($employee_projects_detail['project_status'] == "In Progress"){ echo "selected"; } ?>>In Progress</option>
                                        <option value="Completed" <?php if($employee_projects_detail['project_status'] == "Completed"){ echo "selected"; } ?>>Completed</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectsponseredby">Sponsored By:<span class="text-danger">*</span></span>
                                    <input type="text" name="projectsponseredby" id="projectsponseredby" class="form-control form-control-sm" value="<?= $employee_projects_detail['sponsored_by'] ?>">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="projectvalue">Project Value (in INR):<span class="text-danger">*</span></span>
                                    <input type="number" name="projectvalue" id="projectvalue" class="form-control form-control-sm" step="0.01" value="<?= $employee_projects_detail['project_value'] ?>">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="projectvalue">Role</span>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        <option value="PI" <?php if($employee_projects_detail['role'] == "PI"){ echo "selected"; } ?>>PI</option>
                                        <option value="Co-PI" <?php if($employee_projects_detail['role'] == "Co-PI"){ echo "selected"; } ?>>Co-PI</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="funding_source">Funding Source </span>
                                    <select name="funding_source" id="funding_source" class="form-control form-control-sm">
                                        <option value="">--Select--</option>
                                        <option value="Government" <?php if($employee_projects_detail['funding_source'] == "Government"){ echo "selected"; } ?>>Government</option>
                                        <option value="Private" <?php if($employee_projects_detail['funding_source'] == "Private"){ echo "selected"; } ?>>Private</option>
                                        <option value="Industry" <?php if($employee_projects_detail['funding_source'] == "Industry"){ echo "selected"; } ?>>Industry</option>
                                        <option value="Others" <?php if($employee_projects_detail['funding_source'] == "Others"){ echo "selected"; } ?>>Others</option>
                                    </select>
                                    <div class="other_funding_source_container" style="display: none;">
                                        <span>Other Funding Source</span>
                                        <input type="text" class="form-control form-control-sm" name="other_funding_source" value="<?= $employee_projects_detail['other_funding_source'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table to display existing empprojectdetails -->
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
                                <td>Employee ID</td>
                                <td>Project Title</td>
                                <td>Sanctioned Year</td>
                                <td>Project Status</td>
                                <td>Project Date</td>
                                <td>Sponsored by</td>
                                <td>Project Value</td>
                                <td>Role</td>
                              	<td>Funding Source</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_projects as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['emplyee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['project_title'] ?></td>
                                    <td><?= $value['sanctioned_year'] ?></td>
                                    <td><?= $value['project_status'] ?></td>
                                    <td><?= $value['start_date'] . " - " . $value['end_date'] ?></td>
                                    <td><?= $value['sponsored_by'] ?></td>
                                    <td><?= $value['project_value'] ?></td>
                                    <td><?= $value['role'] ?></td>
                              	    <td><?= $value['funding_source'] ?> <?= $value['other_funding_source'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-projects/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-projects/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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
        const fundingSelect = document.getElementById('funding_source');
        const otherContainer = document.querySelector('.other_funding_source_container');

        function toggleOtherContainer() {
            if (fundingSelect.value === 'Others') {
                otherContainer.style.display = 'block';
            } else {
                otherContainer.style.display = 'none';
            }
        }

        // Run on page load in case "Others" is already selected (for edit form)
        toggleOtherContainer();

        // Attach change event
        fundingSelect.addEventListener('change', toggleOtherContainer);
    });
</script>

<?= $this->endSection() ?>