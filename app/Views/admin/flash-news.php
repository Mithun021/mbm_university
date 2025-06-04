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
                <form method="post" action="<?= base_url() ?>admin/flash-news" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="flash_photo" accept=".jpg, .png, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="flash_file" accept=".pdf">
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="flashdesc" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <span>Publish Date<span class="text-danger">*</span></span>
                        <input type="date" name="publish_date" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span>Web Link<span class="text-danger">*</span></span>
                        <input type="url" name="web_link" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Draft</option>
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
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Files</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Publish Date</td>
                            <td>Status</td>
                            <td>Uploaded By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($flash_news as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['upload_image']) && file_exists('public/admin/uploads/flash_news/' . $value['upload_image'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/flash_news/<?= $value['upload_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/flash_news/<?= $value['upload_image'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/flash_news/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/flash_news/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/flash_news/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/flash_news/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><a href="<?php echo $value['web_link']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $value['title']; ?></a></td>
                            <td><?= $value['description'] ?></td>
                            <td><?= $value['publish_Date'] ?></td>
                            <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
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