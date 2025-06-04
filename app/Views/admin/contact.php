<!-- app/Views/nipercontactdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<div class="row">
    <!-- Form Section for Adding Contact Details -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add NIPER Contact Details</h4>
            </div>
            <div class="card-body">
                <?php
                    if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    }
                ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/contact" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <span for="Contactaddress">Contact Address:</span>
                            <textarea name="Contactaddress" id="editor" class="form-control form-control-sm" rows="4"><?= $contact['contact_address'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumber1">Contact Number 1:</span>
                            <input type="text" name="Contactnumber1" id="Contactnumber1" class="form-control form-control-sm" required value="<?= $contact['contact1'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumberdesc1">Description for Number 1:</span>
                            <input type="text" name="Contactnumberdesc1" id="Contactnumberdesc1" class="form-control form-control-sm" required value="<?= $contact['contact1_desc'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumber2">Contact Number 2:</span>
                            <input type="text" name="Contactnumber2" id="Contactnumber2" class="form-control form-control-sm" value="<?= $contact['contact2'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumberdesc2">Description for Number 2:</span>
                            <input type="text" name="Contactnumberdesc2" id="Contactnumberdesc2" class="form-control form-control-sm" value="<?= $contact['contact2_desc'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumber3">Contact Number 3:</span>
                            <input type="text" name="Contactnumber3" id="Contactnumber3" class="form-control form-control-sm" value="<?= $contact['contact3'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactnumberdesc3">Description for Number 3:</span>
                            <input type="text" name="Contactnumberdesc3" id="Contactnumberdesc3" class="form-control form-control-sm" value="<?= $contact['contact3_desc'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactemailid1">Contact Email ID 1:</span>
                            <input type="email" name="Contactemailid1" id="Contactemailid1" class="form-control form-control-sm" required value="<?= $contact['email_id1'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Contactemailid2">Contact Email ID 2:</span>
                            <input type="email" name="Contactemailid2" id="Contactemailid2" class="form-control form-control-sm" value="<?= $contact['email_id2'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Workingdays">Working Days:</span>
                            <input type="text" name="Workingdays" id="Workingdays" class="form-control form-control-sm" required value="<?= $contact['working_days'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Workinghours">Working Hours:</span>
                            <input type="text" name="Workinghours" id="Workinghours" class="form-control form-control-sm" required value="<?= $contact['working_hours'] ?>">
                        </div>
                    </div>
                </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>