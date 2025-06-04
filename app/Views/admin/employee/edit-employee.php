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
                <form action="<?= base_url() ?>admin/edit-employee/<?= $employee_id ?>" method="post" enctype="multipart/form-data">
                    <!-- Employee Name Fields -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="EmpFirstName">Employee ID:</span>
                            <input type="text" name="employee_unique_id" id="employee_unique_id" class="form-control form-control-sm" value="<?= $employee_details['employee_unique_id'] ?>" required minlength="3">
                        </div>
                        <div class="col-sm-6">
                            <span for="EmpFirstName">Joining Date:</span>
                            <input type="date" name="joining_date" id="joining_date" class="form-control form-control-sm" value="<?= $employee_details['joining_date'] ?>" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpFirstName">First Name:</span>
                            <div class="input-group">
                                <select name="sir_name" id="sir_name" class="form-control form-control-sm">
                                    <option value="Mr." <?php if($employee_details['sir_name'] == "Mr."){ echo "selected"; } ?>>Mr.</option>
                                    <option value="Mrs." <?php if($employee_details['sir_name'] == "Mrs."){ echo "selected"; } ?>>Mrs.</option>
                                    <option value="Miss." <?php if($employee_details['sir_name'] == "Miss."){ echo "selected"; } ?>>Miss.</option>
                                    <option value="Sir" <?php if($employee_details['sir_name'] == "Sir"){ echo "selected"; } ?>>Sir</option>
                                    <option value="Dr." <?php if($employee_details['sir_name'] == "Dr."){ echo "selected"; } ?>>Dr.</option>
                                </select>
                                <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="<?= $employee_details['first_name'] ?>" required minlength="3">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpMiddleName">Middle Name:</span>
                            <input type="text" name="middle_name" id="middle_name" class="form-control form-control-sm" value="<?= $employee_details['middle_name'] ?>">
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Last Name:</span>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="<?= $employee_details['last_name'] ?>" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Blood Group:</span>
                            <select name="blood_group" id="blood_group" class="form-control form-control-sm" required>
                                <option value="A+" <?php if($employee_details['bloods_group'] == "A+"){ echo "selected"; } ?>>A+</option>
                                <option value="A-" <?php if($employee_details['bloods_group'] == "A-"){ echo "selected"; } ?>>A-</option>
                                <option value="B+" <?php if($employee_details['bloods_group'] == "B+"){ echo "selected"; } ?>>B+</option>
                                <option value="B-" <?php if($employee_details['bloods_group'] == "B-"){ echo "selected"; } ?>>B-</option>
                                <option value="AB+" <?php if($employee_details['bloods_group'] == "AB+"){ echo "selected"; } ?>>AB+</option>
                                <option value="AB-" <?php if($employee_details['bloods_group'] == "AB-"){ echo "selected"; } ?>>AB-</option>
                                <option value="O+" <?php if($employee_details['bloods_group'] == "O+"){ echo "selected"; } ?>>O+</option>
                                <option value="O-" <?php if($employee_details['bloods_group'] == "O-"){ echo "selected"; } ?>>O-</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Gender:</span>
                            <select name="gender" id="gender" class="form-control form-control-sm" required>
                                <option value="Male" <?php if($employee_details['gender'] == "Male"){ echo "selected"; } ?>>Male</option>
                                <option value="Female" <?php if($employee_details['gender'] == "Female"){ echo "selected"; } ?>>Female</option>
                                <option value="Any Other" <?php if($employee_details['gender'] == "Any Other"){ echo "selected"; } ?>>Any Other</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <span for="EmpLastName">Material Status:</span>
                            <select name="material_status" id="material_status" class="form-control form-control-sm" required>
                                <option value="No" <?php if($employee_details['material_status'] == "No"){ echo "selected"; } ?>>No</option>
                                <option value="Yes" <?php if($employee_details['material_status'] == "Yes"){ echo "selected"; } ?>>Yes</option>
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
                                    <option value="<?= $value['id'] ?>" <?php if($employee_details['designation_id'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <span for="Empdepartmentid">Department:</span>
                            <?php //$selected_departments = explode(',', $employee_details['department_id']); print_r($selected_departments); ?>
                            <select name="department_id[]" id="department_id" class="form-control form-control-sm my-select" multiple required>
                                <option value="">--Select--</option>
                                <?php $selected_departments = explode(',', $employee_details['department_id']); ?>
                                <?php foreach ($departments as $key => $value) { $selected = in_array($value['id'], $selected_departments) ? 'selected' : ''; ?>
                                    <option value="<?= $value['id'] ?>" <?= $selected ?>><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <span for="Empmobile">Mobile Number:</span>
                            <input type="tel" name="mobile_no" id="mobile_no" class="form-control form-control-sm" value="<?= $employee_details['mobile_no'] ?>" required>
                        </div>
                        <div class="col-sm-4">
                            <span for="Empmobile">Alternate Mobile Number:</span>
                            <input type="tel" name="alternate_mobile_no" id="alternate_mobile_no" class="form-control form-control-sm" value="<?= $employee_details['alternate_mobile_no'] ?>">
                        </div>
                        <div class="col-sm-4">
                            <span for="Emplandlineno">Landline Number:</span>
                            <input type="tel" name="landline_no" id="landline_no" class="form-control form-control-sm" value="<?= $employee_details['landline_no'] ?>">
                        </div>
                    </div>

                    <!-- Email Fields -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="Empofficialemail">Official Email:</span>
                            <input type="email" name="official_mail" id="official_mail" class="form-control form-control-sm" value="<?= $employee_details['official_mail'] ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <span for="Emppersonalemail">Personal Email:</span>
                            <input type="email" name="personal_mail" id="personal_mail" class="form-control form-control-sm" value="<?= $employee_details['personal_mail'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <span for="Emptype">Caste:</span>
                            <select name="caste" id="caste" class="form-control form-control-sm"  onchange="toggleEWS()" required>
                                <option value="">--Select--</option>
                                <option value="General" <?php if($employee_details['caste'] == "General"){ echo "selected"; } ?>>General</option>
                                <option value="OBC" <?php if($employee_details['caste'] == "OBC"){ echo "selected"; } ?>>OBC</option>
                                <option value="SC" <?php if($employee_details['caste'] == "SC"){ echo "selected"; } ?>>SC</option>
                                <option value="ST" <?php if($employee_details['caste'] == "ST"){ echo "selected"; } ?>>ST</option>
                            </select>
                            <div class="form-group" id="ews-group" style="display: none;">
                                <span><input type="checkbox" name="ews" value="1" <?php if($employee_details['ews'] == 1){ echo "checked"; } ?>> EWS</span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <span for="Emptype">Religion:</span>
                            <select name="religion" id="religion" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <option value="Hindu" <?php if($employee_details['religion'] == "Hindu"){ echo "selected"; } ?>>Hindu</option>
                                <option value="Muslim" <?php if($employee_details['religion'] == "Muslim"){ echo "selected"; } ?>>Muslim</option>
                                <option value="Sikh" <?php if($employee_details['religion'] == "Sikh"){ echo "selected"; } ?>>Sikh</option>
                                <option value="Christian" <?php if($employee_details['religion'] == "Christian"){ echo "selected"; } ?>>Christian</option>
                            </select>
                        </div>
                    </div>
                    <!-- Photo and Resume Uploads -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <span for="Empphotoupload">Photo Upload(.pnd,.jpg,.jpeg):</span>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control form-control-sm" accept=".png,.jpg,.jpeg">
                                
                            <?php if (!empty($employee_details['profile_photo']) && file_exists('public/admin/uploads/employee/' . $employee_details['profile_photo'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <span for="Empresumeupload">Resume Upload(.pdf,.docx):</span>
                            <input type="file" name="resume_file" id="resume_file" class="form-control form-control-sm" accept=".pdf,.docx">
                            
                            <?php if (!empty($employee_details['resume_file']) && file_exists('public/admin/uploads/employee/' . $employee_details['resume_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['resume_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
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
                                <option value="Teaching" <?php if($employee_details['employee_type'] == "Teaching"){ echo "selected"; } ?>>Teaching</option>
                                <option value="NonTeaching" <?php if($employee_details['employee_type'] == "NonTeaching"){ echo "selected"; } ?>>Non-Teaching</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <span for="Emptype">Employee Nature:</span>
                            <select name="employee_nature" id="employee_nature" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                            <?php foreach ($employee_nature as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>" <?php if($employee_details['employee_nature'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <span for="Emptwitterlink">Twitter:</span>
                            <input type="url" name="twitter" id="twitter" class="form-control form-control-sm" value="<?= $employee_details['twitter'] ?>">
                        </div>
                        <div class="col-sm-4">
                            <span for="Empfacebooklink">Facebook:</span>
                            <input type="url" name="facebook" id="facebook" class="form-control form-control-sm" value="<?= $employee_details['facebook'] ?>">
                        </div>
                        <div class="col-sm-4">
                            <span for="Emplinkdinlink">LinkedIn:</span>
                            <input type="url" name="linkedin" id="linkedin" class="form-control form-control-sm" value="<?= $employee_details['linkedin'] ?>">
                        </div>
                    </div>

                    <!-- Research Details and Indexes -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <span for="Researchinterest">Research Interest:</span>
                            <textarea name="research" id="editor" class="form-control form-control-sm" rows="3"><?= $employee_details['research'] ?></textarea>
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Googlehindex">Google H-Index:</span>
                            <input type="number" name="google_h_index" id="google_h_index" class="form-control form-control-sm" value="<?= $employee_details['google_h_index'] ?>">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="I10index">i10-Index:</span>
                            <input type="number" name="i10_index" id="i10_index" class="form-control form-control-sm" value="<?= $employee_details['i10_index'] ?>">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Scopushindex">Scopus H-Index:</span>
                            <input type="number" name="scopus_h_index" id="scopus_h_index" class="form-control form-control-sm" value="<?= $employee_details['scopus_h_index'] ?>">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Research Gate Id:</span>
                            <input type="text" name="research_gate_id" id="research_gate_id" value="<?= $employee_details['research_gate_id'] ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Orcid Id:</span>
                            <input type="text" name="orcid_id" id="orcid_id" value="<?= $employee_details['orcid_id'] ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Google Scholar Id:</span>
                            <input type="text" name="google_scholar_id" id="google_scholar_id" value="<?= $employee_details['google_scholar_id'] ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-6 form-group mt-1">
                            <span for="Scopushindex">Vidwan:</span>
                            <input type="text" name="vidwan" id="vidwan" class="form-control form-control-sm" value="<?= $employee_details['vidwan'] ?>">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <div class="form-group">
                                <span>Employee Status</span>
                                <select name="employee_status" id="employee_status" class="form-control form-control-sm">
                                    <option value="">--Select--</option>
                                    <option value="Working" <?php if($employee_details['employee_status'] == "Working"){ echo "selected"; } ?>>Working</option>
                                    <option value="Suspend" <?php if($employee_details['employee_status'] == "Suspend"){ echo "selected"; } ?>>Suspend</option>
                                    <option value="Retired" <?php if($employee_details['employee_status'] == "Retired"){ echo "selected"; } ?>>Retired</option>
                                    <option value="Any Other" <?php if($employee_details['employee_status'] == "Any Other"){ echo "selected"; } ?>>Any Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <span for="Scopushindex">Relieving Date:</span>
                            <input type="date" name="releiving_date" id="releiving_date" class="form-control form-control-sm" value="<?= $employee_details['relieving_date'] ?>">
                        </div>
                        <div class="col-sm-4 form-group mt-1">
                            <div class="form-group">
                                <span>Status</span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1" <?php if($employee_details['status'] == 1){ echo "selected"; } ?>>Active</option>
                                    <option value="0" <?php if($employee_details['status'] == 0){ echo "selected"; } ?>>Draft</option>
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
                                                <a href="<?= base_url() ?>admin/delete-employee/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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
    // Function to toggle the visibility of the EWS checkbox
    function toggleEWS() {
        var caste = document.getElementById('caste').value;
        var ewsGroup = document.getElementById('ews-group');
        
        // Show EWS checkbox if caste is General
        if (caste === 'General') {
            ewsGroup.style.display = 'block';
        } else {
            ewsGroup.style.display = 'none';
        }
    }

    // Call the function on page load to set the initial state
    window.onload = function() {
        toggleEWS();
    }
</script>

<?= $this->endSection() ?>