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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>admin/placement-company-details" method="post" enctype="multipart/form-data" id="alumini-page-notification-form">
                <div class="card-body p-1">
                    <?php if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    } ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span for="title">Company Name</span>
                            <input type="text" class="form-control form-control-sm" name="company_name" id="company_name" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Logo (jpeg, png, 500kb)</span>
                            <input type="file" class="form-control form-control-sm" name="company_logo" accept=".jpg,.png,.jpeg" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Photo (jpeg, png, 500kb)</span>
                            <input type="file" class="form-control form-control-sm" name="company_photo" accept=".jpg,.png,.jpeg">
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Profile</span>
                            <input type="text" name="company_profile" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Company Website link</span>
                            <input type="url" name="company_website" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Linkedin</span>
                            <input type="url" name="linkedin" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Facebook</span>
                            <input type="url" name="facebook" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Instagram</span>
                            <input type="url" name="instagram" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <span for="title">Twitter</span>
                            <input type="url" name="twitter" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Email 1</span>
                            <input type="email" name="email_1" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Email 2</span>
                            <input type="email" name="email_2" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Helpline number 1</span>
                            <input type="tel" name="helpline_number1" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span for="title">Helpline number 2</span>
                            <input type="tel" name="helpline_number2" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Company Name</td>
                                <td>Company Profile</td>
                                <td>Website link</td>
                                <td>Linkedin</td>
                                <td>Facebook</td>
                                <td>Instagram</td>
                                <td>Twitter</td>
                                <td>Email</td>
                                <td>Helpline Number</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($company_details as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['company_logo']) && file_exists('public/admin/uploads/placement/' . $value['company_logo'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/placement/<?= $value['company_logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/placement/<?= $value['company_logo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/placement/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['company_photo']) && file_exists('public/admin/uploads/placement/' . $value['company_photo'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/placement/<?= $value['company_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/placement/<?= $value['company_photo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/placement/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['company_name'] ?></td>
                                    <td><?= $value['company_profile'] ?></td>
                                    <td><?= $value['company_website'] ?></td>
                                    <td><?= $value['linkedin'] ?></td>
                                    <td><?= $value['facebook'] ?></td>
                                    <td><?= $value['instagram'] ?></td>
                                    <td><?= $value['twitter'] ?></td>
                                    <td><?= $value['email_1'] ?> <br> <?= $value['email_2'] ?></td>
                                    <td><?= $value['helpline_number1'] ?> <br> <?= $value['helpline_number2'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-placement-company-details/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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
<?= $this->endSection() ?>