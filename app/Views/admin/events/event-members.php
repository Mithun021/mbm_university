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
                <h4 class="card-title m-0"><?= $title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <?= session()->getFlashdata('status'); ?>
                <?php endif; ?>

                <form action="<?= base_url() ?>admin/event-members" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Event ID:</span>
                            <select name="event_id" class="form-control form-control-sm  my-select" required>
                                <option value="">Select Event</option>
                                <?php foreach ($events as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span>Member Type:</span>
                            <select name="member_type" class="form-control form-control-sm" required>
                                <?php foreach ($member_type as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['member_type'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="addServicetable">
                                    <thead class="bg-light">
                                        <tr>
                                            <td>Members Name</td>
                                            <td>Members Designation</td>
                                            <td>Member Affiliation</td>
                                            <td>Upload File</td>
                                            <td><button type="button" class="btn btn-sm btn-primary" id="addnewMemberRow">+</button></td>
                                        </tr>
                                    </thead>
                                    <tbody id="memberTbody">
                                        <tr id="memberTrow">
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Name:</span>
                                                    <input type="text" name="member_name[]" class="form-control form-control-sm" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Designation:</span>
                                                    <select name="member_designation[]" id="member_designation" class="form-control form-control-sm" required>
                                                        <option value="Assistant Professor">Assistant Professor</option>
                                                        <option value="Associate Professor">Associate Professor</option>
                                                        <option value="Professor">Professor</option>
                                                        <option value="Scientist">Scientist</option>
                                                        <option value="Any Other">Any Other</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="other_designation" style="display: none;">
                                                    <span>Specify Other Designation:</span>
                                                    <input type="text" name="member_desig_other[]" class="form-control form-control-sm">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span>Member Affiliation:</span>
                                                    <input type="text" name="member_affiliation[]" class="form-control form-control-sm" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span>Upload File(.pdf):</span>
                                                    <input type="file" name="upload_file[]" class="form-control form-control-sm" accept=".pdf">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" id="removenewMemberRow">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
        var cloneLimit = 10; // Maximum number of cloned rows allowed
        var currentClones = 0;

        // Add new row when the 'Add new member' button is clicked
        $("#addnewMemberRow").click(function(e) {
            e.preventDefault();
            if (currentClones < cloneLimit) {
                currentClones++;
                // Clone the first row and append it to the tbody
                var cloneCatrow = $('#memberTrow').clone().appendTo('#memberTbody');
                // Clear the input fields in the cloned row
                $(cloneCatrow).find('input').val('');
                $(cloneCatrow).find('select[name="member_designation[]"]').val(""); // Reset the designation select field

                // Attach the change event for the 'member_designation' field in the cloned row
                $(cloneCatrow).find('select[name="member_designation[]"]').change(function() {
                    toggleOtherDesignation($(this)); // Call the toggle function to show/hide the 'Other Designation' field
                });
            }
        });

        // Remove row functionality when the 'Remove' button is clicked
        $('#memberTbody').on('click', '#removenewMemberRow', function() {
            $(this).closest('tr').remove();
            currentClones--; // Decrement the clone counter when a row is removed
        });

        // Initial setup for existing rows
        $('#memberTbody').on('change', 'select[name="member_designation[]"]', function() {
            toggleOtherDesignation($(this)); // Call the toggle function to show/hide the 'Other Designation' field
        });

        // Function to show/hide the 'Other Designation' field based on the selected value
        function toggleOtherDesignation(selectElement) {
            var selectedValue = selectElement.val();
            var otherDesignationField = selectElement.closest('tr').find('#other_designation');
            if (selectedValue === "Any Other") {
                otherDesignationField.show(); // Show the "Other Designation" field
            } else {
                otherDesignationField.hide(); // Hide the "Other Designation" field
            }
        }
    });
</script>

<?= $this->endSection() ?>