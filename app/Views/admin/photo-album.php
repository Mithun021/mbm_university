<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<?php
use App\Models\Photo_album_file_model;
$photo_album_file_model = new Photo_album_file_model();
use App\Models\Employee_model;
$employee_model = new Employee_model();
?>
<style>
    
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-5">
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
                <form  action="<?= base_url() ?>admin/photo-album" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Image Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="album_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,JPEG)</span>
                        <input type="file" class="form-control form-control-sm" name="album_file[]" accept=".jpg, .png, .jpeg" required multiple>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
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
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($albums as $key => $value){ ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value['album_title'] ?></td>
                            <td>
                                <?php
                                    $albums = $photo_album_file_model->getByAlbumId($value['id']);
                                    foreach ($albums as $key => $files) {
                                        if($value['id'] == $files['album_id']){
                                ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/album/<?= $files['file_name'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/album/<?= $files['file_name'] ?>" alt="<?= $value['album_title'] ?>" height="40px"></a>
                                <?php
                                        }
                                    }
                                ?>
                            </td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
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