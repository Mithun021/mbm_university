<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Program_department_mapping_model;
use App\Models\Program_model;

    class ProgramController extends BaseController{
        public function program(){
            $program_model = new Program_model();
            $data = ['title' => 'Program'];
            if ($this->request->is("get")) {
                $data['program'] = $program_model->get();
                return view('admin/program/program',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('program_title'),
                    'description' => $this->request->getPost('program_description'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId
                ];

               $result = $program_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/program')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
            
        }


        public function program_dept_mapping(){
            $program_department_mapping_model = new Program_department_mapping_model();
            $department_model = new Department_model();
            $program_model = new Program_model();
            $data = ['title' => 'Program Dept. Mapping'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['program'] = $program_model->activeData();
                $data['program_dep_mapping'] = $program_department_mapping_model->get();
                return view('admin/program/program-dept-mapping',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggedUserId = $sessionData['loggeduserId']; 
                } else {
                    return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Session expired. Please log in again.</div>');
                }
                $syllabus_photo = $this->request->getFile('Syllabus');
                if ($syllabus_photo->isValid() && ! $syllabus_photo->hasMoved()) {
                    $syllabusimageName = $syllabus_photo->getRandomName();
                    $syllabus_photo->move(ROOTPATH . 'public/admin/uploads/program_dep_map', $syllabusimageName);    
                }else{
                 $syllabusimageName = "";
                }

                $data = [
                    'program_id' => $this->request->getPost('Progid'),
                    'department_id' => $this->request->getPost('Deptid'),
                    'eligibility_criteria' => $this->request->getPost('eligibility'),
                    'no_of_seats' => $this->request->getPost('Noofseats'),
                    'batch_start' => $this->request->getPost('batchStart'),
                    'batch_end' => $this->request->getPost('batchEnd'),
                    'syllabus_files' => $syllabusimageName,
                    'status' => $this->request->getPost('status'),
                    'admission' => $this->request->getPost('admission') ?? '',
                    'current_session' => $this->request->getPost('current_session'),
                    'upload_by' =>  $loggedUserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $program_department_mapping_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/program-dept-mapping')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                }else{
                    return redirect()->to('admin/program-dept-mapping')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


    }
?>