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
                <h4 class="card-title m-0">Testimonial </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form action="<?= base_url() ?>admin/testimonial" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="name">
                    </div>
                    <div class="form-group">
                        <span for="">Designation<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="designation">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="userphoto" accept=".jpg, .png" required>
                    </div>

                    <div class="form-group">
                        <span for="">Feedback</span>
                        <textarea id="editor" name="feedback"></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Testimonial List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Files</td>
                            <td>Name</td>
                            <td>Designation</td>
                            <td>Feedback</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($testimonial as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/testimonials/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/testimonials/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/testimonials/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/testimonials/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['designition'] ?></td>
                            <td><?= $value['feedback'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
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