<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/experience-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Designation:<span class="text-danger">*</span></span>
                                <input name="designation" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Name of Organization:<span class="text-danger">*</span></span>
                                <input name="organization_name" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Organization Type :<span class="text-danger">*</span></span>
                                <select name="organization_type" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="Central Government">Central Government</option>
                                    <option value="State Government">State Government</option>
                                    <option value="Autonomous">Autonomous</option>
                                    <option value="Private">Private</option>
                                    <option value="PSU">PSU</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Date of Joining:<span class="text-danger">*</span></span>
                                <input type="date" name="joining_date" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtitle">Date of Relieving:</span>
                                <input type="date" name="releiving_date" class="form-control form-control-sm" required>
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
                                <td>Sl No</td>
                                <td>Designation</td>
                                <td>Name of Organization</td>
                                <td>Organization Type</td>
                                <td>Date of Joining</td>
                                <td>Date of Relieving</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($student_experience): ?>
                                <?php $i = 1; foreach ($student_experience as $experience): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $experience['designation'] ?></td>
                                        <td><?= $experience['organization_name'] ?></td>
                                        <td><?= $experience['organization_type'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($experience['joining_date'])) ?></td>
                                        <td><?= date('d-m-Y', strtotime($experience['releiving_date'])) ?></td>
                                        <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $experience['file_upload'] ?>" target="_blank">View File</a></td>
                                        <td><a href="<?= base_url() ?>student/delete-experience-details/<?= $experience['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="8" class="text-center">No Records Found!</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>