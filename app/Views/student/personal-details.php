<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/personal-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">

                        <div class="col-lg-12">
                            <!-- Student Enrollment ID -->
                            <div class="form-group">
                                <span for="Stdenrollid">Student Enrollment ID: <span class="text-danger">*</span></span>
                                <input type="text" name="Stdenrollid" id="Stdenrollid" class="form-control form-control-sm" value="<?= $studentData['enrollment_no'] ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>First Name <span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="std_first_name" value="<?= $studentData['first_name'] ?>" required minlength="3" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Middle Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_middle_name" value="<?= $studentData['middle_name'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Last Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_last_name" value="<?= $studentData['last_name'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Father's Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_father_name" value="<?= $studentData['father_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Mother's Name</span>
                                <input type="text" class="form-control form-control-sm" name="std_mother_name" value="<?= $studentData['mother_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Date of Birth</span>
                                <input type="date" class="form-control form-control-sm" name="std_date_of_birth" value="<?= $studentData['date_of_birth'] ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Blood Group</span>
                                <input type="text" class="form-control form-control-sm" name="std_blood_group" value="<?= $studentData['blood_group'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Student Email ID -->
                            <div class="form-group">
                                <span for="Stdemailid">Personal Email ID:<span class="text-danger">*</span></span>
                                <input type="email" name="std_personal_mail" id="std_personal_mail" class="form-control form-control-sm" value="<?= $studentData['personal_mail'] ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Student Email ID -->
                            <div class="form-group">
                                <span for="Stdemailid">Offical Email ID:<span class="text-danger">*</span></span>
                                <input type="email" name="std_official_mail" id="std_official_mail" class="form-control form-control-sm" value="<?= $studentData['official_mail'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Student Phone No.:<span class="text-danger">*</span></span>
                                <input type="tel" name="Stdphone" id="Stdphone" class="form-control form-control-sm" pattern="[6-9]{1}[0-9]{9}" value="<?= $studentData['phone_no'] ?>" required maxlength="10" minlength="10" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Gender:<span class="text-danger">*</span></span>
                                <select name="gender" id="gender" class="form-control form-control-sm" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?php if ($studentData['gender'] == "Male") {
                                                                echo "selected";
                                                            } ?>>Male</option>
                                    <option value="Female" <?php if ($studentData['gender'] == "Female") {
                                                                echo "selected";
                                                            } ?>>Female</option>
                                    <option value="Others" <?php if ($studentData['gender'] == "Others") {
                                                                echo "selected";
                                                            } ?>>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Permanent Address:<span class="text-danger">*</span></span>
                                <textarea name="std_permanent_address" id="std_permanent_address" class="form-control form-control-sm" required><?= $studentData['permanent_address'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Stdemailid">Correspondence Address:<span class="text-danger">*</span></span>
                                <textarea name="std_corrospondence_address" id="std_corrospondence_address" class="form-control form-control-sm" required><?= $studentData['correspondence_address'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="category">Category :<span class="text-danger">*</span></span>
                                <select name="category" id="category" class="form-control form-control-sm" required onchange="toggleEWS()">
                                    <option value="">Select Category</option>
                                    <option value="Gen" <?php if($studentData['category'] == "Gen"){ echo "selected"; } ?>>Gen</option>
                                    <option value="OBC" <?php if($studentData['category'] == "OBC"){ echo "selected"; } ?>>OBC</option>
                                    <option value="SC" <?php if($studentData['category'] == "SC"){ echo "selected"; } ?>>SC</option>
                                    <option value="ST" <?php if($studentData['category'] == "ST"){ echo "selected"; } ?>>ST</option>
                                </select>

                                <span id="ews-container" style="display: none;">
                                    <input type="checkbox" name="ews" id="ews" value="1" <?php if($studentData['ews'] == 1){ echo "checked"; } ?>> EWS
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="relegion">Religion :<span class="text-danger">*</span></span>
                                <select name="relegion" id="relegion" class="form-control form-control-sm" required onchange="toggleRelegion()">
                                    <option value="">Select Religion</option>
                                    <option value="Hindu" <?php if($studentData['relegion'] == "Hindu"){ echo "selected"; } ?>>Hindu</option>
                                    <option value="Muslim" <?php if($studentData['relegion'] == "Muslim"){ echo "selected"; } ?>>Muslim</option>
                                    <option value="Sikh" <?php if($studentData['relegion'] == "Sikh"){ echo "selected"; } ?>>Sikh</option>
                                    <option value="Christian" <?php if($studentData['relegion'] == "Christian"){ echo "selected"; } ?>>Christian</option>
                                    <option value="Other" <?php if($studentData['relegion'] == "Other"){ echo "selected"; } ?>>Other</option>
                                </select>

                                <span id="relegion-container" style="display: none;">
                                    <input type="text" name="other_relegion" id="other_relegion" class="form-control form-control-sm mt-2" placeholder="Specify Religion" value="<?php echo $studentData['other_relegion'] ?>">
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Department</span>
                                <input type="text" class="form-control form-control-sm" name="department" value="<?= $studentDataCourses['department_name'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Course</span>
                                <input type="text" class="form-control form-control-sm" name="program" value="<?= $studentDataCourses['program_name'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Semester</span>
                                <input type="text" class="form-control form-control-sm" name="semester" value="<?= $studentDataCourses['semester'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Batch</span>
                                <input type="text" class="form-control form-control-sm" name="batch" value="<?= $batchName['batch_start']." - ".$batchName['batch_end'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="relegion">Supervisor Name :<span class="text-danger">*</span></span>
                                <select name="supervisor" id="supervisor" class="form-control form-control-sm" required>
                                    <option value="">Select Supervisor</option>
                                <?php foreach ($employeeData as $emp): ?>
                                    <option value="<?= $emp['id'] ?>" <?php if($studentData['supervisor_name'] == $emp['id']){ echo "selected"; }  ?>><?= $emp['sir_name']." ".$emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>LinkedIn Id :</span>
                                <input type="text" class="form-control form-control-sm" name="linkedin_id" value="<?= $studentData['linkedin_id'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span for="relegion">State :<span class="text-danger">*</span></span>
                                <select name="state" id="state" class="form-control form-control-sm" required>
                                    <option value="">Select State</option>
                                <?php foreach ($stateData as $state): ?>
                                    <option value="<?= $state['state'] ?>" <?php if($studentData['state'] == $state['state']){ echo "selected"; }  ?>><?= $state['state'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span for="relegion">City :<span class="text-danger">*</span></span>
                                <input type="hidden" name="old_city" id="old_city" value="<?= $studentData['city'] ?>">
                                <select name="city" id="city" class="form-control form-control-sm" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Pincode :</span>
                                <input type="text" class="form-control form-control-sm" name="pincode" value="<?= $studentData['pincode'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Career Objective(max. 500 words)</span>
                                <textarea name="career_objective" class="form-control form-control-sm" maxlength="500"><?= $studentData['career_objective'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Upload Profile Image <span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="std_profile_image" accept=".png,.jpg,.jpeg">
                                <?php if (!empty($studentData['profile_image']) && file_exists('public/admin/uploads/students/' . $studentData['profile_image'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" alt="" height="40px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/students/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>Upload Signature Image <span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="std_signature_image" accept=".png,.jpg,.jpeg">
                                <?php if (!empty($studentData['signature']) && file_exists('public/admin/uploads/students/' . $studentData['signature'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['signature'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['signature'] ?>" alt="" height="40px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/students/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>

<script>

function loadCities(state, old_city = '') {
    $.ajax({
        url: '<?= base_url() ?>findcity',
        type: 'POST',
        data: { state: state },
        dataType: 'json',
        beforeSend: function() {
            $('#city').empty().append('<option value="">Loading...</option>');
        },
        success: function(response) {
            $('#city').empty().append('<option value="">Select City</option>');
            $.each(response, function(index, city) {
                let selected = (old_city === city.city) ? 'selected' : '';
                $('#city').append('<option value="' + city.city + '"' + selected + '>' + city.city + '</option>');
            });
        }
    });
}

    $(document).ready(function() {
        var selectedState = $('#state').val();
        var oldCity = $('#old_city').val();

        if (selectedState) {
            loadCities(selectedState, oldCity);
        }

        // On state change
        $('#state').change(function () {
            var state = $(this).val();
            loadCities(state, ''); // Reset old_city when user changes state
        });
        // $('#state').change(function() {
        //     var state = $(this).val();
            
        // });
    });
</script>


<script>
    function toggleEWS() {
        var category = document.getElementById("category").value;
        var ewsContainer = document.getElementById("ews-container");

        if (category === "Gen") {
            ewsContainer.style.display = "inline-block";
        } else {
            ewsContainer.style.display = "none";
            document.getElementById("ews").checked = false; // Uncheck if hidden
        }
    }

    // Call on page load to apply visibility based on pre-selected value
    document.addEventListener("DOMContentLoaded", function() {
        toggleEWS();
    });

    function toggleRelegion() {
        var selectedReligion = document.getElementById("relegion").value;
        var otherFieldContainer = document.getElementById("relegion-container");

        if (selectedReligion === "Other") {
            otherFieldContainer.style.display = "block";
        } else {
            otherFieldContainer.style.display = "none";
            document.getElementById("other_relegion").value = "";
        }
    }

    // Initialize on page load
    document.addEventListener("DOMContentLoaded", function() {
        toggleRelegion();
    });
</script>
<?= $this->endSection() ?>