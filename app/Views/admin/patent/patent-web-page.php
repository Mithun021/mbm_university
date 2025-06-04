<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
use App\Models\Patent_webpage_file_model;

    $employee_model = new Employee_model();
    $patent_webpage_file_model = new Patent_webpage_file_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
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
                <form method="post" action="<?= base_url('admin/patent-web-page') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload Images(.Jpg,.Png,.Jpeg)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_file[]" accept=".Jpg,.Png,.Jpeg" multiple>
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
            <div class="card-body p-2">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Type</td>
                            <td>Description</td>
                            <td>Gallery Image</td>
                            <td>Upload By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($patent_webpage as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value['title'] ?></td>
                            <td><?= $value['description'] ?></td>
                            <td>
                            <?php $gallery = $patent_webpage_file_model->get_by_webpage($value['id']); if($gallery) {
                                foreach ($gallery as $key => $value2) { ?>
                                    <?php if (!empty($value2['upload_file']) && file_exists('public/admin/uploads/patent/' . $value2['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/patent/<?= $value2['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/patent/<?= $value2['upload_file'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/patent/invalid_image.png" alt="" height="30px">
                                    <?php endif; ?>
                            <?php } } ?>
                            </td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td>
                                <a href="<?= base_url('admin/event-category/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('admin/event-category/'.$value['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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