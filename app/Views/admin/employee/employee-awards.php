<!-- app/Views/empawarddetails_form.php -->
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
    <!-- Form Section for Adding  Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger" id="export_sample_btn">Export Emp. Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <form action="<?= base_url() ?>admin/employee-awards" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('msg')): ?>
                        <?= session()->getFlashdata('msg') ?>
                    <?php endif; ?>

                    <!-- Form Start -->
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="clone_content">
                        <div class="card card-body" id="clone_employee_data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Award Title -->
                                    <div class="form-group">
                                        <span for="Awardtitle">Name of Awarding:</span>
                                        <input type="text" name="Awardtitle[]" id="" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Reason of Awarding<span class="text-danger">*</span></span>
                                    <select class="form-control form-control-sm" name="award_reason[]" required>
                                        <option value="">--Select--</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Research">Research</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Date of Awarding<span class="text-danger">*</span></span>
                                    <input type="date" name="date_of_awarding[]" id="" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Body name of Awarding<span class="text-danger">*</span></span>
                                    <input type="text" name="body_name_of_awarding[]" id="" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-6">
                                    <span for="">Level<span class="text-danger">*</span></span>
                                    <select class="form-control form-control-sm" name="level[]" required>
                                        <option value="">--Select--</option>
                                        <option value="National">National</option>
                                        <option value="International">International</option>
                                        <option value="University">University</option>
                                        <option value="Industry">Industry</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Award Photo Upload -->
                                    <div class="form-group">
                                        <span for="Awardphotoupload">Document Upload(.pdf,.jpg,.jpeg,.png):</span>
                                        <input type="file" name="Awardphotoupload[]" id="Awardphotoupload" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="button" id="remove-clone" class="btn btn-danger" style="width: 120px;">Remove Clone</button>
                                </div>
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

    <!-- Table Section to Display Existing Awards (Optional) -->
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
                                <td>File</td>
                                <td>Emp. ID</td>
                                <td>Reason of Award</td>
                                <td>Name of Award</td>
                                <td>Award Date</td>
                                <td>Body name of Award</td>
                                <td>Level</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($awards as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['document_file']) && file_exists('public/admin/uploads/employee/' . $value['document_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= $value['award_reason'] ?></td>
                                    <td><?= $value['name_of_awarding'] ?></td>
                                    <td><?= $value['date_of_awarding'] ?></td>
                                    <td><?= $value['body_name_of_awarding'] ?></td>
                                    <td><?= $value['level'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-awards/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-awards/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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
            <form action="<?= base_url() ?>admin/export_emp_award_sample" method="post">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p class="m-0">Note : After exporting the CSV, do not delete the top headings from the Excel sheet.</p>
                    </div>
                    <?php foreach ($employee as $value) { ?>
                        <span><input type="checkbox" name="emp_id[]" value="<?= $value['id'] ?>"> <?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></span> <br>
                    <?php } ?>
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
                <h5 class="modal-title">Upload Employee Awards Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/upload_emp_award_csv" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p class="m-0">1. Ensure that the employee is available before uploading the CSV file. Please verify employee details beforehand.</p>
                        <p class="m-0">2. The employee's mobile number and official email ID must be available.</p>
                        <p class="m-0">3. Before uploading the CSV, cross-check the employee's official email address and mobile number.</p>
                        <p class="m-0">4.Please upload only CSV files.</p>
                    </div>
                    <input type="file" name="csv_file" class="dropify" data-height="300" />
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
        // Add Clone Button Click
        $("#add-clone").click(function(e) {
            e.preventDefault();

            // Clone the employee data card
            var cloneCatrow = $('#clone_employee_data').first().clone();

            // Reset the cloned fields
            cloneCatrow.find('input, textarea, select').val('');
            cloneCatrow.find('.ck-editor').remove(); // Remove existing CKEditor container if any

            // Append the cloned element to the clone content container
            cloneCatrow.appendTo('#clone_content');

            // Reinitialize CKEditor for cloned textarea
            cloneCatrow.find('.clone_editor').removeAttr('data-ckeditor-initialized'); // Reset the initialized flag
            initializeEditors(); // Reinitialize editors
        });

        // Remove Clone Button Click
        $('#clone_content').on('click', '#remove-clone', function() {
            $(this).closest('#clone_employee_data').remove();
        });

        // Modal Trigger (Optional Example for Context)
        $('#upload_emp_exp_btn').on('click', function(e) {
            e.preventDefault();
            $('#upload_emp_exp_modal').modal('show');
        });

        $('#export_sample_btn').on('click', function(e) {
            e.preventDefault();
            $('#export_emp_sample_modal').modal('show');
        });

        // Sync CKEditor Data Before Form Submission
        $('form').on('submit', function() {
            $('.clone_editor').each(function() {
                if (this.editorInstance) {
                    this.value = this.editorInstance.getData(); // Sync CKEditor content to textarea
                }
            });
        });
    });

    // CKEditor Initialization
    function initializeEditors() {
        document.querySelectorAll(".clone_editor").forEach((textarea) => {
            if (!textarea.dataset.ckeditorInitialized) {
                ClassicEditor.create(textarea)
                    .then(editor => {
                        textarea.editorInstance = editor; // Save the CKEditor instance for later use
                    })
                    .catch(error => console.error(error));
                textarea.dataset.ckeditorInitialized = true; // Mark as initialized
            }
        });
    }

    // Initialize editors for existing elements on page load
    initializeEditors();
</script>

<?= $this->endSection() ?>