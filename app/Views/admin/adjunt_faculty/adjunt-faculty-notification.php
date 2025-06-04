<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

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
                <form method="post" action="<?= base_url('admin/adjunt-faculty-notification') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="notification_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="notification_description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Date<span class="text-danger">*</span></span>
                        <input type="date" class="form-control form-control-sm" name="notification_date" required>
                    </div>
                    <div class="form-group">
                        <span for="">File Upload (PDF, Mandatory)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="notification_file" accept="application/pdf" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="notification_marquee" value="1">
                        <span for="">Display as Marquee</span>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
                    <table class="table table-striped table-hover" id="notification-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Date</td>
                                <td>File</td>
                                <td>Marquee</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($adjunt_faculty_notification as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['notification_title'] ?></td>
                                <td><?= $value['notification_description'] ?></td>
                                <td><?= $value['notification_date'] ?></td>
                                <td>
                                <?php if (!empty($value['notification_file']) && file_exists('public/admin/uploads/adjunt_faculty/' . $value['notification_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/adjunt_faculty/<?= $value['notification_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/adjunt_faculty/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                </td>
                                <td><?= $value['notification_marquee'] == 1 ? 'Yes' : 'No' ?></td>
                                <td>
                                    <a href="<?= base_url('admin/adjunt-faculty-notification/' . $value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url('admin/adjunt-faculty-notification/' . $value['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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
