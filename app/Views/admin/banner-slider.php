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
                <h4 class="card-title m-0">Slider </h4>
            </div>
            <div class="card-body p-2">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/banner-slider" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Title</span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span>Description</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="slider_file" accept=".jpg, .png, .jpeg" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Slider List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Image</td>
                            <td>Title</td>
                            <td>Upload by</td>
                            <td>Upload Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($banner_slider as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?php if (!empty($value['slider_photo']) && file_exists('public/admin/uploads/slider/' . $value['slider_photo'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/slider/<?= $value['slider_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/slider/<?= $value['slider_photo'] ?>" title="<?= $value['description'] ?>" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/slider/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $value['title'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= date('d-m-Y',strtotime($value['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/banner-slider/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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