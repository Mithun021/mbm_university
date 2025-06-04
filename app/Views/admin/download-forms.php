<!-- app/Views/downloadforms_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Download Form -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Download Form</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/download-forms" method="post" enctype="multipart/form-data">
                    
                    <!-- Form Title -->
                    <div class="form-group">
                        <span for="Formtitle">Form Title:</span>
                        <input type="text" name="Formtitle" id="Formtitle" class="form-control form-control-sm" required form="<?= esc(old('Formtitle')) ?>">
                    </div>

                    <!-- Form Description -->
                    <div class="form-group mt-3">
                        <span for="Formdesc">Form Description:</span>
                        <textarea name="Formdesc" id="editor" class="form-control form-control-sm" rows="4"><?= esc(old('Formdesc')) ?></textarea>
                    </div>

                    <!-- Form File Upload -->
                    <div class="form-group mt-3">
                        <span for="Formfileupload">Upload Form File:</span>
                        <input type="file" name="Formfileupload" id="Formfileupload" class="form-control form-control-sm" accept=".pdf,.docx,.xlsx,.zip,.rar" required>
                    </div>

                    <!-- Form Status -->
                    <div class="form-group mt-3">
                        <span for="Formstatus">Form Status:</span>
                        <select name="Formstatus" id="Formstatus" class="form-control form-control-sm" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Download Forms (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Download Forms List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Form Title</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($download_forms): ?>
                                <?php foreach ($download_forms as $key => $form): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td>
                                        <?php if (!empty($form['upload_file']) && file_exists('public/admin/uploads/forms/' . $form['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/forms/<?= $form['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/forms/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                        </td>
                                        <td><?= $form['title'] ?></td>
                                        <td><?= $form['description'] ?></td>
                                        <td><?= ($form['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($form['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/download-forms/<?= $form['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="<?= base_url() ?>admin/download-forms/<?= $form['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>