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
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form action="<?= base_url() ?>admin/currecnt-session" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <span for="">Current Session<span class="text-danger">*</span></span>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm" name="session_start"  placeholder="Batch Start" maxlength="4" value="<?= $current_session['session_start'] ?>">
                            <input type="number" class="form-control form-control-sm" name="session_end"  placeholder="Batch Start" maxlength="4" value="<?= $current_session['session_end'] ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    
</div>

<?= $this->endSection() ?>