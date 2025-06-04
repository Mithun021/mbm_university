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
                <h4 class="card-title m-0">Youtube Video </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/youtube-link" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Youtube Video Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Youtube Video URL<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="description" id="editor" ></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Thumbnail Image(PNG,JPG)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="thumbnail" accept=".png,jpg,.jpeg" required>
                    </div>
                    <div class="form-group">
                        <span for="">Youtube Video URL<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="youtube_url" required>
                    </div>

                    <div class="form-group">
                        <span><input type="checkbox" name="featured" value="1"> Show in Front</span>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Youtube Video List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Thumbanil</td>
                            <td>Video URL</td>
                            <td>Description</td>
                            <td>Featured</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($youtube_link as $link): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <?php if (!empty($link['thumbnail']) && file_exists('public/admin/uploads/youtube/' . $link['thumbnail'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/youtube/<?= $link['thumbnail'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/youtube/<?= $link['thumbnail'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/youtube/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><a href="<?= $link['link_url'] ?>" target="_blank"><?= $link['title'] ?></a></td>
                                <td><?= $link['description'] //date('d M Y', strtotime($link['created_at'])) ?></td>
                                <td><?= ($link['featured'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($link['featured'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?></td>
                                <td><?php $emp = $employee_model->get($link['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/youtube-link/<?= $link['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url() ?>admin/youtube-link/<?= $link['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>