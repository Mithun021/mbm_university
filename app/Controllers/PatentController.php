<?php

namespace App\Controllers;

use App\Models\Committee_model;
use App\Models\Employee_model;
use App\Models\Patent_author_model;
use App\Models\Patent_current_status_model;
use App\Models\Patent_model;
use App\Models\Patent_type_model;
use App\Models\Patent_webpage_file_model;
use App\Models\Patent_webpage_model;

class PatentController extends BaseController
{
    public function patent_details(){
        $patent_current_status_model = new Patent_current_status_model();
        $patent_type_model = new Patent_type_model();
        $patent_model = new Patent_model();
        $employee_model = new Employee_model();
        $patent_author_model = new Patent_author_model();
        $data = ['title' => 'Patent Details'];
        if ($this->request->is("get")) {
            $data['employees'] = $employee_model->get();
            $data['patent'] = $patent_model->get();
            $data['patent_type'] = $patent_type_model->get();
            $data['patent_current_status'] = $patent_current_status_model->get();
            return view('admin/patent/patent-details',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $patent_photo = $this->request->getFile('patent_file');
            if ($patent_photo->isValid() && ! $patent_photo->hasMoved()) {
                $patentImageName = $patent_photo->getRandomName();
                $patent_photo->move(ROOTPATH . 'public/admin/uploads/patent', $patentImageName);    
            }else{
                $patentImageName = "";
            }
            $author_name = $this->request->getPost('author_name');
            $data =[
                'patent_title' => $this->request->getPost('patent_title'),
                'ipr_number' => $this->request->getPost('ipr_number'),
                'patent_type' => $this->request->getPost('patent_type'),
                'description' => $this->request->getPost('description'),
                'filling_date' => $this->request->getPost('filling_date'),
                'grant_date' => $this->request->getPost('grant_date'),
                'current_status' => $this->request->getPost('current_status'),
                'upload_file' => $patentImageName,
                'employee_id' => implode(",",  $this->request->getPost('emp_id')), //$this->request->getPost('emp_id'),
                'status' => $this->request->getPost('patent_status'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_model->add($data);
            if ($result === true) {
                $insertedId = $patent_model->getInsertID();
                foreach ($author_name as $key => $value) {
                    $data = [
                        'patent_id' => $insertedId,
                        'author_name' => $value
                    ];
                    $result = $patent_author_model->add($data);
                }
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/patent-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function patent_web_page(){
        $patent_webpage_file_model = new Patent_webpage_file_model();
        $patent_webpage_model = new Patent_webpage_model();
        $data = ['title' => 'Patent Web Page'];
        if ($this->request->is("get")) {
            $data['patent_webpage'] = $patent_webpage_model->get();
            return view('admin/patent/patent-web-page',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'upload_by' => $loggeduserId
            ];
            $album_files = $this->request->getFiles();
            $result = $patent_webpage_model->add($data);
            if ($result === true) {
                $insertedId = $patent_webpage_model->getInsertID();
                if ($album_files && isset($album_files['upload_file'])) {
                    foreach ($album_files['upload_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $insertedId."webpage".$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/patent', $newName);
        
                            $file_data = [
                                'patent_webpage_id' => $insertedId,
                                'upload_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $patent_webpage_file_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/patent-web-page')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function patent_type(){
        $patent_type_model = new Patent_type_model();
        $data = ['title' => 'Patent Type'];
        if ($this->request->is("get")) {
            $data['patent_type'] = $patent_type_model->get();
            return view('admin/patent/patent-type',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('patent_type'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/patent-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function current_status(){
        $patent_current_status_model = new Patent_current_status_model();
        $data = ['title' => 'Current Staus'];
        if ($this->request->is("get")) {
            $data['current_status'] = $patent_current_status_model->get();
            return view('admin/patent/current-status',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'name' => $this->request->getPost('current_staus'),
                'upload_by' => $loggeduserId
            ];
            $result = $patent_current_status_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/current-status')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/current-status')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
}
