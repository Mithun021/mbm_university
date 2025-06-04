<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/achievement-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubtitle">Achievement Title:<span class="text-danger">*</span></span>
                                <input name="achievement_title" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubdesc">Description:<span class="text-danger">*</span></span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Awarded Agency<span class="text-danger">*</span></span>
                                <input type="text" name="awarded_agency" id="awarded_agency" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtype">Award Level:<span class="text-danger">*</span></span>
                                <select name="award_level" id="award_level" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="National">National</option>
                                    <option value="International">International</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Award Date<span class="text-danger">*</span></span>
                                <input type="date" name="award_date" id="award_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                                <td>Title</td>
                                <td>Description</td>
                                <td>Awarded Agency</td>
                                <td>Award Level</td>
                                <td>Award Date</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($student_acchievement): ?>
                                <?php $i = 1; foreach ($student_acchievement as $achievement): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $achievement['achievement_title'] ?></td>
                                        <td><?= $achievement['description'] ?></td>
                                        <td><?= $achievement['awarded_agency'] ?></td>
                                        <td><?= $achievement['award_level'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($achievement['award_date'])) ?></td>
                                        <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $achievement['file_upload'] ?>" target="_blank">View File</a></td>
                                        <td><a href="<?= base_url() ?>student/delete-achievement-details/<?= $achievement['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
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