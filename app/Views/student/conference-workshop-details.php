<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/conference-workshop-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubtitle">Conference/ Workshop Title:<span class="text-danger">*</span></span>
                                <input name="conference_title" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span>Description<span class="text-danger">*</span></span>
                                <textarea class="form-control form-control-sm" name="description" id="editor"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Date of Conference/ workshop:<span class="text-danger">*</span></span>
                                <input type="date" name="conference_date" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Duration of Conference/ Workshop:<span class="text-danger">*</span></span>
                                <input type="text" name="conference_duration" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Paper details:<span class="text-danger">*</span></span>
                                <input type="text" name="paper_datils" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-buttons">
                    <thead>
                            <tr>
                                <td>Conference/ Workshop Title</td>
                                <td>Description</td>
                                <td>Date of Conference/workshop</td>
                                <td>Duration of Conference/ Workshop</td>
                                <td>Paper details</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($student_data as $value): ?>
                            <tr>
                                <td><?= $value['conference_title'] ?></td>
                                <td><?= $value['description'] ?></td>
                                <td><?= date('d-m-Y', strtotime($value['conference_date'])) ?></td>
                                <td><?= $value['conference_duration'] ?></td>
                                <td><?= $value['paper_datils'] ?></td>
                                <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $value['file_upload'] ?>" target="_blank">View File</a></td>
                                <td><a href="<?= base_url() ?>student/delete-conference-workshop-details/<?= $value['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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