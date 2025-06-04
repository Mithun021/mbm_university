<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Job_detail_model;
use App\Models\Employee_model;
use App\Models\Result_category_model;

$job_detail_model = new Job_detail_model();
$employee_model = new Employee_model();
$result_category_model = new Result_category_model();
?>
<style>
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form action="<?= base_url() ?>admin/job-result" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="advid">Advertisement ID:</span>
                                <select name="advid" id="advid" class="form-control form-control-sm">
                                    <option value="">Select Advertisement</option>
                                    <?php foreach ($job_details as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="resultitle">Result Title:</span>
                                <input type="text" name="resultitle" id="resultitle" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span>Result Description:</span>
                                <textarea name="resultdesc" id="editor" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resultfile">Result File Upload:</span>
                                <input type="file" name="resultfile" id="resultfile" class="form-control form-control-sm">
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <span for="resultfile">Corrigendum:</span>
                                <input type="text" name="corrigendum" id="corrigendum" class="form-control form-control-sm">
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="resulttype">Result Type:</span>
                                <select name="resulttype" id="resulttype" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                <?php foreach ($result_category as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Post Code</td>
                                            <td scope="col">Post Name</td>
                                            <td scope="col">Description</td>
                                            <td scope="col">Upload File</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" id="postcode" name="postcode[]" placeholder="Post Code">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="postname" name="postname[]" placeholder="Post Name">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="description" name="description[]" placeholder="Description">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" id="upload_file" name="upload_file[]" accept=".pdf">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="result_status">Result Status:</span>
                                <select name="result_status" id="result_status" class="form-control form-control-sm" required>
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                    <option value="2">Archive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
                                <td>Status</td>
                                <td>Advestisment ID</td>
                                <td>Result Title</td>
                                <td>Result type</td>
                                <!-- <td>Corrigendum</td> -->
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($job_result as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/jobs/' . $value['file_upload'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?=
                                        ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : (($value['status'] == "2") ? "<span class='badge badge-warning badge-pill'>Archive</span>" : ""))
                                        ?>
                                    </td>
                                    <td><?php $jobs = $job_detail_model->get($value['jobs_id']);
                                        echo $jobs['title'] ?? ''; ?></td>
                                    <td><?= $value['result_title'] ?></td>
                                    <td><?= $result_category_model->get($value['result_type'])['name'] ?? '' ?></td>
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
<?= $this->endSection() ?>