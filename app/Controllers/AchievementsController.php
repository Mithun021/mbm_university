<?php

namespace App\Controllers;

use App\Models\Awards_recognition_model;
use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Faculty_awards_gallery_model;
use App\Models\Faculty_awards_mapping_model;
use App\Models\Faculty_awards_model;
use App\Models\Program_model;
use App\Models\Student_achievement_mapping_model;
use App\Models\Student_achievement_model;
use App\Models\Student_prog_dept_mapping_model;

class AchievementsController extends BaseController
{
    public function faculty_awards()
    {
        $faculty_awards_mapping_model = new Faculty_awards_mapping_model();
        $department_model = new Department_model();
        $designation_model = new Designation_model();
        $faculty_awards_model = new Faculty_awards_model();
        $faculty_awards_gallery_model = new Faculty_awards_gallery_model();
        $data = ['title' => 'Faculty Awards'];
        if ($this->request->is("get")) {
            $data['departments'] = $department_model->get();
            $data['designations'] = $designation_model->get();
            $data['faculty_awards'] = $faculty_awards_model->get();
            return view('admin/awards_achievement/faculty-awards', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'faculty' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'thumbnail' => $upload_file_new_name,
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_by' => $loggeduserId,
            ];
            $faculty_name = $this->request->getVar('faculty_name');
            $result = $faculty_awards_model->add($data);
            if ($result) {
                $insert_id = $faculty_awards_model->getInsertID();

                foreach ($faculty_name as $key => $value) {
                    $data2 = [
                        'faculty_award_id' => $insert_id,
                        'faculty_name' => $value,
                        'department_id' => $this->request->getVar('department')[$key],
                        'designation_id' => $this->request->getVar('designation')[$key],
                    ];
                    $faculty_awards_mapping_model->add($data2);
                }

                $file_gallery = $this->request->getFiles();
                if ($file_gallery && isset($file_gallery['file_gallery'])) {
                    foreach ($file_gallery['file_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $insert_id . "gallery" . $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/achievements', $newName);

                            $file_data = [
                                'faculty_award_id' => $insert_id,
                                'gallery_file' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $faculty_awards_gallery_model->add($file_data);
                        }
                    }
                }
                return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/faculty-awards')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function awards_recognition()
    {
        $awards_recognition_model = new Awards_recognition_model();
        $data = ['title' => 'Awards & Recognition'];
        if ($this->request->is("get")) {
            $data['awards_recognition'] = $awards_recognition_model->get();
            return view('admin/awards_achievement/awards-recognition', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'awards' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'upload_file' => $upload_file_new_name,
                'upload_by' => $loggeduserId,
            ];
            $result = $awards_recognition_model->add($data);
            if ($result) {
                return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/awards-recognition')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function student_achievements()
    {
        $student_achievement_mapping_model = new Student_achievement_mapping_model();
        $employee_model = new Employee_model();
        $department_model = new Department_model();
        $courses_model = new Courses_model();
        $program_model = new Program_model();
        $student_achievement_model = new Student_achievement_model();
        $data = ['title' => 'Student Achievements'];
        if ($this->request->is("get")) {
            $data['employee'] = $employee_model->get();
            $data['department'] = $department_model->get();
            $data['program'] = $program_model->get();
            $data['student_acchievement'] = $student_achievement_model->get();
            return view('admin/awards_achievement/student-achievements', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'student' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/achievements', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'award_date' => $this->request->getVar('awards_date'),
                'agency_name' => $this->request->getVar('agency_name'),
                'upload_file' => $upload_file_new_name,
                'upload_by' => $loggeduserId,
            ];
            $student_name = $this->request->getVar('student_name');
            $result = $student_achievement_model->add($data);
            if ($result) {
                $insert_id  = $student_achievement_model->getInsertID();
                foreach ($student_name as $key => $value) {
                    $data2 = [
                        'student_achievement_mapping_id' => $insert_id,
                        'student_name' => $value,
                        'department_id' => $this->request->getVar('department')[$key],
                        'course_id' => $this->request->getVar('course')[$key],
                        'supervisor_id' => $this->request->getVar('supervisor')[$key],
                    ];
                    $student_achievement_mapping_model->add($data2);
                }
                return redirect()->to('admin/student-achievements')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/student-achievements')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
}
