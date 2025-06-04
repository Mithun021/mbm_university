<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php

use App\Models\Department_model;
use App\Models\Employee_model;
use App\Models\Instruments_model;

$employee_model = new Employee_model();
$department_model = new Department_model();
$instruments_model = new Instruments_model();

?>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>
    .fc-h-event .fc-event-title{
        font-size: 9px;
        text-wrap: break-word;
        white-space: normal;
        color: #000;
    }
</style>

<!-- Page Title -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add to <?= $title ?></h4>
            </div>
            <div class="card-body p-1">
                <?php if (session()->getFlashdata('status')) echo session()->getFlashdata('status'); ?>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Date / Day</td>
                                <td>Department</td>
                                <td>Instrument</td>
                                <td>User Type</td>
                                <td>Booking Time</td>
                                <td>No of Slots</td>
                                <td>Upload by</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($instrument as $slot): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d-m-Y', strtotime($slot['booking_slot_date'])) ?> / <?= $slot['booking_slot_day'] ?></td>
                                    <td><?= $department_model->get($slot['department_id'])['name'] ?></td>
                                    <td><?= $instruments_model->get($slot['instrument_id'])['title'] ?></td>
                                    <td><?= $slot['user_type'] ?></td>
                                    <td><?= date('h:i A', strtotime($slot['booking_start_time'])) ?> - <?= date('h:i A', strtotime($slot['booking_end_time'])) ?></td>
                                    <td><?= $slot['number_of_slots'] ?></td>
                                    <td><?php $emp = $employee_model->get($slot['upload_by']); if($emp){
                                        echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></td>
                                    <td><a href="<?= base_url('admin/delete-instrument-slots/' . $slot['id']) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Slot Booking</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="eventForm">
                <div class="modal-body">
                    <input type="hidden" id="event_date" name="booking_slot_date" readonly>
                    <input type="hidden" id="booking_slot_day" name="booking_slot_day" readonly>

                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select class="form-control" name="department_id" id="department_id" required>
                            <option value="">--Select--</option>
                            <?php foreach ($department as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="instrument_id">Instrument Name</label>
                        <select class="form-control" name="instrument_id" id="instrument_id" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>User Type</label>
                        <select class="form-control" name="user_type" required>
                            <option value="">--Select--</option>
                            <option value="External Student / Faculty">External Student / Faculty</option>
                            <option value="Internal">Internal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Booking Time</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="booking_start_time" placeholder="Start Time" onfocus="this.type='time'" onblur="this.type='text'" required>
                            <input type="text" class="form-control" name="booking_end_time" placeholder="End Time" onfocus="this.type='time'" onblur="this.type='text'" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Number of Slots</label>
                        <input type="number" class="form-control" name="number_of_slots" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Load instruments based on department
    $('#department_id').change(function () {
        var department_id = $(this).val();
        $.ajax({
            url: '<?= base_url('fetch-instrument-by-department') ?>',
            type: 'POST',
            data: { department_id: department_id },
            dataType: 'json',
            beforeSend: function () {
                $('#instrument_id').html('<option value="">--Please Wait--</option>');
            },
            success: function (data) {
                $('#instrument_id').html('<option value="">--Select--</option>');
                $.each(data, function (index, instrument) {
                    $('#instrument_id').append('<option value="' + instrument.id + '">' + instrument.title + '</option>');
                });
            }
        });
    });

    // Initialize calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        eventDisplay: 'html', // Allow HTML in title
        events: '<?= base_url('admin/fetch-instrument-slots') ?>',
        dateClick: function (info) {
            var dateStr = info.dateStr;
            var dayName = new Date(dateStr).toLocaleDateString('en-US', { weekday: 'long' });

            $('#event_date').val(dateStr);
            $('#booking_slot_day').val(dayName);

            $('#eventModal').modal('show');
        }
    });

    calendar.render();

    // Form submit
    $('#eventForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url('admin/create-instrument-slots') ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                $('#eventModal').modal('hide');

                calendar.addEvent({
                    title:
                        $('[name="user_type"]').val() + ' | ' +
                        formatAMPM($('[name="booking_start_time"]').val()) + ' - ' +
                        formatAMPM($('[name="booking_end_time"]').val()) + ' | ' +
                        'Dept: ' + $("#department_id option:selected").text() + ' | ' +
                        'Instrument: ' + $("#instrument_id option:selected").text(),
                    start: $('#event_date').val(),
                    allDay: true
                });

                alert("Slot booked successfully!");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    alert("Validation error: Please fill all required fields.");
                } else {
                    alert("Failed to save event.");
                }
            }
        });
    });

    // Time formatting to AM/PM
    function formatAMPM(timeStr) {
        if (!timeStr) return '';
        const [hourStr, minute] = timeStr.split(':');
        let hour = parseInt(hourStr);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12;
        return hour + ':' + minute + ' ' + ampm;
    }
});
</script>

<?= $this->endSection() ?>