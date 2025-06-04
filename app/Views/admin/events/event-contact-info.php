<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php

use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Events_model;
$employee_model = new Employee_model();
$events_model = new Events_model();
$designation_model = new Designation_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/event-contact-info') ?>">
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" id="event_id" class="form-control form-control-sm my-select" required>
                            <option value="">Select Event</option>
                            <?php foreach ($events as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="name" required>
                    </div>
                    <div class="form-group">
                        <span for="">Email<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="email" required>
                    </div>
                    <div class="form-group">
                        <span for="">Phone<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="phone" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <span for="">Designation<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm my-select" name="designation" required>
                            <option value="">--Select--</option>
                        <?php foreach ($designation as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
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
                            <td>Event</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Designation</td>
                            <td>Upload By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($events_contact as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $events_model->get($value['event_id'])['title'] ?? '' ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['phone_number'] ?></td>
                            <td><?= $designation_model->get($value['designation'])['name'] ?? '' ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit-event-contact-info/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('admin/delete-event-contact-info/'.$value['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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