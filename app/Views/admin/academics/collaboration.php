<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Classified_mou_value_model;
use App\Models\Collaboration_faculties_model;
use App\Models\Employee_model;

$employee_model = new Employee_model();
$classified_mou_value_model = new Classified_mou_value_model();
$collaboration_faculties_model = new Collaboration_faculties_model()
?>

<!-- Page title and form layout -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/collaboration" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabtitle">Collaboration Title:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabtitle" id="Collabtitle" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutename">Institution Name:<span class="text-danger">*</span></span>
                                <input type="text" name="Collabinstitutename" id="Collabinstitutename" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="Mediatitle">Description:</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="Collaborationdatetime">Collaboration Start Date:<span class="text-danger">*</span></span>
                                <input type="date" name="Collaborationdate" id="Collaborationdate" class="form-control form-control-sm" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="Collaborationdatetime">Collaboration End Date:</span>
                                <input type="date" name="Collaborationenddate" id="Collaborationenddate" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstitutelogo">Institution Logo(PNG,JPG,JPEG):<span class="text-danger">*</span></span>
                                <input type="file" name="institutelogo" id="institutelogo" class="form-control form-control-sm" accept=".png,.jpg,.jpeg" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabinstituelink">Institution Link:</span>
                                <input type="url" name="Collabinstituelink" id="Collabinstituelink" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="Collabfileupload">Collaboration File Upload(PDF):</span>
                                <input type="file" name="Collabfile" id="Collabfile" class="form-control form-control-sm" accept=".pdf">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable"> 
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Faculty Coordinator</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>
                            
                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                            <input type="text" name="faculty_coordinator[]" id="faculty_coordinator" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabfileupload">Collaboration Gallery(JPG,PNG):</span>
                                <input type="file" name="collab_gallery[]" id="collab_gallery" class="form-control form-control-sm" accept=".jpg,.png,.jpeg" multiple>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabenddatetime">Classification of MoU:</span>
                                <select name="classified_mou" id="classified_mou" class="form-control form-control-sm">
                                    <option value="">--Select--</option>
                                <?php foreach ($classified_mou as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabenddatetime">Collaboration tenure year:<span class="text-danger">*</span></span>
                                <input type="number" name="Collabtenure" id="Collabtenure" class="form-control form-control-sm" required>
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <span for="Collabstatus">Collaboration Status:</span>
                                <select name="Collabstatus" id="Collabstatus" class="form-control form-control-sm" required>
                                    <option value="active">Active</option>
                                    <option value="expired">Expired</option>
                                    <option value="renewed">Renewed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Renewal Date field, initially hidden -->
                        <div class="col-md-6" id="renewalDateField" style="display: none;">
                            <div class="form-group">
                                <span for="RenewalDate">Renewal Date:</span>
                                <input type="date" name="RenewalDate" id="RenewalDate" class="form-control form-control-sm">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Title</td>
                                <td>Institute</td>
                                <td>Collaboration Date</td>
                                <td>Coll. Faculty</td>
                                <td>Class. MoU</td>
                                <td>Status</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($collaboration as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['institute_logo']) && file_exists('public/admin/uploads/collaboration/' . $value['institute_logo'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['institute_logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['institute_logo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['collaboration_file']) && file_exists('public/admin/uploads/collaboration/' . $value['collaboration_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/collaboration/<?= $value['collaboration_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/collaboration/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><a href="<?= $value['institute_link'] ?>" target="_blank"><?= $value['institute_name'] ?></a></td>
                                    <td><?= $value['collaboration_date'] ?></td>
                                    <td><?php $faculty = $collaboration_faculties_model->getByColId($value['id']); if ($faculty) {
                                        foreach ($faculty as $key => $value2) {
                                            echo '<i class="fa fa-angle-right"></i> '.$value2['faculty_name']."<br>";
                                        }
                                    } ?></td>
                                    <td><?= $classified_mou_value_model->get($value['classified_mou'])['name'] ?? '' ?></td>
                                    <td><?= $value['status'] ?></td>
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
    document.getElementById('Collabstatus').addEventListener('change', function() {
        var renewalDateField = document.getElementById('renewalDateField');

        if (this.value === 'renewed') {
            renewalDateField.style.display = 'block'; // Show Renewal Date field
        } else {
            renewalDateField.style.display = 'none'; // Hide Renewal Date field
        }
    });
</script>

<?= $this->endSection() ?>