<?php
    namespace App\Controllers;
    use App\Models\Department_model;
    use App\Models\Designation_model;
    use App\Models\Employee_model;
use App\Models\Event_category_model;
use App\Models\Event_contact_info_model;
use App\Models\Event_extension_model;
use App\Models\Event_fee_category_model;
use App\Models\Event_fee_subcategory_model;
use App\Models\Event_fees_model;
use App\Models\Event_gallery_model;
use App\Models\Event_highlights_model;
use App\Models\Event_link_model;
use App\Models\Event_members_model;
use App\Models\Event_organizer_model;
use App\Models\Event_video_model;
use App\Models\Events_model;
use App\Models\Member_type_model;
use App\Models\Program_department_mapping_model;
    use App\Models\Program_model;

    
    class EventsController extends BaseController{
        public function event_post(){
            $events_model = new Events_model();
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Post'];
            if ($this->request->is("get")) {
                $data['event_category'] = $event_category_model->get();
                // print_r($data['event_categories']); die;
                $data['events'] = $events_model->get();
                return view('admin/events/event-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }

                $event_file = $this->request->getFile('event_file');
                if ($event_file->isValid() && ! $event_file->hasMoved()) {
                    $event_fileNewName = "file".$event_file->getRandomName();
                    $event_file->move(ROOTPATH . 'public/admin/uploads/events', $event_fileNewName);    
                }else{
                 $event_fileNewName = "";
                }

                $event_report_file = $this->request->getFile('event_report_file');
                if ($event_report_file->isValid() && ! $event_report_file->hasMoved()) {
                    $event_report_fileNewName = "report".$event_report_file->getRandomName();
                    $event_report_file->move(ROOTPATH . 'public/admin/uploads/events', $event_report_fileNewName);    
                }else{
                 $event_report_fileNewName = "";
                }

                $data = [
                    'title' => $this->request->getPost('event_title'),
                    'event_theme_title' => $this->request->getPost('event_theme_title'),
                    'description' => $this->request->getPost('description'),
                    'event_category' => $this->request->getPost('event_category'),
                    'registration_link' => $this->request->getPost('reg_link'),
                    'meeting_link' => $this->request->getPost('meeting_link'),
                    'venue' => $this->request->getPost('event_venue'),
                    'upload_file' => $event_fileNewName,
                    'event_report_file' => $event_report_fileNewName,
                    'event_start_date' => $this->request->getPost('event_start_date'),
                    'event_end_date' => $this->request->getPost('event_end_date'),
                    'event_start_time' => $this->request->getPost('event_start_date'),
                    'event_end_time' => $this->request->getPost('event_start_time'),
                    'reg_start_date' => $this->request->getPost('event_end_time'),
                    'reg_start_time' => $this->request->getPost('reg_start_time'),
                    'reg_end_date' => $this->request->getPost('reg_end_date'),
                    'reg_end_time' => $this->request->getPost('reg_end_time'),
                    'payment_link' => $this->request->getPost('payment_link'),
                    'payment_end_date' => $this->request->getPost('payment_end_date'),
                    'payment_end_time' => $this->request->getPost('payment_end_time'),
                    'participant_seats' => $this->request->getPost('participant_seats'),
                    'participant_eligibility' => $this->request->getPost('participant_eligibility'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'icc_events' => $this->request->getPost('icc_event') ?? 0,
                    'institute_event' => $this->request->getPost('institute_event') ?? 0,
                    'upload_by' => $loggeduserId,
                ];

                $result = $events_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-post')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-post')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function edit_event_post($id){
            $events_model = new Events_model();
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Post','event_id' => $id];
            if ($this->request->is("get")) {
                $data['event_category'] = $event_category_model->get();
                $data['events'] = $events_model->get();
                $data['events_detail'] = $events_model->get($id);
                // echo "<pre>"; print_r($data['events_detail']); die;
                return view('admin/events/edit-event-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $events_detail = $events_model->get($id);

                $new_event_file = $this->request->getFile('event_file');
                $old_image_name =  $events_detail['upload_file'];
                if ($new_event_file->isValid() && !$new_event_file->hasMoved()) {
                    if(file_exists("public/admin/uploads/events/".$old_image_name)){
                        unlink("public/admin/uploads/events/".$old_image_name);
                    }
                    $new_image_name = $new_event_file->getRandomName();
                    $new_event_file->move(ROOTPATH.'public/admin/uploads/events/', $new_image_name);
                }
                else{
                    $new_image_name = $old_image_name;
                }     

                $new_event_report_file = $this->request->getFile('event_report_file');
                $old_event_report_file = $events_detail['event_report_file'];

                if (empty($old_event_report_file)) {
                    if ($new_event_report_file->isValid() && !$new_event_report_file->hasMoved()) {
                        $new_report_file = "report" . $new_event_report_file->getRandomName();
                        $new_event_report_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_report_file);
                    } else {
                        $new_report_file = null;
                    }
                } else {
                    if ($new_event_report_file->isValid() && !$new_event_report_file->hasMoved()) {
                        if (file_exists("public/admin/uploads/events/" . $old_event_report_file)) {
                            unlink("public/admin/uploads/events/" . $old_event_report_file);
                        }
                        $new_report_file = "report" . $new_event_report_file->getRandomName();
                        $new_event_report_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_report_file);
                    } else {
                        $new_report_file = $old_event_report_file;
                    }
                }

                $data = [
                    'title' => $this->request->getPost('event_title'),
                    'event_theme_title' => $this->request->getPost('event_theme_title'),
                    'description' => $this->request->getPost('description'),
                    'event_category' => $this->request->getPost('event_category'),
                    'registration_link' => $this->request->getPost('reg_link'),
                    'meeting_link' => $this->request->getPost('meeting_link'),
                    'venue' => $this->request->getPost('event_venue'),
                    'upload_file' => $new_image_name,
                    'event_report_file' => $new_report_file,
                    'event_start_date' => $this->request->getPost('event_start_date'),
                    'event_end_date' => $this->request->getPost('event_end_date'),
                    'event_start_time' => $this->request->getPost('event_start_date'),
                    'event_end_time' => $this->request->getPost('event_start_time'),
                    'reg_start_date' => $this->request->getPost('event_end_time'),
                    'reg_start_time' => $this->request->getPost('reg_start_time'),
                    'reg_end_date' => $this->request->getPost('reg_end_date'),
                    'reg_end_time' => $this->request->getPost('reg_end_time'),
                    'payment_link' => $this->request->getPost('payment_link'),
                    'payment_end_date' => $this->request->getPost('payment_end_date'),
                    'payment_end_time' => $this->request->getPost('payment_end_time'),
                    'participant_seats' => $this->request->getPost('participant_seats'),
                    'participant_eligibility' => $this->request->getPost('participant_eligibility'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'icc_events' => $this->request->getPost('icc_event') ?? 0,
                    'institute_event' => $this->request->getPost('institute_event') ?? 0,
                    'upload_by' => $loggeduserId,
                ];

                $result = $events_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-post/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-post/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function delete_event_post($id){
            $events_model = new Events_model();
            $events_detail = $events_model->get($id);
            $old_image_name =  $events_detail['upload_file'];

            if(file_exists("public/admin/uploads/events/".$old_image_name)){
                unlink("public/admin/uploads/events/".$old_image_name);
            }
            
            $old_event_report_file = $events_detail['event_report_file'];
            if (!empty($old_event_report_file) && file_exists("public/admin/uploads/events/" . $old_event_report_file)) {
                unlink("public/admin/uploads/events/" . $old_event_report_file);
            }
                
            $delete = $events_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-post')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-post')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }


        public function event_link(){
            $events_model = new Events_model();
            $event_link_model = new Event_link_model();
            $data = ['title' => 'Event Link'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_link'] = $event_link_model->get();
                return view('admin/events/event-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'link_description' => $this->request->getPost('link_description'),
                    'event_link' => $this->request->getPost('event_link'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_link_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_link($id){
            $events_model = new Events_model();
            $event_link_model = new Event_link_model();
            $data = ['title' => 'Event Link', 'event_link_id' => $id];
            $data['event_link_detail'] = $event_link_model->get($id);
            if ($this->request->is("get")) {
                // print_r($data['event_link_detail']); die;
                $data['events'] = $events_model->get();
                $data['event_link'] = $event_link_model->get();
                return view('admin/events/edit-event-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'link_description' => $this->request->getPost('link_description'),
                    'event_link' => $this->request->getPost('event_link'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_link_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-link/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-link/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_link($id){
            $event_link_model = new Event_link_model();
            $delete = $event_link_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-link')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-link')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_video(){
            $events_model = new Events_model();
            $event_video_model = new Event_video_model();
            $data = ['title' => 'Event Video'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_video'] = $event_video_model->get();
                return view('admin/events/event-video',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'title' => $this->request->getPost('video_title'),
                    'description' => $this->request->getPost('video_description'),
                    'vodeo_link' => $this->request->getPost('video_link'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_video_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-video')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-video')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_video($id){
            $events_model = new Events_model();
            $event_video_model = new Event_video_model();
            $data = ['title' => 'Event Video', 'event_video_id' => $id];
            $data['event_video_detail'] = $event_video_model->get($id);
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_video'] = $event_video_model->get();
                return view('admin/events/edit-event-video',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'title' => $this->request->getPost('video_title'),
                    'description' => $this->request->getPost('video_description'),
                    'vodeo_link' => $this->request->getPost('video_link'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_video_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-video/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-video/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_video($id){
            $event_video_model = new Event_video_model();
            $delete = $event_video_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-video')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-video')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_members(){
            $events_model = new Events_model();
            $member_type_model = new Member_type_model();
            $employee_model =new Employee_model();
            $event_members_model = new Event_members_model();
            $data = ['title' => 'Event Members'];
            if ($this->request->is("get")) {
                $data['member_type'] = $member_type_model->get();
                $data['events'] = $events_model->get();
                $data['employees'] = $employee_model->get();
                $data['event_members'] = $event_members_model->get();
                return view('admin/events/event-members',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }

                $member_name = $this->request->getPost('member_name');
                $member_file = $this->request->getFileMultiple('upload_file');
                foreach ($member_name as $key => $value) {
                    $file = $member_file[$key];
                    $fileName = "";
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = "membersFile".$file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/events', $fileName);
                    }
                    $data =[
                        'event_id' => $this->request->getPost('event_id'),
                        'member_name' => $value,
                        'member_type' => $this->request->getPost('member_type'),
                        'member_designation' => $this->request->getPost('member_designation')[$key],
                        'other_designation' => $this->request->getPost('member_desig_other')[$key] ?? '',
                        'member_affiliation' => $this->request->getPost('member_affiliation')[$key],
                        'upload_file' => $fileName,
                        'upload_by' => $loggeduserId,
                    ];
                    // echo "<pre>"; print_r($data);
                    $result = $event_members_model->add($data);
                }
                // die;
                
                if ($result === true) {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-members')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_members($id){
            $events_model = new Events_model();
            $member_type_model = new Member_type_model();
            $employee_model =new Employee_model();
            $event_members_model = new Event_members_model();
            $data = ['title' => 'Event Members', 'title2' => 'Update Event Members', 'event_member_id' => $id];
            $data['event_members_detail'] = $event_members_model->get($id);
            if ($this->request->is("get")) {
                $data['member_type'] = $member_type_model->get();
                $data['events'] = $events_model->get();
                $data['employees'] = $employee_model->get();
                $data['event_members'] = $event_members_model->get();
                return view('admin/events/edit-event-members',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }

                $new_member_file = $this->request->getFile('upload_file');

                $event_members_detail = $event_members_model->get($id);
                $old_member_file = $event_members_detail['upload_file'];

                if (empty($old_member_file)) {
                    if ($new_member_file->isValid() && !$new_member_file->hasMoved()) {
                        $new_member_file_name = "membersFile" . $new_member_file->getRandomName();
                        $new_member_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_member_file_name);
                    } else {
                        $new_member_file_name = null;
                    }
                } else {
                    if ($new_member_file->isValid() && !$new_member_file->hasMoved()) {
                        if (file_exists("public/admin/uploads/events/" . $old_member_file)) {
                            unlink("public/admin/uploads/events/" . $old_member_file);
                        }
                        $new_member_file_name = "membersFile" . $new_member_file->getRandomName();
                        $new_member_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_member_file_name);
                    } else {
                        $new_member_file_name = $old_member_file;
                    }
                }

                $data =[
                    'event_id' => $this->request->getPost('event_id'),
                    'member_name' => $this->request->getPost('member_name'),
                    'member_type' => $this->request->getPost('member_type'),
                    'member_designation' => $this->request->getPost('member_designation'),
                    'other_designation' => $this->request->getPost('member_desig_other') ?? '',
                    'member_affiliation' => $this->request->getPost('member_affiliation'),
                    'upload_file' => $new_member_file_name,
                    'upload_by' => $loggeduserId,
                ];
               
                $result = $event_members_model->add($data,$id);
                
                if ($result === true) {
                    return redirect()->to('admin/edit-event-members/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-members/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_members($id){
            $event_members_model = new Event_members_model();
            $delete = $event_members_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-members')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-members')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }


        public function event_organizer(){
            $events_model = new Events_model();
            $event_organizer_model = new Event_organizer_model();
            $data = ['title' => 'Event Organizer'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_organizers'] = $event_organizer_model->get();
                return view('admin/events/event-organizer',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'organizer_type' => $this->request->getPost('evtorg_type'),
                    'organizer_name' => $this->request->getPost('evtorg_name'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_organizer_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_organizer($id){
            $events_model = new Events_model();
            $event_organizer_model = new Event_organizer_model();
            $data = ['title' => 'Event Organizer','event_organizer_id' => $id];
            $data['event_organizers_detail'] = $event_organizer_model->get($id);
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_organizers'] = $event_organizer_model->get();
                return view('admin/events/edit-event-organizer',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'organizer_type' => $this->request->getPost('evtorg_type'),
                    'organizer_name' => $this->request->getPost('evtorg_name'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_organizer_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-organizer/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-organizer/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_organizer($id){
            $event_organizer_model = new Event_organizer_model();
            $delete = $event_organizer_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-organizer')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_fees(){
            $events_model = new Events_model();
            $event_fees_model = new Event_fees_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fees'];
            if ($this->request->is("get")) {
                $data['events_fee'] = $event_fee_category_model->get();
                $data['events'] = $events_model->get();
                $data['event_fees'] = $event_fees_model->get();
                return view('admin/events/event-fees',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'fee_type' => $this->request->getPost('evtfeestype'),
                    'evtfeesvalue' => $this->request->getPost('evtfeesvalue'),
                    'event_fees' => $this->request->getPost('evtfees'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_fees_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_fees($id){
            $events_model = new Events_model();
            $event_fees_model = new Event_fees_model();
            $event_fee_category_model = new Event_fee_category_model();
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $data = ['title' => 'Event Fees','event_fees_id' => $id];
            $data['event_fees_detail'] = $event_fees_model->get($id);
            $data['fee_category_detail'] = $event_fee_category_model->getEventFeeCategories($data['event_fees_detail']['event_id']);
            $data['fee_subcategory_detail'] = $event_fee_subcategory_model->getEventFeeSubcategories($data['event_fees_detail']['event_id'],$data['event_fees_detail']['fee_type']);

            if ($this->request->is("get")) {
                $data['events_fee'] = $event_fee_category_model->get();
                $data['events'] = $events_model->get();
                $data['event_fees'] = $event_fees_model->get();
                return view('admin/events/edit-event-fees',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'fee_type' => $this->request->getPost('evtfeestype'),
                    'evtfeesvalue' => $this->request->getPost('evtfeesvalue'),
                    'event_fees' => $this->request->getPost('evtfees'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $event_fees_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-fees/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-fees/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_fees($id){
            $event_fees_model = new Event_fees_model();
            $delete = $event_fees_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-fees')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_highlight(){
            $event_gallery_model = new Event_gallery_model();
            $events_model = new Events_model();
            // $event_highlights_model = new Event_highlights_model();
            $data = ['title' => 'Event Gallery'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_gallery'] = $event_gallery_model->get();
                // $data['event_highlights'] = $event_highlights_model->get();
                return view('admin/events/event-highlight',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $gallery_file = $this->request->getFiles();
                if ($gallery_file) {
                    foreach ($gallery_file['gallery_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/event_gallery', $newName);
                
                            $data = [
                                'event_id' => $this->request->getPost('event_id'),
                                'gallery_file' => $newName,
                                'upload_by' => $loggeduserId,
                            ];
                
                            $result = $event_gallery_model->save($data);
                        }
                    }
                }
                if ($result === true) {
                    return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_highlight($id){
            $event_gallery_model = new Event_gallery_model();
            $events_model = new Events_model();
            // $event_highlights_model = new Event_highlights_model();
            $data = ['title' => 'Event Highlight','event_highlight_id' => $id];
            $data['event_highlights_detail'] = $event_gallery_model->get($id);
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_gallery'] = $event_gallery_model->get();
                // $data['event_highlights'] = $event_highlights_model->get();
                return view('admin/events/edit-event-highlight',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $gallery_file = $this->request->getFile('gallery_file');
                $event_highlights_detail = $event_gallery_model->get($id);
                $old_image_name =  $event_highlights_detail['gallery_file'];

                if ($gallery_file->isValid() && !$gallery_file->hasMoved()) {
                    if(file_exists("public/admin/uploads/event_gallery/".$old_image_name)){
                        unlink("public/admin/uploads/event_gallery/".$old_image_name);
                    }
                    $new_image_name = $gallery_file->getRandomName();
                    $gallery_file->move(ROOTPATH.'public/admin/uploads/event_gallery/', $new_image_name);
                }
                else{
                    $new_image_name = $old_image_name;
                }
                
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'gallery_file' => $new_image_name,
                    'upload_by' => $loggeduserId,
                ];
    
                $result = $event_gallery_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-highlight/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-highlight/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_highlight($id){
            $event_gallery_model = new Event_gallery_model();

            $event_highlights_detail = $event_gallery_model->get($id);
            $old_image_name =  $event_highlights_detail['gallery_file'];
            if(file_exists("public/admin/uploads/event_gallery/".$old_image_name)){
                unlink("public/admin/uploads/event_gallery/".$old_image_name);
            }
            $delete = $event_gallery_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-highlight')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_category(){
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Category'];
            if ($this->request->is("get")) {
                $data['event_categories'] = $event_category_model->get();
                return view('admin/events/event-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_category_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_category($id){
            $event_category_model = new Event_category_model();
            $data = ['title' => 'Event Category','event_category_id' => $id];
            $data['event_category_detail'] = $event_category_model->get($id);
            if ($this->request->is("get")) {
                $data['event_categories'] = $event_category_model->get();
                return view('admin/events/edit-event-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_category_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-category/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-category/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function delete_event_category($id){
            $event_category_model = new Event_category_model();
            $delete = $event_category_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-category')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-category')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_fee_category(){
            $events_model = new Events_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Category'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_category_model->get();
                return view('admin/events/event-fee-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_category_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_fee_category($id){
            $events_model = new Events_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Category','event_fee_category_id' => $id];
            $data['event_fee_category_detail'] = $event_fee_category_model->get($id);
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_category_model->get();
                return view('admin/events/edit-event-fee-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_category_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-fee-category/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-fee-category/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_fee_category($id){
            $event_fee_category_model = new Event_fee_category_model();
            $delete = $event_fee_category_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-fee-category')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_extension_notice() {
            $events_model = new Events_model();
            $event_extension_model = new Event_extension_model();
            $data = ['title' => 'Event Extension Notice'];
            if ($this->request->is('get')) {
                $data['events'] = $events_model->get();
                $data['event_extension'] = $event_extension_model->get();
                return view('admin/events/event-extension-notice',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $extension_file = $this->request->getFile('extension_file');
                if ($extension_file->isValid() && ! $extension_file->hasMoved()) {
                    $extension_fileNewName = "ext".$extension_file->getRandomName();
                    $extension_file->move(ROOTPATH . 'public/admin/uploads/events', $extension_fileNewName);    
                }else{
                 $extension_fileNewName = "";
                }

                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'extension_status' => $this->request->getPost('extension_status'),
                    'extension_notice_file' => $extension_fileNewName,
                    'extension_end_date' => $this->request->getPost('extension_end_date'),
                    'extension_end_time' => $this->request->getPost('extension_end_time'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_extension_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_extension_notice($id) {
            $events_model = new Events_model();
            $event_extension_model = new Event_extension_model();
            $data = ['title' => 'Event Extension Notice', 'event_extension_id' => $id];
            $data['event_extension_detail'] = $event_extension_model->get($id);
            if ($this->request->is('get')) {
                $data['events'] = $events_model->get();
                $data['event_extension'] = $event_extension_model->get();
                return view('admin/events/edit-event-extension-notice',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $event_extension_detail = $event_extension_model->get($id);
                $extension_file = $this->request->getFile('extension_file');
                $old_event_extension_file = $event_extension_detail['extension_notice_file'];

                if (empty($old_event_extension_file)) {
                    if ($extension_file->isValid() && !$extension_file->hasMoved()) {
                        $new_extension_file = "ext" . $extension_file->getRandomName();
                        $extension_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_extension_file);
                    } else {
                        $new_extension_file = null;
                    }
                } else {
                    if ($extension_file->isValid() && !$extension_file->hasMoved()) {
                        if (file_exists("public/admin/uploads/events/" . $old_event_extension_file)) {
                            unlink("public/admin/uploads/events/" . $old_event_extension_file);
                        }
                        $new_extension_file = "report" . $extension_file->getRandomName();
                        $extension_file->move(ROOTPATH . 'public/admin/uploads/events/', $new_extension_file);
                    } else {
                        $new_extension_file = $old_event_extension_file;
                    }
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'extension_status' => $this->request->getPost('extension_status'),
                    'extension_notice_file' => $new_extension_file,
                    'extension_end_date' => $this->request->getPost('extension_end_date'),
                    'extension_end_time' => $this->request->getPost('extension_end_time'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_extension_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-extension-notice/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-extension-notice/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_extension_notice($id){
            $event_extension_model = new Event_extension_model();
            $events_detail = $event_extension_model->get($id);

            $extension_notice_file = $events_detail['extension_notice_file'];
            if (!empty($extension_notice_file) && file_exists("public/admin/uploads/events/" . $extension_notice_file)) {
                unlink("public/admin/uploads/events/" . $extension_notice_file);
            }
                
            $delete = $event_extension_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-extension-notice')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function member_type_category() {
            $member_type_model = new Member_type_model();
            $data = ['title' => 'Event Member Type'];
            if ($this->request->is('get')) {
                $data['member_type'] = $member_type_model->get();
                return view('admin/events/member_type_category',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'member_type' => $this->request->getPost('member_type'),
                    'upload_by' => $loggeduserId
                ];
                $result = $member_type_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_member_type_category($id) {
            $member_type_model = new Member_type_model();
            $data = ['title' => 'Event Member Type','member_category_id' => $id];
            $data['member_type_detail'] = $member_type_model->get($id);
            if ($this->request->is('get')) {
                $data['member_type'] = $member_type_model->get();
                return view('admin/events/edit_member_type_category',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'member_type' => $this->request->getPost('member_type'),
                    'upload_by' => $loggeduserId
                ];
                $result = $member_type_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit_member_type_category/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit_member_type_category/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function delete_member_type_category($id){
            $member_type_model = new Member_type_model();
            $delete = $member_type_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/member_type_category')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_fee_subcategory(){
            $events_model = new Events_model();
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Sub Category'];
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_subcategory_model->get();
                return view('admin/events/event-fee-subcategory',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'event_fee_category_id' => $this->request->getPost('event_fee_category_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_subcategory_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
                
                
            }
        }


        public function edit_event_fee_subcategory($id){
            $events_model = new Events_model();
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $event_fee_category_model = new Event_fee_category_model();
            $data = ['title' => 'Event Fee Sub Category','event_fee_subcategory_id' => $id];
            $data['event_fee_subcategory_detail'] = $event_fee_subcategory_model->get($id);
            $data['fee_subcategory_detail'] = $event_fee_category_model->getEventFeeCategories($data['event_fee_subcategory_detail']['event_id']);
            if ($this->request->is("get")) {
                $data['events'] = $events_model->get();
                $data['event_categories'] = $event_fee_subcategory_model->get();
                return view('admin/events/edit-event-fee-subcategory',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'event_fee_category_id' => $this->request->getPost('event_fee_category_id'),
                    'name' => $this->request->getPost('event_category'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_fee_subcategory_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-fee-subcategory/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-fee-subcategory/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_fee_subcategory($id){
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $result = $event_fee_subcategory_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-fee-subcategory')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function event_contact_info(){
            $designation_model = new Designation_model();
            $events_model = new Events_model();
            $event_contact_info_model = new Event_contact_info_model();
            $data = ['title' => 'Event Contact Info'];
            if ($this->request->is("get")) {
                $data['events_contact'] = $event_contact_info_model->get();
                $data['events'] = $events_model->get();
                $data['designation'] = $designation_model->get();
                return view('admin/events/event-contact-info',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone_number' => $this->request->getPost('phone'),
                    'designation' => $this->request->getPost('designation'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_contact_info_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/event-contact-info')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/event-contact-info')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_event_contact_info($id){
            $designation_model = new Designation_model();
            $events_model = new Events_model();
            $event_contact_info_model = new Event_contact_info_model();
            $data = ['title' => 'Event Contact Info','event_contact_info_id' => $id];
            $data['event_contact_info_detail'] = $event_contact_info_model->get($id);
            if ($this->request->is("get")) {
                $data['events_contact'] = $event_contact_info_model->get();
                $data['events'] = $events_model->get();
                $data['designation'] = $designation_model->get();
                return view('admin/events/edit-event-contact-info',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }else{
                    return redirect()->to(base_url('admin/login'));
                }
                $data = [
                    'event_id' => $this->request->getPost('event_id'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone_number' => $this->request->getPost('phone'),
                    'designation' => $this->request->getPost('designation'),
                    'upload_by' => $loggeduserId
                ];
                $result = $event_contact_info_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-event-contact-info/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-event-contact-info/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_event_contact_info($id){
            $event_contact_info_model = new Event_contact_info_model();
            $delete = $event_contact_info_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/event-contact-info')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/event-contact-info')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

    }
?>