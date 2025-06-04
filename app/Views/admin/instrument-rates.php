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
                <form action="<?= base_url() ?>admin/instrument-rates" method="post">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Instrument ID:</span>
                        <select name="instrument_id" id="instrument_id" class="form-control form-control-sm" required>
                            <option value="">--Select--</option>
                        <?php foreach ($instruments as $instrument): ?>
                            <option value="<?= $instrument['id'] ?>"><?= $instrument['title'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Recruiter Description -->
                    <div class="form-group">
                        <span>Experiment name:</span>
                        <textarea type="text" name="experiment_names" id="editor" class="form-control form-control-sm"></textarea>
                    </div>

                    <!-- Recruiter Image Upload -->
                    <div class="form-group">
                        <span for="govt_rate">Govt Rate:</span>
                        <input type="text" name="govt_rate" id="govt_rate" class="form-control form-control-sm" required>
                    </div>

                    <div class="form-group">
                        <span for="govt_rate">Industry/private Rate:</span>
                        <input type="text" name="industry_rate" id="industry_rate" class="form-control form-control-sm" required>
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
                                <td>Instrument name</td>
                                <td>Experiment name</td>
                                <td>Govt Rate</td>
                                <td>Industry Rate</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($instrument_rates as $instrument_rate): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?php $instrument = $Instruments_model->get($instrument_rate['instrument_id']); echo !empty($instrument['title']) ? $instrument['title'] : '___';   ?></td>
                                <td><?= $instrument_rate['experiment_name'] ?></td>
                                <td><?= $instrument_rate['govt_rate'] ?></td>
                                <td><?= $instrument_rate['industry_rate'] ?></td>
                                <td><?php $emp = $employee_model->get($instrument_rate['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>