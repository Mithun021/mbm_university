<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Module_category_model;
    $module_category_model = new Module_category_model();
    $department_model = new Department_model();
    $designation_model = new Designation_model();
?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Off. Email</td>
                                <td>Phone</td>
                                <td>Designation</td>
                                <td>Department</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employee as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></td>
                                <td><?= $value['official_mail'] ?></td>
                                <td><?= $value['mobile_no'] ?></td>
                                <td><?php $designations = $designation_model->get($value['designation_id']); echo (!empty($designations['name'])) ? $designations['name'] : '____';;  ?></td>
                                <td><?php $department = $department_model->get($value['department_id']); echo (!empty($department['name'])) ? $department['name'] : '____';;  ?></td>
                                <td><?= $value['created_at'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="<?= base_url() ?>admin/permission/<?= $value['id'] ?>" class="btn btn-dark waves-effect waves-light" target="_blank"><i class="fas fa-tag"></i></a>
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