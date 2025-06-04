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
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/tendor-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="tendor_title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Desription</span>
                                <textarea id="editor" name="tendor_description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tender reference no</span>
                                <input type="text" class="form-control form-control-sm" name="tendor_ref_no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Bid opening date and time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="bidding_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                    <input type="text" class="form-control form-control-sm" name="bidding_time" placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tendor Start Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="tendor_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                    <input type="text" class="form-control form-control-sm" name="tendor_start_time" placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Tendor End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="tendor_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                    <input type="text" class="form-control form-control-sm" name="tendor_end_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">File(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Tendor Status</span>
                                <select name="tendor_status" id="tendor_status" class="form-control form-control-sm">
                                    <option value="Close" selected>Close</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Marquee Status</span>
                                <select name="marquee_status" id="marquee_status" class="form-control form-control-sm">
                                    <option value="0" selected>Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>Current Status</span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1">Publish</option>
                                    <option value="2">Archive</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

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
                                <td>Status</td>
                                <td>Tendor Id</td>
                                <td>Title</td>
                                <td>Bidding Date</td>
                                <td>Tendor Date</td>
                                <td>Tendor Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tendors as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/tendor/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/tendor/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/tendor/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?=
                                        ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : (($value['status'] == "2") ? "<span class='badge badge-warning badge-pill'>Archive</span>" : ""))
                                        ?> /
                                        <?= ($value['marquee_status'] == "0") ? "<span class='badge badge-danger badge-pill'>Marquee Inactive</span>" : (($value['marquee_status'] == "1") ? "<span class='badge badge-success badge-pill'>Marquee Active</span>" : "") ?>
                                    </td>
                                    <td><?= $value['tendor_ref_no'] ?></td>
                                    <td><?= $value['tendor_title'] ?></td>
                                    <td> <?= date("d:M:Y", strtotime($value['bidding_date'])) ?> <?= date("h:i A", strtotime($value['bidding_time'])) ?></td>
                                    <td>
                                        <?= date("d:M:Y", strtotime($value['tendor_start_date'])) ?>
                                        <?= date("h:i A", strtotime($value['tendor_start_time'])) ?> -
                                        <br><?= date("d:M:Y", strtotime($value['tendor_end_date'])) ?>
                                        <?= date("h:i A", strtotime($value['tendor_end_time'])) ?>
                                    </td>
                                    <td><?= $value['tendor_status'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <!-- <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td> -->
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>