<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Facility_page_model;
    $employee_model = new Employee_model();
    $facility_page_model = new Facility_page_model();
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
            <div class="card-body p-1">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/mapping-facility-page" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Facility Id</span>
                        <select name="facility_id" class="form-control form-control-sm" required>
                            <option value="1">--Select--</option>
                        <?php foreach ($facility_page as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Section Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <span>Section Priority<span class="text-danger">*</span></span>
                        <input type="text" name="priority" class="form-control form-control-sm" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-1">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Facility Id</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Priority</td>
                            <td>Uploaded By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($facility_section as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $facility_page_model->get($value['facility_id'])['name'] ?? '' ?></td>
                            <td><?= $value['title'] ?></td>
                            <td><?= $value['description'] ?></td>
                            <td><?= $value['priority'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/mapping-facility-page/<?= $value['id'] ?>" class="btn btn-sm btn-dark"><i class="fas fa-bars"></i></a>
                                <a href="<?= base_url() ?>admin/edit-facility-section/<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="<?= base_url() ?>admin/delete-facility-section/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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