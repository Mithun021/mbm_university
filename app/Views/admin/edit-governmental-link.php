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
                <form method="post" action="<?= base_url() ?>admin/edit-governmental-link/<?= $government_link_id ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title" value="<?= $governmental_link_detail['title'] ?>">
                    </div>
                    <div class="form-group">
                        <span for="">Web URL<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="web_url" value="<?= $governmental_link_detail['web_url'] ?>">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="upload_file" accept=".jpg, .png, .jpeg">
                        <img src="<?= base_url() ?>public/admin/uploads/government_link/<?= $governmental_link_detail['upload_image'] ?>" alt="" style="width: auto; height: 40px;">
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
                            <td>Image</td>
                            <td>Title</td>
                            <td>Uploaded By</td>
                            <td>Create at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($governmental_link as $key => $value) { ?>
                       <tr>
                            <td><?= $key+1 ?></td>
                            <td><img src="<?= base_url() ?>public/admin/uploads/government_link/<?= $value['upload_image'] ?>" alt="" style="width: auto; height: 40px;"></td>
                            <td><a href="<?= $value['web_url'] ?>" target="_blank"><?= $value['title'] ?></a></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){
                                    echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                            <td><?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/edit-governmental-link/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url() ?>admin/delete-governmental-link/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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