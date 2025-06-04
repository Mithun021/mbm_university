<!-- app/Views/convocationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Convocation_session_model;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$convocation_session_model = new Convocation_session_model();
?>

<style>
    #addConvtable #convTbody #convTrow:first-child td:last-child button {
        display: none;
    }
    ul#session_list{
        margin: 0;
        padding: 0;
    }
</style>

<div class="row">
    <!-- Form Section for Adding Convocation Details -->
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
                <form action="<?= base_url() ?>admin/convocation" method="post" enctype="multipart/form-data">

                    <!-- Convocation Number -->
                    <div class="form-group">
                        <span for="Convnumber">Convocation Title:<span class="text-danger">*</span></span>
                        <input type="text" name="conv_title" id="conv_title" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="addConvtable">
                            <thead>
                                <tr>
                                    <td colspan="2">Academic Session</td>
                                    <td><button type="button" class="btn btn-sm btn-primary" id="addnewconvrow">+</button></td>
                                </tr>
                            </thead>
                            <tbody id="convTbody">
                                <tr id="convTrow">
                                    <td>
                                        <div class="form-group">
                                            <span for="Convnumber">Start Year:<span class="text-danger">*</span></span>
                                            <input type="number" name="academic_start_year[]" id="academic_start_year" class="form-control form-control-sm" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <span for="Convnumber">End Year:<span class="text-danger">*</span></span>
                                            <input type="number" name="academic_end_year[]" id="academic_end_year" class="form-control form-control-sm" required>
                                        </div>
                                    </td>
                                    <td><button type="button" class="btn btn-sm btn-danger" id="removenewConvrow">-</button></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <!-- Upload Awardee File -->
                    <div class="form-group mt-3">
                        <span for="Awardeefileupload">Upload Awardee File(.pdf):<span class="text-danger">*</span></span>
                        <input type="file" name="upload_file" id="upload_file" class="form-control form-control-sm" accept=".pdf" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Convocation Details (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Convocation Title</td>
                                <td>Acadmic Year</td>
                                <td>Upload by</td>
                                <td>Created at</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($convocation as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/convocation/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/convocation/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/convocation/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td>
                                        <?php $conv_session = $convocation_session_model->get_by_conv_id($value['id']);
                                        if ($conv_session) {
                                            echo "<ul id='session_list'>";
                                            foreach ($conv_session as $key => $session) {
                                                echo "<li>".$session['session_start'] . " - " . $session['session_end'] . "</li>";
                                            }
                                            echo "</ul>";
                                        } else {
                                            echo "No Session";
                                        }

                                        ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= date("d-M-Y h:i A", strtotime($value['created_at'])) ?> </td>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Create Service Clone for add and remove rows also calculate price
        var cloneLimit = 4;
        var currentClones = 0;
        $("#addnewconvrow").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#convTrow').clone().appendTo('#convTbody');
                $(cloneCatrow).find('input').val('');
            }

        });

        $('#convTbody').on('click', '#removenewConvrow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

<?= $this->endSection() ?>