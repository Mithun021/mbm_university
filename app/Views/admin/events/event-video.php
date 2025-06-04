<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Events_model;
    $events_model = new Events_model();
    $employee_model = new Employee_model();
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
                    if(session()->getFlashdata('status')){
                        echo session()->getFlashdata('status');
                    }
                ?>
                <form method="post" action="<?= base_url('admin/event-video') ?>">
                    <div class="form-group">
                        <span>Event ID:</span>
                        <select name="event_id" class="form-control form-control-sm" required>
                            <option value="">Select Event</option>
                            <?php foreach ($events as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span for="">Video Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="video_title" required>
                    </div>
                    <div class="form-group">
                        <span for="">Video Description</span>
                        <input type="text" class="form-control form-control-sm" name="video_description">
                    </div>
                    <div class="form-group">
                        <span for="">Video URL Link<span class="text-danger">*</span></span>
                        <input type="url" class="form-control form-control-sm" name="video_link" required>
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
                            <td>Event Name</td>
                            <td>Video Title</td>
                            <td>Video Description</td>
                            <td>Upload By</td>
                            <td>Upload Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($event_video as $key => $value) { ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $events_model->get($value['event_id'])['title'] ?? '' ?></td>
                            <td><a href="<?= $value['vodeo_link'] ?>" target="_blank"><?= $value['title'] ?></a></td>
                            <td><a href="<?= $value['vodeo_link'] ?>" target="_blank"><?= $value['description'] ?></a></td>
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit-event-video/'.$value['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= base_url('admin/delete-event-video/'.$value['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure...!')">Delete</a>
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