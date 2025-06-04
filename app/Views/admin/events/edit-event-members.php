<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<style>
    #addServicetable #memberTbody #memberTrow:first-child td:last-child button {
        display: none;
    }
</style>
<?php

use App\Models\Employee_model;
use App\Models\Events_model;
use App\Models\Member_type_model;

$employee_model = new Employee_model();
$events_model = new Events_model();
$member_type_model = new Member_type_model();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title2; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/edit-event-members/<?= $event_member_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Event ID:</span>
                            <select name="event_id" class="form-control form-control-sm my-select" required>
                                <option value="">Select Event</option>
                                <?php foreach ($events as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?php if($event_members_detail['event_id']== $value['id']){ echo "selected"; } ?>><?= $value['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span>Member Type:</span>
                            <select name="member_type" class="form-control form-control-sm" required>
                                <?php foreach ($member_type as $value) { ?>
                                    <option value="<?= $value['id'] ?>"<?php if($event_members_detail['member_name']== $value['id']){ echo "selected"; } ?>><?= $value['member_type'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <span>Member Name:</span>
                            <input type="text" name="member_name" class="form-control form-control-sm" value="<?= $event_members_detail['member_name'] ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <span>Member Designation:</span>
                            <select name="member_designation" id="member_designation" class="form-control form-control-sm" required>
                                <option value="Assistant Professor" <?php if($event_members_detail['member_name']=="Assistant Professor"){ echo "selected"; } ?> >Assistant Professor</option>
                                <option value="Associate Professor" <?php if($event_members_detail['member_name']=="Associate Professor"){ echo "selected"; } ?>>Associate Professor</option>
                                <option value="Professor" <?php if($event_members_detail['member_name']=="Professor"){ echo "selected"; } ?>>Professor</option>
                                <option value="Scientist" <?php if($event_members_detail['member_name']=="Scientist"){ echo "selected"; } ?>>Scientist</option>
                                <option value="Any Other" <?php if($event_members_detail['member_name']=="Any Other"){ echo "selected"; } ?>>Any Other</option>
                            </select>
                            <div class="form-group" id="other_designation" style="display: none;">
                                <span>Specify Other Designation:</span>
                                <input type="text" name="member_desig_other" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <span>Member Affiliation:</span>
                            <input type="text" name="member_affiliation" class="form-control form-control-sm" value="<?= $event_members_detail['member_affiliation'] ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <span>Upload File(.pdf):</span>
                            <input type="file" name="upload_file" class="form-control form-control-sm" accept=".pdf">
                            <?php if (!empty($event_members_detail['upload_file']) && file_exists('public/admin/uploads/events/' . $event_members_detail['upload_file'])): ?>
                                <a href="<?= base_url() ?>public/admin/uploads/events/<?= $event_members_detail['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="30px">
                            <?php endif; ?>
                        </div>

                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
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
                                <td>Event ID</td>
                                <td>Employee ID</td>
                                <td>Member Type</td>
                                <td>Member Designation</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        <tbody>
                            <?php foreach ($event_members as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/events/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/events/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="30px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php $event = $events_model->get($value['event_id']);
                                        echo $event['title'] ?></td>
                                    <td><?= $value['member_name'] ?></td>
                                    <td><?php
                                        $member_type = $member_type_model->get($value['member_type']);
                                        echo $member_type['member_type'];
                                        ?></td>
                                    <td><?= $value['member_designation'] ?>
                                        <?php if ($value['member_designation'] == "Any Other") {
                                            echo " - " . $value['other_designation'];
                                        } ?>
                                    </td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                       if($emp){ echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; } ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                            <a href="<?= base_url() ?>admin/edit-event-members/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-event-members/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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
        // Check the initial selected value on page load
        toggleOtherDesignation($('#member_designation').val());
        
        // Event listener for when the select value changes
        $('#member_designation').change(function() {
            toggleOtherDesignation($(this).val());
        });

        // Function to show or hide the 'other_designation' based on the selected value
        function toggleOtherDesignation(value) {
            if(value === "Any Other") {
                $('#other_designation').show();
            } else {
                $('#other_designation').hide();
                $('#other_designation').val('');
            }
        }
    });
</script>

<?= $this->endSection() ?>