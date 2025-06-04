<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Admission Page Section</h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/admission-page-section" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Section Title<span class="text-danger">*</span></span>
                        <input type="text" name="section_title" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <span>Section Description</span>
                        <textarea id="editor2" name="section_description"></textarea>
                    </div>
                    <div class="form-group">
                        <span>Section Image Upload</span>
                        <input type="file" class="form-control form-control-sm" name="section_image" accept=".jpg, .png" required>
                    </div>
                    <div class="form-group">
                        <span>Section Priority</span>
                        <input type="text" name="section_priority" class="form-control form-control-sm" required>
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
                            <td>Section Title</td>
                            <td>Section Description</td>
                            <td>Priority</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($admission as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                            <?php if (!empty($value['section_image']) && file_exists('public/admin/uploads/admission/' . $value['section_image'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/admission/<?= $value['section_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/admission/<?= $value['section_image'] ?>" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/admission/invalid_image.png" alt="" height="40px">
                            <?php endif; ?>
                            </td>
                            <td><?= $value['section_title'] ?></td>
                            <td><?= $value['section_description'] ?></td>
                            <td><?= $value['section_priority'] ?></td>
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