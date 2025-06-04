<!-- app/Views/rankingdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;

$employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Ranking Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Ranking Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/ranking" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Rank Year -->
                            <div class="form-group">
                                <span for="Rankyear">Ranking Type:</span>
                                <select name="ranking_type" id="ranking_type" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="NIRF">NIRF</option>
                                    <option value="ARIIA">ARIIA</option>
                                    <option value="Any other">Any other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="other_input_field" style="display: none;">
                            <div class="form-group">
                                <span for="Rankyear">Please specify other ranking type:</span>
                                <input type="text" id="other_ranking" name="other_ranking" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="Mediatitle">Description:</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Year -->
                            <div class="form-group">
                                <span for="Rankyear">Rank Year:</span>
                                <input type="number" name="ranking_year" id="ranking_year" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Source -->
                            <div class="form-group">
                                <span for="Ranksource">Ranking Category :</span>
                                <select name="ranking_category" id="ranking_category" class="form-control form-control-sm" required>
                                    <option value="" disabled selected>Select Rank Source</option>
                                    <option value="Overall">Overall</option>
                                    <option value="Pharmacy">Pharmacy</option>
                                    <option value="Any other">Any other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" id="other_category_field" style="display: none;">
                            <div class="form-group">
                                <span for="Rankyear">Please specify other ranking category:</span>
                                <input type="text" id="other_ranking_category" name="other_ranking_category" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank Number -->
                            <div class="form-group">
                                <span for="Ranknumber">Rank Number:</span>
                                <input type="number" name="ranking_number" id="ranking_number" class="form-control form-control-sm" required min="1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Rank File Upload -->
                            <div class="form-group">
                                <span for="Rankfileupload">Upload Rank File:(.pdf,.jpg,.png,.jpeg)</span>
                                <input type="file" name="upload_file" id="upload_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Data Submitted Pharmacy -->
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">Data Submitted for Pharmacy:</span>
                                <select name="datasubmittedpharmacy" id="datasubmittedpharmacy" class="form-control form-control-sm" required>
                                    <option value="Yes">Yes</option>
                                    <option value="No" selected>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" style="display: none;">
                            <!-- Data Submitted Pharmacy -->
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">File of Data Submitted for Pharmacy:</span>
                                <input type="file" name="data_submitted_file" id="data_submitted_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span for="Datasubmittedoverall">Data Submitted Overall:</span>
                                <select name="datasubmittedoverall" id="datasubmittedoverall" class="form-control form-control-sm" required>
                                    <option value="Yes">Yes</option>
                                    <option value="No" selected>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" style="display: none;">
                            <div class="form-group">
                                <span for="Datasubmittedpharmacy">File of Data Submitted Overall:</span>
                                <input type="file" name="data_submitted_overall_file" id="data_submitted_overall_file" class="form-control-file" accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Ranking Details (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Ranking Details List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Ranking Type</td>
                                <td>Rank Year</td>
                                <td>Ranking Category</td>
                                <td>Rank Number</td>
                                <td>Pharmacy Data Submitted</td>
                                <td>Overall Data Submitted</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ranking as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/ranking/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['ranking_type'] ?> <?php if ($value['other_ranking']) {
                                                                            echo " , " . $value['other_ranking'];
                                                                        } ?></td>
                                    <td><?= $value['ranking_year'] ?></td>
                                    <td><?= $value['ranking_category'] ?> <?php if ($value['other_ranking_category']) {
                                                                                echo " , " . $value['other_ranking_category'];
                                                                            } ?></td>
                                    <td><?= $value['ranking_number'] ?></td>
                                    <td><?= $value['datasubmittedpharmacy'] ?>
                                        <?php if($value['datasubmittedpharmacy'] == 'yes'){ ?>
                                        <?php if (!empty($value['pharmacy_file']) && file_exists('public/admin/uploads/ranking/' . $value['pharmacy_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['pharmacy_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?= $value['datasubmittedoverall'] ?>
                                        <?php if($value['datasubmittedoverall'] == 'yes'){ ?>
                                            <?php if (!empty($value['overall_file']) && file_exists('public/admin/uploads/ranking/' . $value['overall_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['overall_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/ranking/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                            <?php else: ?>
                                                <img src="<?= base_url() ?>public/admin/uploads/ranking/invalid_image.png" alt="" height="40px">
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
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

<script>
    document.getElementById('ranking_type').addEventListener('change', function() {
        var otherInputField = document.getElementById('other_input_field');
        if (this.value === 'Any other') {
            otherInputField.style.display = 'block';
        } else {
            otherInputField.style.display = 'none';
        }
    });

    document.getElementById('ranking_category').addEventListener('change', function() {
        var otherCatInputField = document.getElementById('other_category_field');
        if (this.value === 'Any other') {
            otherCatInputField.style.display = 'block';
        } else {
            otherCatInputField.style.display = 'none';
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        // Function to toggle file input visibility
        function toggleFileInput(selectId, fileInputId) {
            const selectElement = document.getElementById(selectId);
            const fileInputElement = document.getElementById(fileInputId);

            selectElement.addEventListener("change", function() {
                if (selectElement.value === "Yes") {
                    fileInputElement.parentElement.parentElement.style.display = "block"; // Show the file input
                } else {
                    fileInputElement.parentElement.parentElement.style.display = "none"; // Hide the file input
                }
            });
        }

        // Initialize toggling for the "Data Submitted for Pharmacy" and "Data Submitted Overall"
        toggleFileInput("datasubmittedpharmacy", "data_submitted_file");
        toggleFileInput("datasubmittedoverall", "data_submitted_overall_file");
    });
</script>

<?= $this->endSection() ?>