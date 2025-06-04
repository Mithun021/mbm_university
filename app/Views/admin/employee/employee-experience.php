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
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger" id="export_sample_btn">Export Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <form action="<?= base_url() ?>admin/employee-experience" method="post">
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
                                        <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
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
                                    <input type="text" name="orgname[]" id="orgname" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="startdate">Start Date:<span class="text-danger">*</span></span>
                                    <input type="date" name="startdate[]" id="startdate" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <span for="enddate">End Date:</span>
                                    <input type="date" name="enddate[]" id="enddate" class="form-control form-control-sm">
                                  	<span for="enddate"><input type="checkbox" name="stillwork[]" id="stillwork" value="1"> Still Work (check if you are still working):</span>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <span for="expdesc">Experience Designation:<span class="text-danger">*</span></span>
                                    <input type="text" name="expdesc[]" class="form-control form-control-sm">
                                    <!-- <textarea name="expdesc[]" class="form-control form-control-sm clone_editor" rows="4"></textarea> -->
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="orgtype">Organization Type:<span class="text-danger">*</span></span>
                                    <select name="orgtype[]" id="orgtype" class="form-control form-control-sm" required>
                                    <?php foreach($organisation_type as $value){ ?>
                                        <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>    
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <span for="natureofwork">Nature of Work:<span class="text-danger">*</span></span>
                                    <select name="natureofwork[]" id="natureofwork" class="form-control form-control-sm">
                                    <?php foreach($nature_of_work as $value){ ?>
                                        <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?> 
                                    </select>

                                    <div id="work_details" style="display: none;">
                                        <span>Description of Works</span>
                                        <input type="text" name="work_description[]" id="work_description" class="form-control form-control-sm">
                                    </div>
                                </div>


                            </div><!-- Close row -->
                            <button type="button" id="remove-clone" class="btn btn-danger" style="width: 120px;">Remove Clone</button>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="button" id="add-clone" class="btn btn-success">Add Clone</button>
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

<div class="modal fade" tabindex="-1" role="dialog" id="export_emp_sample_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Employee Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/export_emp_experience_sample" method="post">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p class="m-0">Note : After exporting the CSV, do not delete the top headings from the Excel sheet.</p>
                    </div>
                    <div class="card card-body">
                        <h5 class="m-0 p-2 border-bottom border-danger mb-3">Employee Details</h5>
                        <?php foreach ($employee as $value) { ?>
                            <span><input type="checkbox" name="emp_id[]" value="<?= $value['id'] ?>"> <?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></span> <br>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Download CSV</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="upload_emp_exp_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Employee Experience Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/upload_emp_experience_csv" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p class="m-0">1. Ensure that the employee is available before uploading the CSV file. Please verify employee details beforehand.</p>
                        <p class="m-0">2. The employee's mobile number and official email ID must be available.</p>
                        <p class="m-0">3. Before uploading the CSV, cross-check the employee's official email address and mobile number.</p>
                        <p class="m-0">4.Please upload only CSV files.</p>
                    </div>
                    <input type="file" class="dropify" name="csv_file" data-height="300" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<!-- jQuery Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to toggle work description field
        function toggleWorkDescription(selectElement) {
            var selectedValue = $(selectElement).val();
            var workDetails = $(selectElement).closest('.row').find('#work_details');

            if (selectedValue !== "Teaching") {
                workDetails.show();
            } else {
                workDetails.hide();
                workDetails.find('input').val(''); // Clear input field when hidden
            }
        }

        // Add Clone Button Click
        $("#add-clone").click(function(e) {
            e.preventDefault();

            // Clone the employee data card
            var cloneCatrow = $('#clone_employee_data').first().clone();
            cloneCatrow.appendTo('#clone_content');

            // Reset all input fields and uncheck checkboxes
            $(cloneCatrow).find('input, textarea, select').val('');
            $(cloneCatrow).find('input[type="checkbox"]').prop('checked', false);

            // Ensure that the work description section is hidden initially
            $(cloneCatrow).find('#work_details').hide();

            // Bind event listener to new clone
            $(cloneCatrow).find('#natureofwork').on('change', function() {
                toggleWorkDescription(this);
            });
        });

        // Remove Clone Button Click
        $('#clone_content').on('click', '#remove-clone', function() {
            $(this).closest('.card-body').remove();
        });

        // Nature of Work Change Event
        $('#clone_content').on('change', '#natureofwork', function() {
            toggleWorkDescription(this);
        });

        // Synchronize form data before submission
        $('form').on('submit', function() {
            $('input[type="checkbox"]').each(function() {
                if (!$(this).prop('checked')) {
                    $(this).val('0'); // Set unchecked checkboxes' value to '0'
                }
            });
        });

        // Initial call for default selection
        $('#natureofwork').each(function() {
            toggleWorkDescription(this);
        });
    });
</script>


<?= $this->endSection() ?>