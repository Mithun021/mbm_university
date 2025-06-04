<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Instruments_model;
    $employee_model = new Employee_model();
    $Instruments_model = new Instruments_model();
?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/private-research-labs" method="post" enctype="multipart/form-data">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Research Lab Title<span class="text-danger">*</span>:</span>
                        <input type="text" name="researchtitle" id="researchtitle" class="form-control form-control-sm" required>
                    </div>

                    <!-- research Description -->
                    <div class="form-group">
                        <span for="researchdsc">Research Lab Description:</span>
                        <textarea name="researchdsc" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <!-- Recruiter Image Upload -->
                    <div class="form-group">
                        <span for="Recruiterimage">Upload Image(.jpg,.jpeg,.png)<span class="text-danger">*</span>:</span>
                        <input type="file" name="researchimage" id="Recruiterimage" class="form-control form-control-sm" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <!-- Recruiter Image Upload -->
                    <div class="form-group">
                        <span for="Recruiterimage">Upload Instrument File(.pdf):</span>
                        <input type="file" name="researchFile" id="Recruiterimage" class="form-control form-control-sm" accept=".pdf">
                    </div>

                     <!-- Recruiter Title -->
                     <div class="form-group">
                        <span for="instrument_id">Instrument ID<span class="text-danger">*</span>:</span>
                        <select name="instrument_id" id="instrument_id" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                        <?php foreach ($instruments as $instrument): ?>
                            <option value="<?= $instrument['id'] ?>"><?= $instrument['title'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Recruiter Details (Optional) -->
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
                                <td>File</td>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Instrument</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($private_research_labs as $key => $value) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?php if (!empty($value['upload_photo']) && file_exists('public/admin/uploads/private_research/' . $value['upload_photo'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/private_research/<?= $value['upload_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/private_research/<?= $value['upload_photo'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/private_research/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>

                                    <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/private_research/' . $value['upload_file'])): ?>
                                        <a href="<?= base_url() ?>public/admin/uploads/private_research/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/admin/uploads/private_research/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $value['description'] ?></td>
                                <td><?php $instrument = $Instruments_model->get($value['instrument_id']); echo !empty($instrument['title']) ? $instrument['title'] : '___';   ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
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