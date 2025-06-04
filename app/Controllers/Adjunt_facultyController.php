<?php

namespace App\Controllers;

use App\Models\Adjunt_faculty_notification_model;
use App\Models\Adjunt_faculty_video_model;
use App\Models\Adjunt_faculty_webpage_model;
use App\Models\Adjunt_other_faculty_designation_map_model;
use App\Models\Adjunt_other_faculty_model;
use App\Models\Designation_model;

class Adjunt_facultyController extends BaseController
{
    public function other_faculty()
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $designation_model = new Designation_model();
        $adjunt_other_faculty_model = new Adjunt_other_faculty_model();
        $adjunt_other_faculty_designation_map_model = new Adjunt_other_faculty_designation_map_model();
        $data = ['title' => 'Other Facuty Details'];
        if ($this->request->is("get")) {
            $data['designation'] = $designation_model->get();
          	$data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            $data['adjunt_other_faculty'] = $adjunt_other_faculty_model->get();
            return view('admin/adjunt_faculty/other-faculty',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $photo = $this->request->getFile('photo');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "file".$photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $photoNewName);    
            }else{
                $photoNewName = "";
            }

            $resume = $this->request->getFile('resume');
            if ($resume->isValid() && ! $resume->hasMoved()) {
                $resumeNewName = "file".$resume->getRandomName();
                $resume->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $resumeNewName);    
            }else{
                $resumeNewName = "";
            }

            $data = [
                'annotation' => $this->request->getPost('annotation'),
                'first_name' => $this->request->getPost('first_name'),
                'middle_name' => $this->request->getPost('middle_name'),
                'last_name' => $this->request->getPost('last_name'),
                'personal_email' => $this->request->getPost('personal_email'),
                'official_email' => $this->request->getPost('official_email'),
                'mobile' => $this->request->getPost('mobile'),
                'linkedin' => $this->request->getPost('linkedin'),
                'twitter' => $this->request->getPost('twitter'),
                'facebook' => $this->request->getPost('facebook'),
                'research_interest' => $this->request->getPost('research_interest'),
                'description' => $this->request->getPost('description'),
                'photo' => $photoNewName,
                'resume' => $resumeNewName,
                //'faculty_type' => $this->request->getPost('faculty_type'),
              	'adjunt_faculty_webpage_id' => $this->request->getPost('adjunt_faculty_webpage_id'),
                'status' => $this->request->getPost('status'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_other_faculty_model->add($data);
            if ($result === true) {
                $insertId = $adjunt_other_faculty_model->getInsertID();
                $designation = $this->request->getPost('designation');
                $organisation_name = $this->request->getPost('organisation_name');
                $organisation_address = $this->request->getPost('organisation_address');
                if(!empty($designation)){
                    foreach ($designation as $key => $value) {
                        $data = [
                            'adjunt_faculty_id' => $insertId,
                            'designation' => $value,
                            'organisation_name' => $organisation_name[$key],
                            'organisation_address' => $organisation_address[$key]
                        ];
                        $result = $adjunt_other_faculty_designation_map_model->add($data);
                    }
                }
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/other-faculty')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function adjunt_faculty_webpage()
    {
        $adjunt_faculty_webpage_model = new Adjunt_faculty_webpage_model();
        $data = ['title' => 'Adjunt Facuty Webpage'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_webpage'] = $adjunt_faculty_webpage_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-webpage',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $data = [
                'section_title' => $this->request->getPost('section_title'),
                'section_description' => $this->request->getPost('section_description'),
                'section_priority' => $this->request->getPost('section_priority'),
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_webpage_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-webpage')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-webpage')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function adjunt_faculty_notification()
    {
        $adjunt_faculty_notification_model = new Adjunt_faculty_notification_model();
        $data = ['title' => 'Adjunt Facuty Notification'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_notification'] = $adjunt_faculty_notification_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-notification',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $photo = $this->request->getFile('notification_file');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "notification".$photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $photoNewName);    
            }else{
                $photoNewName = "";
            }

            $data =[
                'notification_title' => $this->request->getPost('notification_title'),
                'notification_description' => $this->request->getPost('notification_description'),
                'notification_date' => $this->request->getPost('notification_date'),
                'notification_file' => $photoNewName,
                'notification_marquee' => $this->request->getPost('notification_marquee') ?? 0,
                'upload_by' => $loggeduserId
            ];

            $result = $adjunt_faculty_notification_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-notification')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-notification')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function adjunt_faculty_video()
    {
        $adjunt_faculty_video_model = new Adjunt_faculty_video_model();
        $data = ['title' => 'Adjunt Facuty Video'];
        if ($this->request->is("get")) {
            $data['adjunt_faculty_video'] = $adjunt_faculty_video_model->get();
            return view('admin/adjunt_faculty/adjunt-faculty-video',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            $video = $this->request->getFile('video_file');
            if ($video->isValid() && ! $video->hasMoved()) {
                $videoNewName = "video".$video->getRandomName();
                $video->move(ROOTPATH . 'public/admin/uploads/adjunt_faculty', $videoNewName);    
            }else{
                $videoNewName = "";
            }

            $data = [
                'video_title' => $this->request->getPost('video_title'),
                'video_description' => $this->request->getPost('video_description'),
                'video_file' => $videoNewName,
                'video_venue' => $this->request->getPost('video_venue'),
                'video_datetime' => $this->request->getPost('video_datetime'),
                'upload_by' => $loggeduserId
            ];
            $result = $adjunt_faculty_video_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/adjunt-faculty-video')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/adjunt-faculty-video')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
