<!-- app/Views/emppublicationdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add Publication Details</h4>
                <div>
                    <button type="button" class="btn btn-sm btn-danger" id="export_sample_btn">Export Sample</button>
                    <button class="btn btn-sm btn-primary" id="upload_emp_exp_btn">Import</button>
                </div>
            </div>
            <div class="card-body">
            <?php if (session()->getFlashdata('msg')): ?>
                <?= session()->getFlashdata('msg') ?>
            <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-publication" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Employee ID -->
                        <div class="form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid[]" id="Empid" class="form-control form-control-sm my-select" multiple required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Publication Title -->
                        <div class="form-group">
                            <span for="Pubtitle">Publication Title:</span>
                            <textarea name="Pubtitle" id="editor2" class="form-control form-control-sm" ></textarea>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                        <div class="form-group">
                            <span for="Pubdesc">Publication Description:</span>
                            <textarea id="editor" name="description"></textarea>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubkeyword">Keywords:</span>
                            <input type="text" name="Pubkeyword" id="Pubkeyword" class="form-control form-control-sm" placeholder="e.g., machine learning, AI">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Photo Upload -->
                        <div class="form-group">
                            <span for="Pubphotoupload">Photo Upload:</span>
                            <input type="file" name="Pubphotoupload" id="Pubphotoupload" class="form-control form-control-sm">
                        </div>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Published Name</span>
                            <input type="text" name="published_name" id="published_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Volume Number</span>
                            <input type="text" name="volume_number" id="volume_number" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Publish Date Online</span>
                            <input type="date" name="publish_date_online" id="publish_date_online" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Publish Date Print</span>
                            <input type="date" name="publish_date_print" id="publish_date_print" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Date of Acceptance </span>
                            <input type="date" name="date_of_acceptance" id="date_of_acceptance" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Date of Communication </span>
                            <input type="date" name="date_of_communication" id="date_of_communication" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- DOI Details -->
                        <div class="form-group">
                            <span for="DoIdetails">DOI Details:</span>
                            <input type="text" name="DoIdetails" id="DoIdetails" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Year -->
                        <div class="form-group">
                            <span for="Pubyear">Publication Year:</span>
                            <input type="number" name="Pubyear" id="Pubyear" class="form-control form-control-sm" min="1900" max="<?= date("Y") ?>" required >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Journal Name:</span>
                            <input type="text" name="journal_name" id="journal_name" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Page no:</span>
                            <input type="text" name="page_no" id="page_no" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Type -->
                        <div class="form-group">
                            <span for="Pubtype">Reffered:</span>
                            <select name="reffered" id="reffered" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">ISSN no:</span>
                            <input type="text" name="issn_no" id="issn_no" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">ISBN no:</span>
                            <input type="text" name="isbn_no" id="isbn_no" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Impact Factor Return List:</span>
                            <input type="text" name="impact_factor" id="impact_factor" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <span for="Pubyear">Web Link:</span>
                            <input type="url" name="web_link" id="web_link" class="form-control form-control-sm" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Publication Type -->
                        <div class="form-group">
                            <span for="Pubtype">Publication Type:</span>
                            <select name="Pubtype" id="Pubtype" class="form-control form-control-sm" required>
                                <option value="">Select Type</option>
                                <option value="Research Article">Research Article</option>
                                <option value="Review Article">Review Article</option>
                                <option value="Book Chapter">Book Chapter</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Publication Status -->
                        <div class="form-group">
                            <span for="Pubstatus">Publication Status:</span>
                            <select name="Pubstatus" id="Pubstatus" class="form-control form-control-sm" required>
                                <option value="">Select Status</option>
                                <!-- <option value="0">In Proceeding</option>
                                <option value="1">Published</option> -->
                                <option value="Values">Values</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Web-Link">Web-Link</option>
                                <option value="In-Press">In-Press</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Publication Status -->
                        <div class="form-group">
                            <span for="Pubstatus">Role in Publication:</span>
                            <select name="publication_role" id="" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <option value="First/Principal/Corresponding">First/Principal/Corresponding</option>
                                <option value="Author">Author</option>
                                <option value="Co-Author">Co-Author</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                    
                <div class="col-lg-12">
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Employee</td>
                                <td>Title</td>
                                <td>Status</td>
                                <td>DOI</td>
                                <td>Journal Name</td>
                                <td>ISSN / ISBN</td>
                                <td>Type</td>
                                <td>Publication Year</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($publication as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <a href="<?= base_url() ?>public/admin/uploads/publication/<?= $value['publication_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" height="30px"></a>
                                </td>
                                <td>
                                    <?php 
                                        $employees = explode(',',$value['emplyee_id']); 
                                        foreach ($employees as $key => $ids) {
                                            $emp = $employee_model->get($ids); if($emp){ echo '<i class="fa fa-angle-right"></i> '.$emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']."<br>";  }
                                        }
                                    ?>

                                </td>
                                <td><?= $value['title'] ?></td>
                                <td>
                                <?php echo $value['status'];
                                    // if ($value['status'] == 0) {
                                    //     echo "<span class='badge badge-warning badge-pill'>In Proceeding</span>";
                                    // } elseif ($value['status'] == 1) {
                                    //     echo "<span class='badge badge-success badge-pill'>Published</span>";
                                    // }
                                ?>
                                </td>
                                <td><?= $value['doi_details'] ?></td>
                                <td><?= $value['journal_name'] ?></td>
                                <td><?= $value['issn_no'] ?> / <?= $value['isbn_no'] ?></td>
                                <td><?= $value['publication_type'] ?></td>
                                <td><?= $value['publication_year'] ?></td>
                                <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                        <a href="<?= base_url() ?>admin/edit-employee-publication/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url() ?>admin/delete-employee-publication/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure..!')"><i class="far fa-trash-alt"></i></a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="export_emp_sample_modal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Export Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?>admin/export_emp_publication_sample" method="post">
      <div class="modal-body">
      <div class="alert alert-danger"><p class="m-0">Note : After exporting the CSV, do not delete the top headings from the Excel sheet.</p></div>
        <?php foreach($employee as $value){ ?>
            <span><input type="checkbox" name="emp_id[]" value="<?= $value['id'] ?>"> <?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></span> <br>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Download CSV</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="upload_emp_exp_modal">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Employee Experience Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?>admin/upload_emp_publication_csv" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="alert alert-danger">
            <p class="m-0">1. Ensure that the employee is available before uploading the CSV file. Please verify employee details beforehand.</p>
            <p class="m-0">2. The employee's mobile number and official email ID must be available.</p>
            <p class="m-0">3. Before uploading the CSV, cross-check the employee's official email address and mobile number.</p>
            <p class="m-0">4.Please upload only CSV files.</p>
            <p class="m-0">5.In the Author Name and Publication Keywords section, write the name with commas separating each part. For Example</p>
            <p class="m-0">Keywords : keywords1, keywords2, keywords3.....</p>
            <p class="m-0">Author Name : Name1, Name2, Name3 .....</p>
        </div>
        <input type="file" name="csv_file" class="dropify" data-height="300" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#upload_emp_exp_btn').on('click',function (e) { 
            e.preventDefault();
            $('#upload_emp_exp_modal').modal('show');
        });

        $('#export_sample_btn').on('click',function (e) { 
            e.preventDefault();
            $('#export_emp_sample_modal').modal('show');
        })
    });
</script>

<?= $this->endSection() ?>