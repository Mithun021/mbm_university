<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Events_model;

    $employee_model = new Employee_model();
    $events_model = new Events_model();
?>
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
                <form method="post" action="<?= base_url() ?>admin/event-extension-notice" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Event ID:</span>
                                <select name="event_id" class="form-control form-control-sm">
                                    <option value="">Select Event</option>
                                    <?php foreach ($events as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension Status</span>
                                <input type="text" class="form-control form-control-sm" name="extension_status">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension Notice File(PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="extension_file" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Extension End Date & Time<span class="text-danger">*</span></span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="extension_end_date" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="extension_end_time" placeholder="Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="basic-datatable" style="width: 120%;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Files</td>
                            <td>Event id</td>
                            <td>Ext. Status</td>
                            <td>Ext. Date & Time</td>
                            <td>Upload by</td>
                            <!-- <td>Create at</td> -->
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($event_extension as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['extension_notice_file']) && file_exists('public/admin/uploads/events/' . $value['extension_notice_file'])): ?>
                                    <a href="<?= base_url() ?>public/admin/uploads/events/<?= $value['extension_notice_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                            </td>
                            <td><?php $event = $events_model->get($value['event_id']); echo $event['title'] ?></td>
                            <td><?= $value['extension_status'] ?></td> 
                            <td><?= date("d:M:Y", strtotime($value['extension_end_date'])) ?> - <?= date("h:i A", strtotime($value['extension_end_time'])) ?></td>      
                            <td><?php $emp = $employee_model->get($value['upload_by']); echo $emp['first_name']." ".$emp['middle_name']." ".$emp['last_name']  ?></td>
                            <!-- <td><?= date("d-m-Y", strtotime($value['created_at'])) ?></td> -->
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <!-- <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a> -->
                                    <a href="<?= base_url() ?>admin/edit-event-extension-notice/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                    <a href="<?= base_url() ?>admin/delete-event-extension-notice/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...!')"><i class="far fa-trash-alt"></i></a>
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