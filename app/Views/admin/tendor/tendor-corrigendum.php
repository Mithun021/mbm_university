<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<?php
use App\Models\Employee_model;
use App\Models\Tendor_model;
$employee_model = new Employee_model();
$tendor_model = new Tendor_model();
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
                <form method="post" action="<?= base_url() ?>admin/tendor-corrigendum" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <span for="">Tendor Id<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="tendor_id" id="tendor_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($tendors as $key => $value) { ?>
                           <option value="<?= $value['id'] ?>"><?= $value['tendor_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Corrigendum Number<span class="text-danger">*</span></span>
                        <input type="text" name="corrigendum_number" class="form-control form-control-sm" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">Corrigendum Date<span class="text-danger">*</span></span>
                        <input type="date" name="corrigendum_date" class="form-control form-control-sm" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">File Upload(.pdf)<span class="text-danger">*</span></span>
                        <input type="file" name="file_upload" class="form-control form-control-sm" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">File Upload Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="file_description" id="editor3"></textarea>
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
                                <td>File</td>
                                <td>Description</td>
                                <td>Tendor id</td>
                                <td>Corrigendum Number</td>
                                <td>Corrigendum Date</td>
                                <td>Create at</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tendor_corrigendum as $key => $value) {  ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/tendor/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/tendor/<?= $value['upload_file'] ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?= strip_tags($value['file_decription']) ?>"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/tendor/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['file_decription'] ?></td>
                                <td><?php $tendor = $tendor_model->get($value['tendor_id']); echo $tendor['tendor_title'] ?? ''  ?></td>
                                <td><?= $value['corrigendum_number'] ?></td>
                                <td><?= $value['corrigendum_date'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td><?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
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