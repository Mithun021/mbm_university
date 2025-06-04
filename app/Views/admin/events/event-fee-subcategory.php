<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Event_fee_category_model;
use App\Models\Events_model;

$employee_model = new Employee_model();
$events_model = new Events_model();
$event_fee_category_model = new Event_fee_category_model();
?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
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
                <form method="post" action="<?= base_url('admin/event-fee-subcategory') ?>">
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" id="event_id" class="form-control form-control-sm">
                            <option value="">Select Event</option>
                            <?php foreach ($events as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Event Fee Category</span>
                        <select name="event_fee_category_id" id="event_fee_category_id" class="form-control form-control-sm">
                            <option value="" default selected>Select Event Fee Category</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Category Name<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="event_category" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event id</td>
                                <td>Evnt Fee name</td>
                                <td>Category Name</td>
                                <td>Upload By</td>
                                <td>Upload Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($event_categories as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $events_model->get($value['event_id'])['title'] ?? '' ?></td>
                                    <td><?= $event_fee_category_model->get($value['event_fee_category_id'])['name'] ?? '' ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit-event-fee-subcategory/' . $value['id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url('admin/delete-event-fee-subcategory/' . $value['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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
        $('#event_id').on('change', function() {
            var event_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>get_event_fee_category",
                data: {
                    event_id: event_id
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#event_fee_category_id').empty();
                    $.each(data, function(key, value) {
                        $('#event_fee_category_id').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        })
    });
</script>

<?= $this->endSection() ?>