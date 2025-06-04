<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/adjunt-faculty-webpage') ?>">
                    <div class="form-group">
                        <span for="">Section Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="section_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Section Description<span class="text-danger">*</span></span>
                        <textarea class="form-control form-control-sm" name="section_description" id="editor"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Section Priority<span class="text-danger">*</span></span>
                        <input type="number" class="form-control form-control-sm" name="section_priority" required>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Section List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Section Title</td>
                                <td>Section Description</td>
                                <td>Priority</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($adjunt_faculty_webpage as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['section_title'] ?></td>
                                <td><?= $value['section_description'] ?></td>
                                <td><?= $value['section_priority'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                <td>
                                    <a href="<?= base_url('admin/adjunt-faculty-webpage/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url('admin/adjunt-faculty-webpage/'.$value['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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
