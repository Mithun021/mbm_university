<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Books_chapter_author;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$books_chapter_author = new Books_chapter_author();
?>
<style>
    #addServicetable #coAuthorTbody #coAuthorRow:first-child td:last-child button {
        display: none;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/emp-fellowship') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="Empid" class="form-control form-control-sm my-select" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <span for="">Membership Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="membership_title" required>
                        </div>

                        <div class="col-lg-12 form-group">
                            <span for="">Description<span class="text-danger">*</span></span>
                            <textarea class="form-control form-control-sm" name="description" id="editor" ></textarea>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Organization<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="organization" required>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Member Reg. no<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="member_reg_no" required>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Member Since</span>
                            <select class="form-control form-control-sm my-select" name="member_since">
                                <option value="">--Select--</option>
                            <?php for ($i=1998; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                            </select>
                            <span><input type="checkbox" name="current_member" id="current_member" value="1"> Current Member</span>
                        </div>
                        <div class="col-lg-4 form-group membership-end">
                            <span for="">Membership End</span>
                            <select class="form-control form-control-sm my-select" name="membership_end">
                                <option value="">--Select--</option>
                            <?php for ($i=1998; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Upload File(.pdf)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
                        </div>
                        
                        <div class="col-lg-12 form-group">
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
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Employee</td>
                                <td>Membership Title</td>
                                <td>Organization</td>
                                <td>Member Reg. no</td>
                                <td>Member Since</td>
                                <td>Membership End</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employee_fellowship as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/employee/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?php $emp = $employee_model->get($value['employee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                <td><?= $value['membership_title'] ?></td>
                                <td><?= $value['organization'] ?></td>
                                <td><?= $value['member_reg_no'] ?></td>
                                <td><?= $value['member_since'] ?></td>
                                <td><?= $value['membership_end'] ?></td>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('current_member');
    const membershipEndDiv = document.querySelector('.membership-end');

    function toggleMembershipEnd() {
        if (checkbox.checked) {
            membershipEndDiv.style.display = 'none';
        } else {
            membershipEndDiv.style.display = 'block';
        }
    }

    // Initial check on page load
    toggleMembershipEnd();

    // Event listener
    checkbox.addEventListener('change', toggleMembershipEnd);
});
</script>
<script>
    // $(document).ready(function() {
    //     var cloneLimit = 10;
    //     var currentClones = 0;
    //     $("#addnewCoAuthor").click(function(e) {
    //         e.preventDefault();
    //         if (currentClones < cloneLimit) {
    //             currentClones++;
    //             var cloneCatrow = $('#coAuthorRow').clone().appendTo('#coAuthorTbody');
    //             $(cloneCatrow).find('input').val('');
    //         }

    //     });

    //     $('#coAuthorTbody').on('click', '#removeCoAuthorrow', function() {
    //         $(this).closest('tr').remove();
    //     });

    // });
</script>

<?= $this->endSection() ?>