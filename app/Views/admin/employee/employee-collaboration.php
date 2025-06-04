<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-collaboration" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Title of collaboration</span>
                            <input type="text" class="form-control form-control-sm" name="title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name of Collaborative Agency</span>
                            <input type="text" class="form-control form-control-sm my-select" name="collaborative_agency" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Year of Collaboration</span>
                            <select name="collaboration_year" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Duration in months</span>
                            <input type="text" class="form-control form-control-sm my-select" name="duartion_in_month" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name of Activity</span>
                            <input type="text" class="form-control form-control-sm my-select" name="name_of_activity" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>File upload (pdf)</span>
                            <input type="file" class="form-control form-control-sm my-select" name="file_upload" accept=".pdf">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">List of <?= $title ?></h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Employee</td>
                                <td>Title</td>
                                <td>Collaborative Agency</td>
                                <td>Collaboration Year</td>
                                <td>Duration in Month</td>
                                <td>Name of Activity</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_collaboration as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/employee/' . $value['file_upload'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/employee/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/employee/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['collaborative_agency'] ?></td>
                                    <td><?= $value['collaboration_year'] ?></td>
                                    <td><?= $value['duartion_in_month'] ?></td>
                                    <td><?= $value['name_of_activity'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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
<?= $this->endSection() ?>