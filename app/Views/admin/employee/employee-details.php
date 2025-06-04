<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Designation_model;

$department_model = new Department_model();
$designation_model = new Designation_model();
?>
<style>
    .nav-tabs-wrapper {
        overflow-x: auto;
        /* Enables horizontal scrolling */
        white-space: nowrap;
        /* Prevents wrapping to multiple lines */
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling on mobile */
        border-bottom: 1px solid #ddd;
        /* Optional border */
    }

    .nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        /* Prevents wrapping */
    }

    .nav-item {
        flex-shrink: 0;
        /* Prevents items from shrinking */
    }

    /* Optional: Hide scrollbar in Webkit browsers */
    .nav-tabs-wrapper::-webkit-scrollbar {
        display: none;
    }

    .emp-info{
        display: flex;
        justify-content: space-between;
        padding-left: 10px;
        padding-bottom: 5px;
        width: 100%;
        margin-bottom: 0px;
    }
    .emp-info p{
        margin: 0px;
    }
    .emp-info div:first-child{
        width: 30%;
        display: flex;
        justify-content: space-between;
    }
    .emp-info div:first-child p{
        font-weight: 500;
        color: #000;
    }
    .emp-info div:last-child{
        width: 70%;
        margin-left: 10px;
    }
    @media(max-width : 552px){
        .emp-info{
            flex-direction: column;
        }
        .emp-info div:first-child{
            width: 100%;
        }
        .emp-info div:last-child{
            width: 100%;
        }
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#projects" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#publications" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Publications</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#awards" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Awards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#booksChapter" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Books Chapter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#patents" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Patents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#academicDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#otherAcademic" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Other Academic Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#phdDetail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">PHD Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#mphil" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">MPhil/PG/UG</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#ongoingPHD" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Ongoing PHD</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#courseTought" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Course Taught</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#membership" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                <span class="d-none d-lg-block">Membership/Fellowship</span>
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="tab-content mt-3">
                    <div class="tab-pane show active" id="profile1">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div class="text-center">
                                    <?php if (!empty($employee_details['profile_photo']) && file_exists('public/admin/uploads/employee/' . $employee_details['profile_photo'])): ?>
                                        <center><img src="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['profile_photo'] ?>" alt="" class="d-flex align-self-center avatar-lg rounded mr-3 border p-1" height="110px"></center>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="110px">
                                    <?php endif; ?>
                                    <h4 class="mb-0 mt-1"><?= $employee_details['sir_name'] . " " . $employee_details['first_name'] . " " . $employee_details['middle_name'] . " " . $employee_details['last_name'] ?></h4>
                                    <p class="text-muted m-0">Emp. ID : <?= $employee_details['employee_unique_id'] ?></p>
                                    <p class="text-primary my-1"><?php $designations = $designation_model->get($employee_details['designation_id']);
                                                                    echo (!empty($designations['name'])) ? $designations['name'] : '____';  ?></p>
                                    <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $employee_details['resume_file'] ?>" class="btn btn-outline-success btn-rounded waves-effect waves-light"><i class="mdi mdi-cloud-download-outline"></i> Download Resume</a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="emp-info">
                                    <div><p class="text-bold">Account Status</p><p>:</p></div>
                                    <div><?= ($employee_details['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($employee_details['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Joining Date</p><p>:</p></div>
                                    <div><p><?= $employee_details['joining_date'] ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold m-0">Blood Group</p><p>:</p></div>
                                    <div><p><?= $employee_details['bloods_group'] ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Gender</p><p>:</p></div>
                                    <div><p><?= $employee_details['gender'] ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Material Status</p><p>:</p></div>
                                    <div><p><?= $employee_details['material_status'] ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Department</p><p>:</p></div>
                                    <div><p><?php $department = explode(',',$employee_details['department_id']); 
                                        foreach ($department as $key => $dept_id) {
                                            $departments = $department_model->get($dept_id);
                                            echo (!empty($departments['name'])) ? $departments['name'] : '____';
                                            echo ($key == count($department)-1) ? '' : ', ';
                                        }
                                    ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Mobile Number</p><p>:</p></div>
                                    <div><p><?= $employee_details['mobile_no'] ?> / <?= $employee_details['landline_no'] ?></p></div>
                                </div>
                                <div class="emp-info">
                                    <div><p class="text-bold">Email Address</p><p>:</p></div>
                                    <div><p><?= $employee_details['official_mail'] ?> / <?= $employee_details['personal_mail'] ?></p></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-1 m-0">
                            <div class="col-lg-6">
                                <div class="card card-body p-2">
                                    <div class="emp-info">
                                        <div><p class="text-bold">Employee Type</p><p>:</p></div>
                                        <div><p><?= $employee_details['employee_type'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Employee Nature</p><p>:</p></div>
                                        <div><p><?= $employee_details['employee_nature'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Twitter</p><p>:</p></div>
                                        <div><p><?= $employee_details['twitter'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Facebook</p><p>:</p></div>
                                        <div><p><?= $employee_details['facebook'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">LinkedIn</p><p>:</p></div>
                                        <div><p><?= $employee_details['linkedin'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Employee Status</p><p>:</p></div>
                                        <div><p><?= $employee_details['employee_status'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Relieving Date</p><p>:</p></div>
                                        <div><p><?= $employee_details['relieving_date'] ?></p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card card-body p-2">
                                    <div class="emp-info">
                                        <div><p class="text-bold">Google H-Index</p><p>:</p></div>
                                        <div><p><?= $employee_details['google_h_index'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">i10-Index</p><p>:</p></div>
                                        <div><p><?= $employee_details['i10_index'] ?></p></div>
                                    </div>
                                    <div class="emp-info">
                                        <div><p class="text-bold">Scopus H-Index</p><p>:</p></div>
                                        <div><p><?= $employee_details['scopus_h_index'] ?></p></div>
                                    </div>
                                    <h4 class="my-1">Research Interest</h4>
                                    <?= $employee_details['research'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="home1">
                        <p>Leggings occaecat dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                    <div class="tab-pane" id="settings1">
                        <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<?= $this->endSection() ?>