<!-- app/Views/membershipdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <!-- Form Section for Adding Membership Details -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Membership Details</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/membership" method="post">

                    <div class="form-group mt-3">
                        <span for="Membershiptitle"> Title:</span>
                        <input type="text" name="Membershiptitle" id="Membershiptitle" class="form-control form-control-sm" required >
                    </div>

                    <!-- Membership Description -->
                    <div class="form-group mt-3">
                        <span for="Membershipdesc"> Description:</span>
                        <textarea id="editor" name="description"></textarea>
                    </div>

                    <!-- Membership Start Date -->
                    <div class="form-group mt-3">
                        <span for="Membershipstartdate">Membership Start Date:</span>
                        <input type="date" name="Membershipstartdate" id="Membershipstartdate" class="form-control form-control-sm" required>
                    </div>

                    <!-- Membership End Date -->
                    <div class="form-group mt-3">
                        <span for="Membershipenddate">Membership End Date:</span>
                        <input type="date" name="Membershipenddate" id="Membershipenddate" class="form-control form-control-sm">
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Memberships (Optional) -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Membership List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Title</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($membership as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['title'] ?></td>
                                <td><?= date("d-m-Y", strtotime($value['start_date'])) ?></td>
                                <td><?= date("d-m-Y", strtotime($value['end_date'])) ?></td>
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