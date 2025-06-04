<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
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
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/form-details" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Form Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="name" required minlength="3">
                    </div>
                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Form Banner Image(Png, Jpeg)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="upload_file" required accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="form-group">
                        <span for="">Publish Date<span class="text-danger">*</span></span>
                        <input type="date" class="form-control form-control-sm" name="publish_date" required>
                    </div>
                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="1">Accepting</option>
                            <option value="0">Not Accepting</option>
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
            <div class="card-body p-2">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Banner</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Publish Date</td>
                            <td>Status</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($form_details as $key => $value) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                            <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/dynamicForm/' . $value['upload_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/dynamicForm/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/dynamicForm/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/dynamicForm/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                            </td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['description'] ?></td>
                            <td><?= $value['publish_date'] ?></td>
                            <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Not Accepting</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Accepting</span>" : "") ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; } ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
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