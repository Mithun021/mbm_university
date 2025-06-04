<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Events_model;

    $employee_model = new Employee_model();
    $events_model = new Events_model();
?>
<style>
</style>

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

                <form action="<?= base_url() ?>admin/event-organizer" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Event ID:</span>
                                <select name="event_id" class="form-control form-control-sm my-select">
                                    <option value="">Select Event</option>
                                <?php foreach ($events as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span>Organizer Type:</span>
                            <select name="evtorg_type" class="form-control form-control-sm" required>
                                <option value="Department">Department</option>
                                <option value="Institute">Institute</option>
                                <option value="Industry">Industry</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <span>Organizer Name:</span>
                            <input type="text" name="evtorg_name" class="form-control form-control-sm" value="<?= old('evtorg_name') ?>" required>
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

                <h4 class="card-title m-0">Events Orgnizer Lists</h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped table-hover" id="basic-datatable">

                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Event ID</td>
                                <td>Organizer Type</td>
                                <td>Organizer Name</td>
                                <td>Upload By</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($event_organizers as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $events_model->get($value['event_id'])['title'] ?></td>
                                    <td><?= $value['organizer_type'] ?></td>
                                    <td><?= $value['organizer_name'] ?></td>
                                    <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/edit-event-organizer/<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>admin/delete-event-organizer/<?= $value['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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