<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    /* Add any custom styles if needed */
</style>
<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')) : ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/bog" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- BoG Title -->
                            <div class="form-group">
                                <span for="bogtitle">BoG Title:<span class="text-danger">*</span></span>
                                <input
                                    type="text"
                                    name="bogtitle"
                                    id="bogtitle"
                                    class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- BoG Description -->
                            <div class="form-group">
                                <span for="bogdesc">BoG Description:</span>
                                <textarea id="editor" name="bog_description" class="form-control form-control-sm"></textarea>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>BoG File(.pdf)</span>
                                <input type="file" name="bog_file" class="form-control form-control-sm" accept=".pdf">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>BoG Gallery</span>
                                <input type="file" name="bog_gallery[]" class="form-control form-control-sm" multiple>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- BoG Status -->
                            <div class="form-group">
                                <span for="bogstatus">BoG Status:</span>
                                <select
                                    name="bogstatus"
                                    id="bogstatus"
                                    class="form-control form-control-sm"
                                    required>
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Status</td>
                                <!-- <td>Upload by</td> -->
                                <!-- <td>Create at</td> -->
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bog as $key => $value) { ?>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/bog/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/bog/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/bog/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>