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
            </div>
            <div class="card-body">
            <?php if (session()->getFlashdata('msg')): ?>
                <?= session()->getFlashdata('msg') ?>
            <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/edit-employee-publication/<?= $emp_publication_id ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Employee ID -->
                        <div class="form-group">
                            <span for="Empid">Employee:</span>
                            <select name="Empid[]" id="Empid" class="form-control form-control-sm my-select" multiple required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>" <?php if (in_array($value['id'], explode(",", $publication_detail['emplyee_id']))) { echo "selected"; } ?>><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Publication Title -->
                        <div class="form-group">
                            <span for="Pubtitle">Publication Title:</span>
                            <textarea name="Pubtitle" id="editor2" class="form-control form-control-sm"><?= $publication_detail['title'] ?></textarea>
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
                            <input type="text" name="Pubkeyword" id="Pubkeyword" class="form-control form-control-sm" placeholder="e.g., machine learning, AI" value="<?= $publication_detail['keywords'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Photo Upload -->
                        <div class="form-group">
                            <span for="Pubphotoupload">Photo Upload:</span>
                            <input type="file" name="Pubphotoupload" id="Pubphotoupload" class="form-control form-control-sm">
                            <a href="<?= base_url() ?>public/admin/uploads/publication/<?= $publication_detail['publication_photo'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" height="30px"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered"> 
                                <thead class="bg-light">
                                    <tr>
                                        <td scope="col">Author Details</td>
                                        <td scope="col"><button type="button" class="btn btn-sm btn-primary" onclick="addnewpubauthor(<?= $emp_publication_id ?>)">+</button></td>
                                    </tr>
                        
                                </thead>
                                <tbody >
                                <?php if($publication_author_detail){ foreach ($publication_author_detail as $key => $author) { ?>
                                 
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="author_name" placeholder="Enter Author Name" value="<?= $author['author_name'] ?>" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deletePubAuthor(<?= $author['id'] ?>)">-</button>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Published Name</span>
                            <input type="text" name="published_name" id="published_name" class="form-control form-control-sm" value="<?= $publication_detail['published_name'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Volume Number</span>
                            <input type="text" name="volume_number" id="volume_number" class="form-control form-control-sm" value="<?= $publication_detail['volume_number'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Publish Date Online</span>
                            <input type="date" name="publish_date_online" id="publish_date_online" class="form-control form-control-sm" value="<?= $publication_detail['publish_date_online'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Publish Date Print</span>
                            <input type="date" name="publish_date_print" id="publish_date_print" class="form-control form-control-sm" value="<?= $publication_detail['publish_date_print'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Date of Acceptance </span>
                            <input type="date" name="date_of_acceptance" id="date_of_acceptance" class="form-control form-control-sm" value="<?= $publication_detail['date_of_acceptance'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="DoIdetails">Date of Communication </span>
                            <input type="date" name="date_of_communication" id="date_of_communication" class="form-control form-control-sm" value="<?= $publication_detail['date_of_communication'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                         <!-- DOI Details -->
                        <div class="form-group">
                            <span for="DoIdetails">DOI Details:</span>
                            <input type="text" name="DoIdetails" id="DoIdetails" class="form-control form-control-sm" value="<?= $publication_detail['doi_details'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Year -->
                        <div class="form-group">
                            <span for="Pubyear">Publication Year:</span>
                            <input type="number" name="Pubyear" id="Pubyear" class="form-control form-control-sm" min="1900" max="<?= date("Y") ?>"  value="<?= $publication_detail['publication_year'] ?>" required >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Journal Name:</span>
                            <input type="text" name="journal_name" id="journal_name" class="form-control form-control-sm"  value="<?= $publication_detail['journal_name'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Page no:</span>
                            <input type="text" name="page_no" id="page_no" class="form-control form-control-sm" value="<?= $publication_detail['page_no'] ?>" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Publication Type -->
                        <div class="form-group">
                            <span for="Pubtype">Reffered:</span>
                            <select name="reffered" id="reffered" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="yes" <?php if($publication_detail['reffered'] == "yes"){ echo "selected"; } ?>>Yes</option>
                                <option value="no" <?php if($publication_detail['reffered'] == "no"){ echo "selected"; } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">ISSN no:</span>
                            <input type="text" name="issn_no" id="issn_no" class="form-control form-control-sm"  value="<?= $publication_detail['issn_no'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">ISBN no:</span>
                            <input type="text" name="isbn_no" id="isbn_no" class="form-control form-control-sm"  value="<?= $publication_detail['isbn_no'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span for="Pubyear">Impact Factor Return List:</span>
                            <input type="text" name="impact_factor" id="impact_factor" class="form-control form-control-sm" value="<?= $publication_detail['impact_factor'] ?>" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <span for="Pubyear">Web Link:</span>
                            <input type="url" name="web_link" id="web_link" class="form-control form-control-sm" value="<?= $publication_detail['web_link'] ?>" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Publication Type -->
                        <div class="form-group">
                            <span for="Pubtype">Publication Type:</span>
                            <select name="Pubtype" id="Pubtype" class="form-control form-control-sm" required>
                                <option value="">Select Type</option>
                                <option value="Research Article" <?php if($publication_detail['publication_type'] == "Research Article"){ echo "selected"; } ?>>Research Article</option>
                                <option value="Review Article" <?php if($publication_detail['publication_type'] == "Review Article"){ echo "selected"; } ?>>Review Article</option>
                                <option value="Book Chapter" <?php if($publication_detail['publication_type'] == "Book Chapter"){ echo "selected"; } ?>>Book Chapter</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Publication Status -->
                        <div class="form-group">
                            <span for="Pubstatus">Publication Status:</span>
                            <select name="Pubstatus" id="Pubstatus" class="form-control form-control-sm" required>
                                <option value="">Select Status</option>
                                <option value="Values" <?php if($publication_detail['status'] == "Values"){ echo "selected"; } ?>>Values</option>
                                <option value="Accepted" <?php if($publication_detail['status'] == "Accepted"){ echo "selected"; } ?>>Accepted</option>
                                <option value="Web-Link" <?php if($publication_detail['status'] == "Web-Link"){ echo "selected"; } ?>>Web-Link</option>
                                <option value="In-Press" <?php if($publication_detail['status'] == "In-Press"){ echo "selected"; } ?>>In-Press</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Publication Status -->
                        <div class="form-group">
                            <span for="Pubstatus">Role in Publication:</span>
                            <select name="publication_role" id="" class="form-control form-control-sm" required>
                                <option value="">--Select--</option>
                                <option value="First/Principal/Corresponding" <?php if($publication_detail['publication_role'] == "First/Principal/Corresponding"){ echo "selected"; } ?>>First/Principal/Corresponding</option>
                                <option value="Author" <?php if($publication_detail['publication_role'] == "Author"){ echo "selected"; } ?>>Author</option>
                                <option value="Co-Author" <?php if($publication_detail['publication_role'] == "Co-Author"){ echo "selected"; } ?>>Co-Author</option>
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

<div class="modal fade" tabindex="-1" role="dialog" id="pub_author_name">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Author</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?>admin/addnewpubauthor" method="post">
      <div class="modal-body">
        <div class="form-group">
            <input type="text" name="pub_id" id="pub_id" class="form-control form-control-sm" readonly>
            <span>Author Name</span>
            <input type="text" class="form-control form-control-sm" name="newPubAuthor">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        
    });

    function addnewpubauthor(pub_id) { 
        $('#pub_id').val(pub_id);
        $('#pub_author_name').modal('show');
    }

    function deletePubAuthor(id){
        if(confirm('Are you sure...!')){
            // alert(id); return false;
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>admin/deletPubAuthor/" + id,
                success : function (param) { 
                    if (param == true) {
                        alert('Author Successful Delete');
                        window.location.reload();
                    }else{
                        alert(param);
                    }
                }
            });
        }
    }
</script>

<?= $this->endSection() ?>