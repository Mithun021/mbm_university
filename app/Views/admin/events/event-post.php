<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Employee_model;
use App\Models\Event_category_model;

$employee_model = new Employee_model();
$event_category_model = new Event_category_model();
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
                <form method="post" action="<?= base_url('admin/event-post') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Title<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="event_title" required minlength="5">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Event Theme title</span>
                                <textarea class="form-control form-control-sm" name="event_theme_title"  id="editor2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Desription</span>
                                <textarea id="editor" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Event Category<span class="text-danger">*</span></span>
                                <select name="event_category" id="event_category" class="form-control form-control-sm" required>
                                    <option value="">Select Event Type</option>
                                    <?php foreach ($event_category as $value) { ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Registration Link</span>
                                <input type="url" class="form-control form-control-sm" name="reg_link" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Meeting Link</span>
                                <input type="url" class="form-control form-control-sm" name="meeting_link" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Event Venue</span>
                                <input type="text" class="form-control form-control-sm" name="event_venue" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span for="">Upload File(JPG,PNG)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="event_file" accept=".jpg, .png, .jpeg" required>
                            </div>
                        </div>
                      	<div class="col-md-3">
                            <div class="form-group">
                                <span for="">Event Report(PDF)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="event_report_file" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span for="">Event Start Date<span class="text-danger">*</span></span>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="event_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span for="">Event Start Time</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="event_start_time" placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span for="">Event End Date and Time</span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="event_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="event_end_time" placeholder="End Date" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Registration Start Date & Time</span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="reg_start_date" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="reg_start_time" placeholder="Start Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Registration End Date & Time</span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="reg_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="reg_end_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Payment Link</span>
                                <input type="url" class="form-control form-control-sm" name="payment_link">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Payment End Date & Time</span>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="payment_end_date" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <input type="text" class="form-control form-control-sm" name="payment_end_time" placeholder="End Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span for="">Participant Seats</span>
                                <input type="text" class="form-control form-control-sm" name="participant_seats">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span for="">Participant Eligibility</span>
                                <textarea class="form-control form-control-sm" name="participant_eligibility" id="editor3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Marquee Status</span>
                                <select name="marquee_status" id="marquee_status" class="form-control form-control-sm">
                                    <option value="0" selected>Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Status</span>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1">Publish</option>
                                    <option value="2">Archive</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span><input type="checkbox" name="icc_event" id="" value="1">Check for IIC event</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <span><input type="checkbox" name="institute_event" id="" value="1">Institute event type</span>
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
                                <td>Files/Report</td>
                                <td>Status / Marquee</td>
                                <td>Title</td>
                                <td>Event Type</td>
                                <td>Event Date</td>
                                <td>Reg. Date & Time</td>
                                <td>Participant Seats</td>
                              	<td>ICC EVent / Inst. Event</td>
                                <td>Upload by</td>
                                <!-- <td>Create at</td> -->
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php if (!empty($value['upload_file']) && file_exists('public/admin/uploads/events/' . $value['upload_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/events/<?= $value['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/uploads/events/<?= $value['upload_file'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>

                                        <?php if (!empty($value['event_report_file']) && file_exists('public/admin/uploads/events/' . $value['event_report_file'])): ?>
                                            <a href="<?= base_url() ?>public/admin/uploads/events/<?= $value['event_report_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/admin/uploads/events/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?=
                                        ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Draft</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : (($value['status'] == "2") ? "<span class='badge badge-warning badge-pill'>Archive</span>" : ""))
                                        ?> /
                                        <?= ($value['marquee_status'] == "0") ? "<span class='badge badge-danger badge-pill'>Marquee Inactive</span>" : (($value['marquee_status'] == "1") ? "<span class='badge badge-success badge-pill'>Marquee Active</span>" : "") ?>
                                    </td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?php $event_category = $event_category_model->get($value['event_category']);
                                        echo $event_category['name'] ?? ''; ?></td>
                                    <td><?= date("d:M:Y", strtotime($value['event_start_date'])) ?> <?= date("h:i A", strtotime($value['event_start_time'])) ?> - <br><?= date("d:M:Y", strtotime($value['event_end_date'])) ?> <?= date("h:i A", strtotime($value['event_end_time'])) ?></td>
                                    <td><?= date("d:M:Y", strtotime($value['reg_start_date'])) ?> <?= date("h:i A", strtotime($value['reg_start_time'])) ?> - <br><?= date("d:M:Y", strtotime($value['reg_end_date'])) ?> <?= date("h:i A", strtotime($value['reg_end_time'])) ?></td>
                                    <td><?= $value['participant_seats'] ?></td>
                                  	<td>
                                  		<?= ($value['icc_events'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($value['icc_events'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?> /
                                        <?= ($value['institute_event'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($value['institute_event'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?>
                                  	</td>
                                  	<td><?php $emp = $employee_model->get($value['upload_by']);
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']  ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            <a href="#" class="btn btn-dark waves-effect waves-light"><i class="far fa-eye"></i></a>
                                            <a href="<?= base_url() ?>admin/edit-event-post/<?= $value['id'] ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url() ?>admin/delete-event-post/<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure...')"><i class="far fa-trash-alt"></i></a>
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