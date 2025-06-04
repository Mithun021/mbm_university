<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Facility_page_model;
    use App\Models\Facility_section_model;
    $employee_model = new Employee_model();
    $facility_page_model = new Facility_page_model();
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
                <form method="post" action="<?= base_url() ?>admin/facilty-services" enctype="multipart/form-data">
                    <div class="form-group">
                        <span>Facility Id</span>
                        <select name="facility_id" id="facility_id" class="form-control form-control-sm" required>
                            <option value="1">--Select--</option>
                        <?php foreach ($facility_page as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Secton Id</span>
                        <select name="section_id" id="section_id" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title">
                    </div>
                    <div class="form-group">
                        <span for="">Description:</span>
                        <textarea name="description" id="editor" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Web Link</span>
                        <input type="url" class="form-control form-control-sm" name="web_link">
                    </div>
                    <div class="form-group">
                        <span for="">Upload Image(JPG,PNG)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_photo" accept=".jpg, .png, .jpeg">
                    </div>
                    <div class="form-group">
                        <span for="">Upload File(JPDF)</span>
                        <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
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
                            <td>Files</td>
                            <td>Facility Id</td>
                            <td>Section Id</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Uploaded By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($facility_services as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['upload_photo']) && file_exists('public/admin/uploads/facilities/' . $value['upload_photo'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/facilities/<?= $value['upload_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/facilities/<?= $value['upload_photo'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/facilities/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>

                                <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/facilities/' . $value['upload_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/facilities/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/facilities/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?= $facility_page_model->get($value['facility_id'])['name'] ?? '' ?></td>
                            <td><?= $facility_section_model->get($value['section_id'])['title'] ?? '' ?></td>
                            <td><a href="<?= $value['web_link'] ?>" target="_blank" rel="noopener noreferrer"><?= $value['title'] ?></a></td>
                            <td><?= $value['description'] ?></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/edit-facility-services/<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                <a href="<?= base_url() ?>admin/delete-facility-services/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#facility_id').change(function() {
            var facility_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>getFacilitySection',
                type: 'post',
                data: {facility_id: facility_id},
                beforeSend: function() {
                    $('#section_id').empty();
                    $('#section_id').append('<option value="">Please wait...</option>');
                },
                success: function(response) {
                    $('#section_id').empty();
                    $('#section_id').append('<option value="">--Select--</option>');
                    $.each(response, function(index, value) {
                        $('#section_id').append('<option value="'+value.id+'">'+value.title+'</option>');
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>