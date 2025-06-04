<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Department_model;
    use App\Models\Employee_model;
    use App\Models\Job_category_model;

    $employee_model = new Employee_model();
    $department_model = new Department_model();
    $job_category_model = new Job_category_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body p-2">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/job-details" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Adv Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="job_title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Adv Desription</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv reference no<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="reference_no" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv Apply Link<span class="text-danger">*</span></span>
                                <input type="url" class="form-control form-control-sm" name="apply_link" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Adv Type<span class="text-danger">*</span></span>
                                <select name="adv_type" id="adv_type" class="form-control form-control-sm" required>
                                    <option value="" selected>Select Anyone</option>
                                    <?php foreach ($job_category as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <span>Department<span class="text-danger">*</span></span>
                                <select name="department" id="department" class="form-control form-control-sm" required>
                                    <option value="" selected>Select Anyone</option>
                                    <?php foreach ($department as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Application Start Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="application_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="application_start_time" placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Application End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="application_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="application_end_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Hardcopy Last Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="hardcopy_last_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="hardcopy_last_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised application last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_app_last_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Revised hardcopy last datetime<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="revised_copy_last_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Payment Link<span class="text-danger">*</span></span>
                                <input type="url" class="form-control form-control-sm" name="payment_link" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Adv file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="adv_file" accept=".jpg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Syllabus file upload(JPG,PNG,PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="syllabus_file" accept=".jpg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Job Status<span class="text-danger">*</span></span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" selected>Draft</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header p-2">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Adv File / Syllabus</td>
                                <td>Status</td>
                                <td>Adv Title</td>
                                <td>App. Date & Time</td>
                                <td>Adv type</td>
                                <!-- <td>Department</td> -->
                                <td>Hardcopy Last Date Time</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($job_details as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['adv_file']) && file_exists('public/admin/uploads/jobs/' . $value['adv_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $value['adv_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>

                                    <?php if (!empty($value['syllabus_file']) && file_exists('public/admin/uploads/jobs/' . $value['syllabus_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/jobs/<?= $value['syllabus_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/jobs/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= 
                                        ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" :
                                        (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "")
                                    ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= date("d:M:Y", strtotime($value['application_start_date'])) ?> <?= date("h:i A", strtotime($value['application_start_time'])) ?> - <br><?= date("d:M:Y", strtotime($value['application_end_date'])) ?> <?= date("h:i A", strtotime($value['application_end_time'])) ?></td>

                                <td><?php $job_cat = $job_category_model->get($value['job_type_id']); echo $job_cat['name'] ?? ''; ?></td>
                                <!-- <td><?php ""//$department = $department_model->get($value['department_id']); echo $department['name'] ?? ''; ?></td> -->
                                <td><?= date("d:M:Y", strtotime($value['hardcopy_last_date'])) ?> <?= date("h:i A", strtotime($value['hardcopy_last_time'])) ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
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