<!-- app/Views/annualreports_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Annual Report -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Annual Report</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/annual-report" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Annual Report Title -->
                        <div class="form-group col-lg-6">
                            <span for="Annualreporttitle">Annual Report Title:</span>
                            <input type="text" name="Annualreporttitle" id="Annualreporttitle" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <span for="Annualreporttitle">Report Submit Start and End Year:</span>
                            <div class="input-group">
                                <input type="number" name="start_year" placeholder="Start Year" class="form-control form-control-sm" min="2000" maxlength="4">
                                <input type="number" name="end_year" placeholder="End Year" class="form-control form-control-sm"  min="2000" maxlength="4">
                            </div>
                        </div>

                        <!-- Annual Report Description -->
                        <div class="form-group col-lg-12">
                            <span for="Annualreportdesc">Annual Report Description:</span>
                            <textarea name="Annualreportdesc" id="editor" class="form-control form-control-sm" rows="4"></textarea>
                        </div>

                        <!-- Annual Report Photo Upload -->
                        <div class="form-group col-lg-6">
                            <span for="Annualreportphotoupload">Upload Photo .jpg,.jpeg,.png (Optional):</span>
                            <input type="file" name="Annualreportphotoupload" id="Annualreportphotoupload" class="form-control form-control-sm" accept=".jpg,.jpeg,.png">
                        </div>

                        <!-- Annual Report File Upload -->
                        <div class="form-group col-lg-6">
                            <span for="Annualreportfileupload">Upload Report File(.pdf):</span>
                            <input type="file" name="Annualreportfileupload" id="Annualreportfileupload" class="form-control form-control-sm" accept=".pdf" required>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Annual Reports (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Annual Reports List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Report Title</td>
                                <td>Report Submit Year</td>
                                <td>Description</td>
                                <td>File</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($annual_report as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['start_year']. " - ". $value['end_year'] ?></td>
                                    <td><?= $value['description'] ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_photo']) && file_exists('public/admin/uploads/annual_report/' . $value['upload_photo'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/annual_report/<?= $value['upload_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/annual_report/<?= $value['upload_photo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/annual_report/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/annual_report/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/annual_report/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/annual_report/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/annual-report/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/annual-report/<?= $value['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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