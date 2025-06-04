<?php

namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Instrument_slots_master_model;
use App\Models\Instruments_model;

class InstrumentSlotController extends BaseController
{
    public function create_instrument_slots()
    {
        $department_model = new Department_model();
        $instrument_slots_master_model = new Instrument_slots_master_model();
        $data = ['title' => 'Instrument Slots'];

        if ($this->request->is('get')) {
            $data['department'] = $department_model->activeData();
            $data['instrument'] = $instrument_slots_master_model->get();
            return view('admin/instrument_slots/create-instrument-slots', $data);
        } elseif ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            $loggeduserId = $sessionData['loggeduserId'] ?? null;

            $postData = $this->request->getPost();

            if (!$postData['booking_slot_date'] || !$postData['department_id'] || !$postData['instrument_id']) {
                return $this->response->setStatusCode(422)->setJSON(['status' => 'validation_error']);
            }

            $dataToInsert = [
                'booking_slot_date' => $postData['booking_slot_date'],
                'booking_slot_day' => $postData['booking_slot_day'],
                'department_id' => $postData['department_id'],
                'instrument_id' => $postData['instrument_id'],
                'user_type' => $postData['user_type'],
                'booking_start_time' => $postData['booking_start_time'],
                'booking_end_time' => $postData['booking_end_time'],
                'number_of_slots' => $postData['number_of_slots'],
                'upload_by' => $loggeduserId
            ];

            $result = $instrument_slots_master_model->add($dataToInsert);

            if ($result === true) {
                return $this->response->setJSON(['status' => 'success']);
            }
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error']);
        }
    }

    public function fetch_instrument_slots()
    {
        $model = new Instrument_slots_master_model();
        $department_model = new Department_model();
        $instruments_model = new Instruments_model();

        $slots = $model->findAll();

        $events = [];
        foreach ($slots as $slot) {
            // Format time to AM/PM
            $startTime = date('g:i A', strtotime($slot['booking_start_time']));
            $endTime = date('g:i A', strtotime($slot['booking_end_time']));

            $events[] = [
                'title' => $slot['user_type'] . ' | ' .
                        $startTime . ' - ' . $endTime . ' | ' .
                        'Dept: ' . $department_model->get($slot['department_id'])['name'] . ' | ' .
                        'Instrument: ' . $instruments_model->get($slot['instrument_id'])['title'],
                'start' => $slot['booking_slot_date'],
                'allDay' => true
            ];
        }

        return $this->response->setJSON($events);
    }

    public function delete_instrument_slots($id)
    {
        $model = new Instrument_slots_master_model();
        $result = $model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/create-instrument-slots')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function instrument_booking_report()
    {
        $data = ['title' => 'Instrument Slots Booking'];
        if ($this->request->is('get')) {
            return view('admin/instrument_slots/instrument-booking-report', $data);
        } else if ($this->request->is('post')) {
        }
    }
}
