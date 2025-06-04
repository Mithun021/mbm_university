<?php

namespace App\Controllers;

use App\Models\Alumini_page_gallery_model;
use App\Models\Alumini_page_notification_model;
use App\Models\Alumini_page_section_images_model;
use App\Models\Alumini_page_section_model;
use App\Models\Alumini_page_video_model;

class AluminiController extends BaseController
{
    public function alumini_page_notification(){
        $alumini_page_notification_model = new Alumini_page_notification_model();
        $data = ['title' => 'Page Notification Details'];
        if($this->request->is('get')) {
            $data['notification'] = $alumini_page_notification_model->get();
            return view('admin/alumini/alumini-page-notification',$data);
        } else if($this->request->is('post')){
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $file = $this->request->getFile('file_upload');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "notify".$file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/alumini', $fileNewName);    
            }else{
                $fileNewName = "";
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'marquee' => $this->request->getPost('marquee') ?? 0,
                'file_upload' => $fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $alumini_page_notification_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-notification')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/alumini-page-notification')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_alumini_page_notification($id){
        $alumini_page_notification_model = new Alumini_page_notification_model();
        $aluminiData = $alumini_page_notification_model->get($id);
        if ($aluminiData) {
            if (file_exists("public/admin/uploads/alumini/" . $aluminiData['file_upload'])) {
                unlink("public/admin/uploads/alumini/" . $aluminiData['file_upload']);
            }
            $result = $alumini_page_notification_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-notification')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/alumini-page-notification')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
        
    }

    public function alumini_page_section()
    {
        $alumini_page_section_model = new Alumini_page_section_model();
        $alumini_page_section_images_model = new Alumini_page_section_images_model();
        $data = ['title' => 'Page Section Details'];
        if($this->request->is('get')) {
            $data['section'] = $alumini_page_section_model->get();
            return view('admin/alumini/alumini-page-section',$data);
        } else if($this->request->is('post')){
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $gallery_file = $this->request->getFiles();
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'priority' => $this->request->getPost('priority'),
                'upload_by' => $loggeduserId
            ];
            $result = $alumini_page_section_model->add($data);
            if ($result === true) {
                $insertId = $alumini_page_section_model->insertID();

                if ($gallery_file) {
                    foreach ($gallery_file['file_upload'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = "pagesec".$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/alumini', $newName);
                
                            $data = [
                                'alumini_page_section_id' => $insertId,
                                'file_upload' => $newName,
                            ];
                
                            $result = $alumini_page_section_images_model->save($data);
                        }
                    }
                }


                return redirect()->to('admin/alumini-page-section')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/alumini-page-section')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_alumini_page_section($id){
        $alumini_page_section_model = new Alumini_page_section_model();
        $alumini_page_section_images_model = new Alumini_page_section_images_model();
        $aluminiData = $alumini_page_section_model->get($id);
        if ($aluminiData) {
            $section_images = $alumini_page_section_images_model->getBysection($id);
            if ($section_images) {
                foreach ($section_images as $key => $image) {
                    if (file_exists("public/admin/uploads/alumini/" . $image['file_upload'])) {
                        unlink("public/admin/uploads/alumini/" . $image['file_upload']);
                    }
                    $alumini_page_section_images_model->where('alumini_page_section_id',$id)->delete();
                }
            }
            $result = $alumini_page_section_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-section')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/alumini-page-section')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
        
    }

    public function alumini_page_gallery()
    {
        $alumini_page_gallery_model = new Alumini_page_gallery_model();
        $data = ['title' => 'Page Image Gallery'];
        if($this->request->is('get')) {
            $data['gallery'] = $alumini_page_gallery_model->get();
            return view('admin/alumini/alumini-page-gallery',$data);
        } else if($this->request->is('post')){
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $gallery_file = $this->request->getFiles();
            if ($gallery_file) {
                foreach ($gallery_file['file_upload'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = "gallery".$file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/alumini', $newName);
            
                        $data = [
                            'title' => $this->request->getPost('title'),
                            'description' => $this->request->getPost('description'),
                            'gallery_date' => $this->request->getPost('gallery_date'),
                            'file_upload' => $newName,
                            'upload_by' => $loggeduserId,
                        ];
            
                        $result = $alumini_page_gallery_model->save($data);
                    }
                }
            }
            if ($result === true) {
                return redirect()->to('admin/alumini-page-gallery')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/alumini-page-gallery')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_alumini_page_gallery($id){
        $alumini_page_gallery_model = new Alumini_page_gallery_model();
        $aluminiData = $alumini_page_gallery_model->get($id);
        if ($aluminiData) {
            if (file_exists("public/admin/uploads/alumini/" . $aluminiData['file_upload'])) {
                unlink("public/admin/uploads/alumini/" . $aluminiData['file_upload']);
            }
            $result = $alumini_page_gallery_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-gallery')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/alumini-page-gallery')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
        
    }

    public function alumini_page_video()
    {
        $alumini_page_video_model = new Alumini_page_video_model();
        $data = ['title' => 'Page Video Gallery'];
        if($this->request->is('get')) {
            $data['video'] = $alumini_page_video_model->get();
            return view('admin/alumini/alumini-page-video',$data);
        } else if($this->request->is('post')){
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $file = $this->request->getFile('file_upload');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "video".$file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/alumini', $fileNewName);    
            }else{
                $fileNewName = "";
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'video_date' => $this->request->getPost('video_date'),
                'video_link' => $this->request->getPost('video_link'),
                'file_upload' => $fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $alumini_page_video_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-video')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/alumini-page-video')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_alumini_page_video($id){
        $alumini_page_video_model = new Alumini_page_video_model();
        $aluminiData = $alumini_page_video_model->get($id);
        if ($aluminiData) {
            if (file_exists("public/admin/uploads/alumini/" . $aluminiData['file_upload'])) {
                unlink("public/admin/uploads/alumini/" . $aluminiData['file_upload']);
            }
            $result = $alumini_page_video_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/alumini-page-video')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/alumini-page-video')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
        
    }

    public function alumini_education_detail()
    {
        $data = ['title' => 'Alumni Education Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-education-detail',$data);
        } else if($this->request->is('post')){
            
        }
    }
    public function alumini_job_details()
    {
        $data = ['title' => 'Alumni Job Details'];
        if($this->request->is('get')) {
            return view('admin/alumini/alumini-job-details',$data);
        } else if($this->request->is('post')){
            
        }
    }
    
}