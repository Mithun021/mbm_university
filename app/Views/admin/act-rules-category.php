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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('msg')) {
                    echo session()->getFlashdata('msg');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/act-rules-category">
                    <div class="form-group">
                        <span for="">Category Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="category_name" required minlength="3">
                    </div>
                    <div class="form-group">
                        <span for="Actrulesfileupload">Status<span class="text-danger">*</span></span>
                        <select name="act_status" id="act_status" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
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
                                <td>Category</td>
                                <td>Status</td>
                                <td>Create at</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($act_rules_category as $key => $value) { ?>
                                <tr>
                                    <td> <?= ++$key ?></td>
                                    <td> <?= $value['name'] ?></td>
                                    <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                    <td> <?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/bog-member/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/bog-member/delete/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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