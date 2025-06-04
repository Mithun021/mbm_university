<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Facility_section_model;
    $employee_model = new Employee_model();
    $facility_section_model = new Facility_section_model();
?>
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
                <form method="post" action="<?= base_url() ?>admin/mapping-facility-page/<?= $facilty_page_id ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Arrange Page<span class="text-danger">*</span></span>
                        <select class="form-control form-control-sm" name="page_name" required>
                            <option value="">--Select--</option>
                            <option value="Facility Services">Facility Services</option>
                            <option value="Facility Notification">Facility Notification</option>
                            <option value="Facility Banner">Facility Banner</option>
                            <option value="Facility Instruments">Facility Instruments</option>
                            <option value="Facility Section File">Facility Section File</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
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
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Facility Section</td>
                            <td>Arranged Page Name</td>
                            <td>Uploaded By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($facility_page as $key => $value) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $facility_section_model->get($value['section_id'])['title'] ?? '' ?></td>
                            <td><?= $value['page_name'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/edit-mapping-facility-page/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url() ?>admin/delete-mapping-facility-page/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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