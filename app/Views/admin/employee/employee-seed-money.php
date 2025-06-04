<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('msg')): ?>
                    <?= session()->getFlashdata('msg') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-seed-money" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="Empid">Employee:</span>
                        <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                            <option value="">Select Employee</option>
                        <?php foreach($employee as $value){ ?>
                            <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Amount of Seed Money Received</span>
                        <input type="number" class="form-control form-control-sm" name="received_money" required>
                    </div>
                    <div class="form-group">
                        <span>Year</span>
                        <select name="years" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                            <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Duration of Grant</span>
                        <input type="text" class="form-control form-control-sm my-select" name="grant_duration" required>
                    </div>
                    <div class="form-group">
                        <span>Status </span>
                        <select class="form-control form-control-sm" name="status" required>
                            <option value="0">Ongoing</option>
                            <option value="1">Complete</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
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
                                <td>Employee</td>
                                <td>Received Money</td>
                                <td>Year</td>
                                <td>Grant Duration</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee_seed_money as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                    <td><?= $value['received_money'] ?></td>
                                    <td><?= $value['years'] ?></td>
                                    <td><?= $value['grant_duration'] ?></td>
                                    <td><?php
                                    if ($value['status'] == 0) {
                                        echo "<span class='badge badge-warning badge-pill'>Ongoing</span>";
                                    } elseif ($value['status'] == 1) {
                                        echo "<span class='badge badge-success badge-pill'>Coplete</span>";
                                    }
                                    ?></td>
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