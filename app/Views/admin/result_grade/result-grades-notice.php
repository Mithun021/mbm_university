<!-- app/Views/actrulesdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\Act_rules_category_model;
use App\Models\Employee_model;

$employee_model = new Employee_model();
$act_rules_category_model = new Act_rules_category_model();
?>

<div class="row">
    <!-- Form Section for Adding Act Rules Details -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Act Rules Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/result-grades-notice" method="post">

                    <!-- Act Rules Type -->
                    <div class="form-group">
                        <span for="Actrulestype">Result Notes:</span>
                        <textarea name="result_notes" id="editor"><?= $result_grade_notes['result_notice'] ?></textarea>
                    </div>

                    <!-- Act Rules Type -->
                    <div class="form-group">
                        <span for="Actrulestype">Grade Notes:</span>
                        <textarea name="grade_notes" id="editor2"><?= $result_grade_notes['grade_notice'] ?></textarea>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>