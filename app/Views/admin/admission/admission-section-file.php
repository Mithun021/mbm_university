<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Admission_page_section_model;
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
    $admission_page_section_model = new Admission_page_section_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Admission Section File Upload</h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/admission-section-file" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Section ID<span class="text-danger">*</span></span>
                        <select name="section_id" class="form-control form-control-sm" required>
                        <option value="">--Select--</option>
                        <?php foreach ($admission as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['section_title'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>File Title<span class="text-danger">*</span></span>
                        <input type="text" name="file_title" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span>File Description</span>
                        <textarea name="file_description" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <span>File Upload</span>
                        <input type="file" class="form-control form-control-sm" name="file_upload" accept=".jpg, .png, .pdf" required>
                    </div>
                    <div class="form-group">
                        <span>File Notification Date</span>
                        <input type="date" name="file_notification_date" class="form-control form-control-sm">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Admission Page Section List</h4>
            </div>
            <div class="card-body p-2">
                <table  class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>File</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Notification Date</td>
                            <td>Upload By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($admission_section_file as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                            <?php if (!empty($value['file_upload']) && file_exists('public/admin/uploads/admission/' . $value['file_upload'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/admission/<?= $value['file_upload'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/admission/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                            </td>
                            <td><?= $admission_page_section_model->get($value['section_id'])['section_title'] ?? '' ?></td>
                            <td><?= $value['file_title'] ?></td>
                            <td><?= $value['file_description'] ?></td>
                            <td><?= $value['file_notification_date'] ?></td>
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

<?= $this->endSection() ?>