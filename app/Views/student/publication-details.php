<?= $this->extend("student/stdlayouts/master") ?>
<?=  $this->section("student-content"); ?>
<?php

use App\Models\Student_publication_author_model;
$student_publication_author_model = new Student_publication_author_model();
?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/publication-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Publication Title -->
                            <div class="form-group">
                                <span for="Pubtitle">Publication Title:<span class="text-danger">*</span></span>
                                <textarea name="publication_title" id="editor2" class="form-control form-control-sm" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span for="Pubdesc">Publication Description:<span class="text-danger">*</span></span>
                                <textarea id="editor" name="publication_description"></textarea>
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
                                <span for="DoIdetails">Journal Name<span class="text-danger">*</span></span>
                                <input type="text" name="journal_name" id="journal_name" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Volume Number<span class="text-danger">*</span></span>
                                <input type="text" name="volume_number" id="volume_number" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">Page Number<span class="text-danger">*</span></span>
                                <input type="text" name="page_number" id="page_number" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubtype">Publication Type:<span class="text-danger">*</span></span>
                                <select name="publication_type" id="publication_type" class="form-control form-control-sm" required>
                                    <option value="">--Select--</option>
                                    <option value="Research">Research</option>
                                    <option value="Review Article">Review Article</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubyear">ISSN no:<span class="text-danger">*</span></span>
                                <input type="text" name="issn_no" id="issn_no" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubyear">ISBN no:<span class="text-danger">*</span></span>
                                <input type="text" name="isbn_no" id="isbn_no" class="form-control form-control-sm" required >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="DoIdetails">DOI Details:<span class="text-danger">*</span></span>
                                <input type="text" name="doi" id="doi" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubyear">Impact Factor:<span class="text-danger">*</span></span>
                                <input type="text" name="impact_factor" id="impact_factor" class="form-control form-control-sm" required >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="Pubyear">Publication Year:<span class="text-danger">*</span></span>
                                <select name="publication_year" id="publication_year" class="form-control form-control-sm" required >
                                    <option value="">--Select--</option>
                                    <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
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
                    <table class="table table-bordered table-sm" id="datatable-buttons">
                        <thead>
                            <tr>
                                <td>Publication Title</td>
                                <td>Author Name</td>
                                <td>Journal Name</td>
                                <td>Volume Number</td>
                                <td>Page Number</td>
                                <td>Publication Type</td>
                                <td>ISSN No</td>
                                <td>ISBN No</td>
                                <td>DOI Details</td>
                                <td>Impact Factor</td>
                                <td>Publication Year</td>
                                <td>File Upload</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="stockTbody">
                            <?php if ($studentData): ?>
                                <?php foreach ($studentData as $pub): ?>
                                    <tr id="stockTrow">
                                        <td><?= $pub['publication_title'] ?></td>
                                        <td>
                                            <?php $authors = $student_publication_author_model->getByPublication($pub['id']); ?>
                                            <?php if ($authors): ?>
                                                <?php foreach ($authors as $author): ?>
                                                    <?= "=> ".$author['author_name'] ?><br>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                No Author Found
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $pub['journal_name'] ?></td>
                                        <td><?= $pub['volume_number'] ?></td>
                                        <td><?= $pub['page_number'] ?></td>
                                        <td><?= $pub['publication_type'] ?></td>
                                        <td><?= $pub['issn_no'] ?></td>
                                        <td><?= $pub['isbn_no'] ?></td>
                                        <td><?= $pub['doi'] ?></td>
                                        <td><?= $pub['impact_factor'] ?></td>
                                        <td><?= $pub['publication_year'] ?></td>
                                        <?php if ($pub['file_upload']): ?>
                                            <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $pub['file_upload'] ?>" target="_blank">View File</a></td>
                                        <?php else: ?>
                                            <td>No File Uploaded</td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?= base_url() ?>student/delete-publication-details/<?= $pub['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            <!-- <a href="<?= base_url() ?>student/edit-publication-details/<?= $pub['id'] ?>" class="btn btn-primary btn-sm">Edit</a> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                No
                                <tr><td colspan="13" class="text-center">No records found.</td></tr>    
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>