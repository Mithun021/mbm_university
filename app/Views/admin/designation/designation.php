<?= $this->extend("admin/layouts/master") ?>

<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>
<style>
    
</style>
<!-- start page title --> 
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <form method="post" action="<?= base_url() ?>admin/designation">
                    <div class="form-group">
                        <span for="">Designation Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="designation_title" required minlength="3">
                    </div>
                    <!-- <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"></textarea>
                    </div> -->
                    <div class="form-group">
                        <span for="">Designation Holds</span>
                        <select name="designation_hold" class="form-control form-control-sm">
                            <option value="Teaching">Teaching</option>
                            <option value="Non-teaching">Non-teaching</option>
                            <option value="Administrative">Administrative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Status</span>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Desig. Hold</td>
                            <td>Status</td>
                            <td>Upload by</td>
                            <td>Create at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($designation as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['designation_hold'] ?></td>
                            <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= $value['created_at'] ?></td>
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
</div>

<?= $this->endSection() ?>