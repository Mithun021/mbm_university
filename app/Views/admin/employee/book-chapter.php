<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Books_chapter_author;
use App\Models\Employee_model;
$employee_model = new Employee_model();
$books_chapter_author = new Books_chapter_author();
?>
<style>
    #addServicetable #coAuthorTbody #coAuthorRow:first-child td:last-child button {
        display: none;
    }
</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url('admin/book-chapter') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid" id="Empid" class="form-control form-control-sm" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Book Chapter Paper<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="book_chapter" required>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Title<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="title" required>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewservicerow">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="stockTbody">
                                        <tr id="stockTrow">
                                            <td>
                                                <input type="text" class="form-control" id="author_name" name="author_name[]" placeholder="Enter Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewServicerow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td scope="col">Co-Author Details</td>
                                            <td scope="col"><button type="button" class="btn btn-sm btn-primary" id="addnewCoAuthor">+</button></td>
                                        </tr>

                                    </thead>
                                    <tbody id="coAuthorTbody">
                                        <tr id="coAuthorRow">
                                            <td>
                                                <input type="text" class="form-control" id="co_author_name" name="co_author_name[]" placeholder="Enter Co-Author Name">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removeCoAuthorrow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Publisher<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="publisher" required>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Level<</span>
                            <select class="form-control form-control-sm" name="level">
                                    <option value="">--Select--</option>
                                    <option value="National">National</option>
                                    <option value="International">International</option>
                            </select>
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Total no. of pages/Page Range<</span>
                            <input type="number" class="form-control form-control-sm" name="total_pages">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Published Date Online<</span>
                            <input type="date" class="form-control form-control-sm" name="publich_date_online">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Published Date Print</span>
                            <input type="date" class="form-control form-control-sm" name="publich_date_print">
                        </div>
                        <div class="col-lg-4 form-group">
                            <span for="">Date Of Acceptance</span>
                            <input type="date" class="form-control form-control-sm" name="acceptance_date">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Date of Communication</span>
                            <input type="date" class="form-control form-control-sm" name="communication_date">
                        </div>

                        <!-- <div class="col-lg-4 form-group">
                            <span for="">Month<span class="text-danger">*</span></span>
                            <input type="month" class="form-control form-control-sm" name="month">
                        </div> -->

                        <!-- <div class="col-lg-4 form-group">
                        <span for="">Year<span class="text-danger">*</span></span>
                        <input type="year" class="form-control form-control-sm" name="year" required>
                    </div> -->

                        <div class="col-lg-4 form-group">
                            <span for="">ISBN</span>
                            <input type="text" class="form-control form-control-sm" name="isbn">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">ISSN No.</span>
                            <input type="text" class="form-control form-control-sm" name="issn_no">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Digital Object Identify</span>
                            <input type="text" class="form-control form-control-sm" name="doi">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Web Link</span>
                            <input type="url" class="form-control form-control-sm" name="web_link">
                        </div>

                        <div class="col-lg-4 form-group">
                            <span for="">Upload File(.pdf)</span>
                            <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-12">
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
                                <td>Book Title</td>
                                <td>Book Chapter</td>
                                <td>Month Year</td>
                                <td>Employee</td>
                                <td>Author</td>
                                <td>ISBN/ISSN no</td>
                                <td>DOI</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books_chapter as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/books/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/books/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/books/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $value['book_chapter'] ?></td>
                                    <td><?= $value['month'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['emplyee_id']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <?php $auth = $books_chapter_author->get_all_by_books_chapter_id($value['id']); ?>
                                        <ul id="tableList">
                                        <?php foreach ($auth as $key => $value2) { ?>
                                            <li><?= $value2['author_name'] ?></li>
                                        <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?= $value['isbn'] ?> / <?= $value['issn_no'] ?></td>
                                    <td><?= $value['doi'] ?></td>
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

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var cloneLimit = 10;
        var currentClones = 0;
        $("#addnewCoAuthor").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                var cloneCatrow = $('#coAuthorRow').clone().appendTo('#coAuthorTbody');
                $(cloneCatrow).find('input').val('');
            }

        });

        $('#coAuthorTbody').on('click', '#removeCoAuthorrow', function() {
            $(this).closest('tr').remove();
        });

    });
</script>

<?= $this->endSection() ?>