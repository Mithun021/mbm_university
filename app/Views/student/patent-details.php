<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<?php

use App\Models\Student_patent_author_model;

   $student_patent_author_model = new Student_patent_author_model();
?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/patent-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubtitle">Patent Title:<span class="text-danger">*</span></span>
                                <input name="patent_title" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubdesc">Description:<span class="text-danger">*</span></span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details<span class="text-danger">*</span></td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" name="author_name[]" placeholder="Enter Author Name" required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Patent Number<span class="text-danger">*</span></span>
                                <input type="text" name="patent_number" id="patent_number" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtype">Patent Status:<span class="text-danger">*</span></span>
                                <select name="patent_status" id="patent_status" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="Submitted">Submitted</option>
                                    <option value="Granted">Granted</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Patent Filing Date <span class="text-danger">*</span></span>
                                <input type="date" name="patent_filing_date" id="patent_filing_date" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6" id="patent_grant_date" style="display: none;">
                            <div class="form-group">
                                <span for="DoIdetails">Patent Grant Date<span class="text-danger">*</span></span>
                                <input type="date" name="patent_grant_date" id="patent_grant_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtype">Patent Level :<span class="text-danger">*</span></span>
                                <select name="patent_level" id="patent_level" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="National">National</option>
                                    <option value="International">International</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Fund Generated<span class="text-danger">*</span></span>
                                <input type="text" name="fund_generated" id="patent_number" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="file_upload" accept=".pdf" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-buttons">
                        <thead class="bg-light">
                            <tr>
                                <td>Patent Title</td>
                                <td>Author Name</td>
                                <td>Patent Number</td>
                                <td>Patent Status</td>
                                <td>Patent Filing Date</td>
                                <td>Patent Grant Date</td>
                                <td>Patent Level</td>
                                <td>Fund Generated</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($studentData): ?>
                                <?php foreach ($studentData as $row): ?>
                                    <tr>
                                        <td><?= $row['patent_title'] ?></td>
                                        <td style="width: 150px;">
                                            <?php $authors = $student_patent_author_model->getByPatent($row['id']); ?>
                                            <?php if ($authors): ?>
                                                <?php foreach ($authors as $author): ?>
                                                    <?= '<i class="fas fa-arrow-circle-right"></i> '.$author['author_name'] ?><br>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                No Author Found
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row['patent_number'] ?></td>
                                        <td><?= $row['patent_status'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['patent_filing_date'])) ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['patent_grant_date'])) ?></td>
                                        <td><?= $row['patent_level'] ?></td>
                                        <td><?= $row['fund_generated'] ?></td>
                                        <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $row['file_upload'] ?>" target="_blank">View File</a></td>
                                        <td>
                                            <a href="<?= base_url() ?>student/delete-patent-details/<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            <!-- <a href="<?= base_url() ?>student/edit-publication-details/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="10" class="text-center">No Records Found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                    

</div>


<script>
    document.getElementById('patent_status').addEventListener('change', function () {
        var selectedValue = this.value;
        var grantDateDiv = document.getElementById('patent_grant_date');

        if (selectedValue === 'Granted') {
            grantDateDiv.style.display = 'block';
        } else {
            grantDateDiv.style.display = 'none';
            // Optional: Also clear the date field when hidden
            grantDateDiv.querySelector('input').value = '';
        }
    });
</script>

<?= $this->endSection() ?>