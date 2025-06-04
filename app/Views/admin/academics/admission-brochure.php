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
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/admission-brochure" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" required minlength="5">
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Brochure (pdf)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
                        </div>
                        <div class="form-group col-lg-12">
                            <span for="">Short desc</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Btach Start year</span>
                            <select class="form-control form-control-sm my-select" name="start_year" required>
                            <?php  for ($i=2000; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="">Batch End Year</span>
                            <select class="form-control form-control-sm my-select" name="end_year" required>
                            <?php for ($i=2000; $i <= date('Y') + 5; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }?>
                            </select>
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
                                <td>Files</td>
                                <td>Title</td>
                                <td>Desc</td>
                                <td>Batch</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($admission_brochure as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/brochure/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/brochure/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/brochure/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $value['description'] ?></td>
                                <td><?= $value['start_batch']." -".$value['end_batch'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
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