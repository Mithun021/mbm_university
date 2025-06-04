<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;

$department_model = new Department_model();
$designation_model = new Designation_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('msg')) {
                    echo session()->getFlashdata('msg');
                }
                ?>
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee" method="post" enctype="multipart/form-data">
                    <!-- Employee Name Fields -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="EmpFirstName">Employee ID:</span>
                            <input type="text" name="employee_unique_id" id="employee_unique_id" class="form-control form-control-sm" required minlength="3">
                        </div>
                        <div class="col-sm-6">
                            <span for="EmpFirstName">Joining Date:</span>
                            <input type="date" name="joining_date" id="joining_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpFirstName">First Name:</span>
                            <div class="input-group">
                                <select name="sir_name" id="sir_name" class="form-control form-control-sm">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss.">Miss.</option>
                                    <option value="Sir">Sir</option>
                                    <option value="Dr.">Dr.</option>
                                </select>
                                <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" required minlength="3">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpMiddleName">Middle Name:</span>
                            <input type="text" name="middle_name" id="middle_name" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Last Name:</span>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Blood Group:</span>
                            <select name="blood_group" id="blood_group" class="form-control form-control-sm" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Gender:</span>
                            <select name="gender" id="gender" class="form-control form-control-sm" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Any Other">Any Other</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Material Status:</span>
                            <select name="material_status" id="material_status" class="form-control form-control-sm" required>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    <!-- Designation, Department, Mobile, and Landline -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="Empdesignation">Designation:</span>
                            <select name="designation_id" id="designation_id" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <?php foreach ($designations as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <span for="Empdepartmentid">Department:</span>
                            <select name="department_id[]" id="department_id" class="form-control form-control-sm my-select" multiple required>
                                <option value="">--Select--</option>
                                <?php foreach ($departments as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <span for="Empmobile">Mobile Number:</span>
                            <input type="tel" name="mobile_no" id="mobile_no" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="Empmobile">Alternate Mobile Number:</span>
                            <input type="tel" name="alternate_mobile_no" id="alternate_mobile_no" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4">
                            <span for="Emplandlineno">Landline Number:</span>
                            <input type="tel" name="landline_no" id="landline_no" class="form-control form-control-sm">
                        </div>
                    </div>

                    <!-- Email Fields -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="Empofficialemail">Official Email:</span>
                            <input type="email" name="official_mail" id="official_mail" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-sm-6">
                            <span for="Emppersonalemail">Personal Email:</span>
                            <input type="email" name="personal_mail" id="personal_mail" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <span for="Emptype">Caste:</span>
                            <select name="caste" id="caste" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <option value="General">General</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                            </select>
                            <div class="form-group" id="ews-group" style="display: none;">
                                <span><input type="checkbox" name="ews" value="1"> EWS</span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <span for="Emptype">Religion:</span>
                            <select name="religion" id="religion" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Sikh">Sikh</option>
                                <option value="Christian">Christian</option>
                            </select>
                        </div>
                    </div>
                    <!-- Photo and Resume Uploads -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="Empphotoupload">Photo Upload(.pnd,.jpg,.jpeg):</span>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="col-sm-6">
                            <span for="Empresumeupload">Resume Upload(.pdf,.docx):</span>
                            <input type="file" name="resume_file" id="resume_file" class="form-control form-control-sm" accept=".pdf,.docx">
                        </div>
                    </div>

                    <!-- Post Charge and Social Media Links -->
                    <div class="form-group row">
                        <!-- <div class="col-sm-6">
                            <span for="Emppostcharge">Post Charge:</span>
                            <input type="text" name="post_charge" id="post_charge" class="form-control form-control-sm">
                        </div> -->
                        <div class="col-sm-6">
                            <span for="Emptype">Employee Type:</span>
                            <select name="employee_type" id="employee_type" class="form-control form-control-sm" required>
                                <option value="Teaching">Teaching</option>
                                <option value="NonTeaching">Non-Teaching</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <span for="Emptype">Employee Nature:</span>
                            <select name="employee_nature" id="employee_nature" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            <?php foreach ($employee_nature as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <span for="Emptwitterlink">Twitter:</span>
                            <input type="url" name="twitter" id="twitter" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4">
                            <span for="Empfacebooklink">Facebook:</span>
                            <input type="url" name="facebook" id="facebook" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4">
                            <span for="Emplinkdinlink">LinkedIn:</span>
                            <input type="url" name="linkedin" id="linkedin" class="form-control form-control-sm">
                        </div>
                    </div>

                    <!-- Research Details and Indexes -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <span for="Researchinterest">Research Interest:</span>
                            <textarea name="research" id="editor" class="form-control form-control-sm" rows="3"></textarea>
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Googlehindex">Google H-Index:</span>
                            <input type="text" name="google_h_index" id="google_h_index" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="I10index">i10-Index:</span>
                            <input type="text" name="i10_index" id="i10_index" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Scopushindex">Scopus H-Index:</span>
                            <input type="text" name="scopus_h_index" id="scopus_h_index" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Research Gate Id:</span>
                            <input type="text" name="research_gate_id" id="research_gate_id" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Orcid Id:</span>
                            <input type="text" name="orcid_id" id="orcid_id" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Google Scholar Id:</span>
                            <input type="text" name="google_scholar_id" id="google_scholar_id" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Vidwan:</span>
                            <input type="text" name="vidwan" id="vidwan" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <div class="form-group">
                                <span>Employee Status</span>
                                <select name="employee_status" id="employee_status" class="form-control form-control-sm">
                                    <option value="">--Select--</option>
                                    <option value="Working">Working</option>
                                    <option value="Suspend">Suspend</option>
                                    <option value="Retired">Retired</option>
                                    <option value="Any Other">Any Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Scopushindex">Relieving Date:</span>
                            <input type="date" name="releiving_date" id="releiving_date" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <div class="form-group">
                                <span>Status</span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1">Active</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

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
                                <td>Files</td>
                                <td>Emp. ID</td>
                                <td>Name</td>
                                <td>Off. Email</td>
                                <td>Phone</td>
                                <td>Designation</td>
                                <td>Department</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <img src="<?= base_url() ?>public/admin/uploads/employee/<?= $value['profile_photo'] ?>" alt="" height="30px" width="30px">
                                        <?php if ($value['authority'] !== "admin") { ?><a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['resume_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/cv.png" height="30px"></a><?php } ?>
                                    </td>
                                    <td><?= $value['employee_unique_id'] ?></td>
                                    <td><?= $value['sir_name'] . " " .$value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></td>
                                    <td><?= $value['official_mail'] ?></td>
                                    <td><?php if ($value['authority'] !== "admin") { ?> <?= $value['mobile_no'] ?> <?php } else {
                                                                                                                echo "_____";
                                                                                                            } ?></td>
                                    <td><?php $designations = $designation_model->get($value['designation_id']);
                                        echo (!empty($designations['name'])) ? $designations['name'] : '____';  ?></td>
                                    <td>
                                        <?php
                                            $dept_id = explode(',',$value['department_id']);
                                            foreach ($dept_id as $key => $ids) {
                                                $department = $department_model->get($ids);
                                                echo (!empty($department['name'])) ? '<i class="fa fa-angle-right"></i> '. $department['name'] : '____';
                                                echo "<br>";
                                            }

                                        ?>
                                    </td>
                                    <td><?= $value['created_at'] ?></td>
                                    <td>
                                        <?php if ($value['authority'] !== "admin") { ?>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <a href="<?= base_url() ?>admin/employee-details/<?= $value['id'] ?>" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                                <a href="<?= base_url() ?>admin/edit-employee/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                                <a href="<?= base_url() ?>admin/delete-employee/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        <?php } ?>
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

<script>
    // JavaScript to handle the condition for enabling/disabling the EWS checkbox
    document.getElementById('caste').addEventListener('change', function() {
        var caste = this.value;
        var ewsGroup = document.getElementById('ews-group');

        if (caste === 'General') {
            ewsGroup.style.display = 'block'; // Show the EWS checkbox
        } else {
            ewsGroup.style.display = 'none'; // Hide the EWS checkbox
        }
    });
</script>

<?= $this->endSection() ?>