<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-border">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Module</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $key => $value) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <label for=""><input type="checkbox" name="change_module" id="change_module" <?php if($value['status'] == 1){ echo "checked"; } ?>></label>
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