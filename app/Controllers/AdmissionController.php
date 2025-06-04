<?php

namespace App\Controllers;

use App\Models\Admission_page_model;
use App\Models\Admission_page_section_model;
use App\Models\Admission_section_file_model;
use App\Models\Admission_section_images_model;

class AdmissionController extends BaseController
{
    public function admission_page(){
        $admission_page_model = new Admission_page_model();
        $data = ['title' => 'Admission Page'];
        if ($this->request->is("get")) {
            $data['admission'] = $admission_page_model->get();
            return view('admin/admission/admission-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $userPhoto = $this->request->getFile('banner_image');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "page".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/admission', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'banner_image' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_page_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-page')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }


        }
    }

    public function admission_page_section(){
        $admission_page_section_model = new Admission_page_section_model();
        $data = ['title' => 'Admission Page Section'];
        if ($this->request->is("get")) {
            $data['admission'] = $admission_page_section_model->get();
            return view('admin/admission/admission-page-section',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }
            $userPhoto = $this->request->getFile('section_image');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "section".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/admission', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'section_title' => $this->request->getVar('section_title'),
                'section_description' => $this->request->getVar('section_description'),
                'section_priority' => $this->request->getVar('section_priority'),
                'section_image' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_page_section_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-page-section')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-page-section')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function admission_section_image(){
        $admission_page_section_model = new Admission_page_section_model();
        $admission_section_images_model = new Admission_section_images_model();
        $data = ['title' => 'Admission Section Image'];
        if ($this->request->is("get")) {
            $data['admission'] = $admission_page_section_model->get();
            $data['admission_section_images'] = $admission_section_images_model->get();
            return view('admin/admission/admission-section-image',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $userPhoto = $this->request->getFile('image_upload');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "image".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/admission', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'section_id' => $this->request->getVar('section_id'),
                'image_title' => $this->request->getVar('image_title'),
                'image_description' => $this->request->getVar('image_description'),
                'image_upload' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_section_images_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-section-image')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-section-image')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function admission_section_file(){
        $admission_page_section_model = new Admission_page_section_model();
        $admission_section_file_model = new Admission_section_file_model();
        $data = ['title' => 'Admission Section File'];
        if ($this->request->is("get")) {
            $data['admission'] = $admission_page_section_model->get();
            $data['admission_section_file'] = $admission_section_file_model->get();
            return view('admin/admission/admission-section-file',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }else{
                return redirect()->to(base_url('admin/login'));
            }

            $userPhoto = $this->request->getFile('file_upload');
            if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                $userPhotoImageName = "section".$userPhoto->getRandomName();
                $userPhoto->move(ROOTPATH . 'public/admin/uploads/admission', $userPhotoImageName);    
            }else{
                $userPhotoImageName = "";
            }

            $data =[
                'section_id' => $this->request->getVar('section_id'),
                'file_title' => $this->request->getVar('file_title'),
                'file_description' => $this->request->getVar('file_description'),
                'file_notification_date' => $this->request->getVar('file_notification_date'),
                'file_upload' => $userPhotoImageName,
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_section_file_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-section-file')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-section-file')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
