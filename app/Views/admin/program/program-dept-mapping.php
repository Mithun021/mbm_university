<!-- app/Views/programdeptmapping_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Department_model;
    use App\Models\Program_model;
    use App\Models\Employee_model;
    $employee_model = new Employee_model();
    $program_model = new Program_model();
    $department_model = new Department_model();
?>

<div class="row">
    <!-- Form Section for Adding Program-Department Mapping -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Program-Department Mapping</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>
                
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/program-dept-mapping" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="Deptid">Department ID:</span>
                            <select name="Deptid" id="Deptid" class="form-control form-control-sm" required >
                                <option value="">Select Deparrtment</option>
                            <?php foreach ($department as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- Program ID -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="Progid">Program ID:</span>
                            <select name="Progid" id="Progid" class="form-control form-control-sm" required >
                                <option value="">Select Program</option>
                            <?php foreach ($program as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Eligibility Criteria -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <span for="Elligibilitycriteria">Eligibility Criteria:</span>
                            <textarea name="eligibility" id="editor" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Number of Seats -->
                        <div class="form-group">
                            <span for="Noofseats">Number of Seats:</span>
                            <input type="number" name="Noofseats" id="Noofseats" class="form-control form-control-sm" required min="1">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="Noofseats">Batch Sart:</span>
                            <input type="number" name="batchStart" id="batchStart" class="form-control form-control-sm" required min="2000">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="Noofseats">Batch End:</span>
                            <input type="number" name="batchEnd" id="batchEnd" class="form-control form-control-sm" required min="2000">
                        </div>
                    </div>

                    <!-- Syllabus Upload -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <span for="Syllabus">Upload Syllabus(.pdf,.doc,.docx):</span>
                            <input type="file" name="Syllabus" id="Syllabus" class="form-control form-control-sm" accept=".pdf,.doc,.docx" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Status</span>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Current Session</span>
                            <select name="current_session" id="current_session" class="form-control form-control-sm">
                                <option value="yes">Yes</option>
                                <option value="no" default>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <span><input type="checkbox" name="admission" value="1"> Check for Admission Page</span>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section to Display Existing Mappings (Optional) -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Program-Department Mapping List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>File</td>
                                <td>Status</td>
                                <td>Program</td>
                                <td>Dept.</td>
                                <td>Eligibility Criteria</td>
                                <td>No. of Seats</td>
                                <td>Batch</td>
                                <td>Active Session</td>
                                <td>Admission</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($program_dep_mapping as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><a href="<?= base_url() ?>public/admin/uploads/program_dep_map/<?= $value['syllabus_files'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/folder.png" height="30px"></a></td>
                                <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                <td><?php $program = $program_model->get($value['program_id']); echo (!empty($program['name'])) ? $program['name'] : '____'; ?></td>
                                <td><?php $department = $department_model->get($value['department_id']); echo (!empty($department['name'])) ? $department['name'] : '____'; ?></td>
                                <td><?= $value['eligibility_criteria'] ?></td>
                                <td><?= $value['no_of_seats'] ?></td>
                                <td><?= $value['batch_start']." - ".$value['batch_end'] ?></td>
                                <td><?= $value['current_session'] ?></td>
                                <td><?= ($value['admission'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($value['admission'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?></td>
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