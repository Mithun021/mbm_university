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
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status') ?>
                <?php endif; ?>

                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/employee-seminar-conference" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span for="Empid">Employee:</span>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm my-select" required >
                                <option value="">Select Employee</option>
                            <?php foreach($employee as $value){ ?>
                                <option value="<?= $value['id'] ?>"><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Type of Activity</span>
                            <select class="form-control form-control-sm" name="type_of_activity" required>
                                <option value="">--Select--</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Conference">Conference</option>
                                <option value="Exhibition">Exhibition</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Webinar">Webinar</option>
                                <option value="Symposium">Symposium</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 other_activity" style="display: none;">
                            <span>Other Activity</span>
                            <input type="text" class="form-control form-control-sm" name="other_activity">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Name </span>
                            <input type="text" class="form-control form-control-sm" name="seminar_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>From Date</span>
                            <input type="date" class="form-control form-control-sm" name="from_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>To Date</span>
                            <input type="date" class="form-control form-control-sm" name="to_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Role</span>
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="">--Select--</option>
                                <option value="Attended">Attended</option>
                                <option value="Organized">Organized</option>
                                <option value="Presented">Presented</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Designation</span>
                            <input type="text" class="form-control form-control-sm" name="designation" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Level</span>
                            <select class="form-control form-control-sm" name="level" required>
                                <option value="">--Select--</option>
                                <option value="Internation">Internation</option>
                                <option value="National">National</option>
                                <option value="Internation within Country">Internation within Country</option>
                                <option value="University/Institute">University/Institute</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Start Date</span>
                            <input type="date" class="form-control form-control-sm" name="start_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>End Date</span>
                            <input type="date" class="form-control form-control-sm" name="end_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span>No of Participants</span>
                            <input type="number" class="form-control form-control-sm" name="no_of_participant" >
                        </div>
                        <div class="form-group col-md-6">
                            <span>Funding Agency Name</span>
                            <input type="text" class="form-control form-control-sm" name="funding_agency_name" >
                        </div>
                        <div class="form-group col-md-6">
                            <span>Fund Amount</span>
                            <input type="number" class="form-control form-control-sm" name="fund_amount" step="1" min="1" >
                        </div>  
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Employee</td>
                                <td>Activity</td>
                                <td>Saminar Name</td>
                                <td>Date(From - To)</td>
                                <td>Designation</td>
                                <td>level</td>
                                <td>Start End Date</td>
                                <td>Participant no</td>
                                <td>Funding Agency Name</td>
                                <td>Fund Amount</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($employee_seminar_conference as $key => $value){ ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?php $emp = $employee_model->get($value['employee_id']); if($emp){ echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']; }  ?></td>
                                <td><?php if($value['type_of_activity'] == 'Other'){ echo $value['other_activity']; } else { echo $value['type_of_activity']; } ?></td>
                                <td><?= $value['seminar_name'] ?></td>
                                <td><?= $value['from_date']." - ".$value['to_date'] ?></td>
                                <td><?= $value['designation'] ?></td>
                                <td><?= $value['level'] ?></td>
                                <td><?= $value['start_date']." - ".$value['end_date'] ?></td>
                                <td><?= $value['no_of_participant'] ?></td>
                                <td><?= $value['funding_agency_name'] ?></td>
                                <td><?= $value['fund_amount'] ?></td>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const activitySelect = document.querySelector('[name="type_of_activity"]');
    const otherActivityDiv = document.querySelector('.other_activity');
    const otherActivityInput = otherActivityDiv.querySelector('input');

    function toggleOtherActivity() {
        if (activitySelect.value === 'Other') {
            otherActivityDiv.style.display = 'block';
            otherActivityInput.required = true;
        } else {
            otherActivityDiv.style.display = 'none';
            otherActivityInput.required = false;
            otherActivityInput.value = ''; // Optional: clear input
        }
    }

    // Initial state
    toggleOtherActivity();

    // Listen for changes
    activitySelect.addEventListener('change', toggleOtherActivity);
});
</script>


<?= $this->endSection() ?>