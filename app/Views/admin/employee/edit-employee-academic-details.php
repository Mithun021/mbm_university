<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Edit <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/edit-employee-academic-details/'.$academic_id) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="">Employee Id<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="employee_id" required>
                                <option value="">--Select--</option>
                                <?php foreach ($employee as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($value['id'] == $academic_details['employee_id']){ echo "selected"; } ?>><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Type of the Degree<span class="text-danger">*</span></span>
                            <select class="form-control form-control-sm" name="degree_type" required>
                                <option value="">--Select--</option>
                                <option value="UG" <?php if($academic_details['degree_type'] == "UG"){ echo "selected"; } ?>>UG</option>
                                <option value="PG" <?php if($academic_details['degree_type'] == "PG"){ echo "selected"; } ?>>PG</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Name of the Degree<span class="text-danger">*</span></span>
                            <input type="text" name="degree_name" id="" class="form-control form-control-sm" value="<?= $academic_details['degree_name'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Subject Studied<span class="text-danger">*</span></span>
                            <input type="text" name="subject_studied" id="" class="form-control form-control-sm" value="<?= $academic_details['subject_studied'] ?>" required>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <span for="">Marking Scheme(%/CGPA)<span class="text-danger">*</span></span>
                            <input type="text" name="marking_scheme" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">Obtained Result</span>
                            <input type="text" name="obtained_result" id="" class="form-control form-control-sm">
                        </div> -->
                        <div class="form-group col-md-6">
                            <span for="">Year of Passing</span>
                            <input type="number" name="passing_year" id="" class="form-control form-control-sm" maxlength="4" value="<?= $academic_details['passing_year'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="">University</span>
                            <input type="text" name="university" id="" class="form-control form-control-sm" value="<?= $academic_details['university'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University (Country)</span>
                            <select name="university_country" id="university_country" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            <?php foreach ($country as $key => $value) { ?>
                                <option value="<?= $value['country'] ?>" <?php if($academic_details['university_country'] == $value['country']){ echo "selected"; } ?>><?= $value['country'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="">University (State/UT)</span>
                            <select name="university_state" id="university_state" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <span for="">Document Upload(.pdf,.jpg,.jpeg,.png)</span>
                            <input type="file" name="document_file" id="" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                            <?php if (!empty($academic_details['document_file']) && file_exists('public/admin/uploads/employee/' . $academic_details['document_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $academic_details['document_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                <td>Degree Type</td>
                                <td>Degree Name</td>
                                <td>Subject Studied</td>
                                <td>Marking Scheme(%/CGPA)</td>
                                <td>Obtained Result</td>
                                <td>Passing Year</td>
                                <td>University</td>
                                <td>University (Country)</td>
                                <td>University (State/UT)</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_academic_details as $key => $value) { ?>
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
                                    <td><?= $value['degree_type'] ?></td>
                                    <td><?= $value['degree_name'] ?></td>
                                    <td><?= $value['subject_studied'] ?></td>
                                    <td><?= $value['marking_scheme'] ?></td>
                                    <td><?= $value['obtained_result'] ?></td>
                                    <td><?= $value['passing_year'] ?></td>
                                    <td><?= $value['university'] ?></td>
                                    <td><?= $value['university_country'] ?></td>
                                    <td><?= $value['university_state'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name'];}  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-employee-academic-details/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-employee-academic-details/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure....!')"><i class="far fa-trash-alt"></i></a>
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

<!-- jQuery  -->
<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>
    var selectedCountry = "<?= $academic_details['university_country'] ?>";
    var selectedState = "<?= $academic_details['university_state'] ?>";
    function loadStates(countryName, selectedState = '') {
        $.ajax({
            type: "post",
            url: "<?= base_url('getStates'); ?>",
            data: { country_name: countryName },
            dataType: "json",
            success: function (response) {
                var stateDropdown = $('#university_state');
                stateDropdown.empty(); 
                stateDropdown.append('<option value="">--Select--</option>');

                if (response.length > 0) {
                    $.each(response, function(index, state) {
                        var isSelected = (state.state === selectedState) ? 'selected' : '';
                        stateDropdown.append('<option value="' + state.state + '" ' + isSelected + '>' + state.state + '</option>');
                    });
                } else {
                    stateDropdown.append('<option value="">No states available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    // On country change
    $('#university_country').on('change', function () {
        var countryName = $(this).val();
        loadStates(countryName);
    });

    // On page load: if selectedCountry exists, trigger state loading
    $(document).ready(function () {
        if (selectedCountry) {
            $('#university_country').val(selectedCountry);
            loadStates(selectedCountry, selectedState);
        }
    });
</script>


<?= $this->endSection() ?>