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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/media" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Media Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="media_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="media_photo" accept=".jpg, .png, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="media_file" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="mediadesc" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <span>Publish Date</span>
                        <input type="date" name="publish_date" class="form-control form-control-sm">
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
                            <td>Title</td>
                            <td>Files</td>
                            <td>Publish Date</td>
                            <td>Uploaded By</td>
                            <td>Create at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($media as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value['title'] ?></td>
                            <td>
                                <?php if (!empty($value['photo_image']) && file_exists('public/admin/uploads/media/' . $value['photo_image'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/media/<?= $value['photo_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/media/<?= $value['photo_image'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/media/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>

                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/media/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/media/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/media/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $value['publish_date'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= $value['created_at'] ?></td>
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