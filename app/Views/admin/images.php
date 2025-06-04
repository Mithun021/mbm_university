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
                <h4 class="card-title m-0">Image Gallery </h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form action="<?= base_url() ?>admin/images" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Image Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="image_title">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPG,PNG,PDF)</span>
                        <input type="file" class="form-control form-control-sm" name="image_file" accept=".jpg, .png, .pdf" required>
                    </div>
                    <div class="form-group">
                        <span for="">Event Date<span class="text-danger">*</span></span>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="event_start_date"  placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                            <input type="text" class="form-control form-control-sm" name="event_start_date"  placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Image Gallery List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Files</td>
                            <td>Event Date</td>
                            <td>Upload by</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($gallery as $key => $value){ ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value['image_title'] ?></td>
                            <td><a href="<?= base_url() ?>public/admin/uploads/gallery/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/gallery/<?= $value['upload_file'] ?>" alt="<?= $value['image_title'] ?>" height="40px"></a></td>
                            <td><?= $value['event_start_date']." - ".$value['event_end_date'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
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