<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<style>
    
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add New Video</h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/adjunt-faculty-video') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="video_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Description (Optional)</span>
                        <textarea class="form-control form-control-sm" name="video_description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Video Upload<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="video_file" accept="video/*" required>
                    </div>
                    <div class="form-group">
                        <span for="">Venue (Optional)</span>
                        <input type="text" class="form-control form-control-sm" name="video_venue">
                    </div>
                    <div class="form-group">
                        <span for="">Date and Time (Optional)</span>
                        <input type="datetime-local" class="form-control form-control-sm" name="video_datetime">
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Video List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="video-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Video</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Venue</td>
                                <td>Date & Time</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($adjunt_faculty_video as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $value['video_file'] ?>" target="_blank"><i class="far fa-file-video" aria-hidden="true"></i></a></td>
                                <td><?= $value['video_title'] ?></td>
                                <td><?= $value['video_description'] ?></td>
                                <td><?= $value['video_venue'] ?></td>
                                <td><?= $value['video_datetime'] ?></td>
                                <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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
