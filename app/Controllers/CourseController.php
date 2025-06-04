<?php

namespace App\Controllers;

use App\Models\Assign_course_model;
use App\Models\Courses_model;
use App\Models\Department_model;
use App\Models\Program_model;

class CourseController extends BaseController
{
    public function courseList(){
        $courses_model = new Courses_model();
        $data = ['title' => 'Course Details'];
        if ($this->request->is("get")) {
            $data['courses'] = $courses_model->get();
            return view('admin/course/courseList',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $data = [
                'course_name' => $this->request->getVar('course_name'),
                'course_code' => $this->request->getVar('course_code'),
                'status' => $this->request->getVar('status'),
                'upload_by' => $loggeduserId
            ];
            $result = $courses_model->add($data);

            if ($result === true) {
                return redirect()->to('admin/courseList')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            }else{
                return redirect()->to('admin/courseList')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function assignCourseList(){
        $assign_course_model = new Assign_course_model();
        $department_model = new Department_model();
        $courses_model = new Courses_model();
        $data = ['title' => 'Assign Course'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->get();
            $data['courses'] = $courses_model->getActiveData();
            $data['assign_courses'] = $assign_course_model->get();
            return view('admin/course/assignCourseList',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $course_id = $this->request->getVar('course_id');
            $credit_score = $this->request->getVar('credit_score');
            if(empty($course_id)){
                return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-danger" role="alert"> Please select course </div>');
            }
            if(empty($credit_score)){
                return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-danger" role="alert"> Please select Credits </div>');
            }
            foreach ($course_id as $key => $value) {
                $data =[
                    'course_id' => $value,
                    'dept_id' => $this->request->getVar('Deptid'),
                    'program_id' => $this->request->getVar('Progid'),
                    'semester' => $this->request->getVar('semester'),
                    'credits' => $this->request->getVar('credit_score')[$key],
                    'upload_by' => $loggeduserId
                ];
                $result = $assign_course_model->add($data);
            }
            if ($result === true) {
                return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            }else{
                return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function edit_assign_course($id){
        $assign_course_model = new Assign_course_model();
        $program_model = new Program_model();
        $department_model = new Department_model();
        $courses_model = new Courses_model();
        $data = ['title' => 'Assign Course', 'assign_course_id' => $id];
        if ($this->request->is("get")) {
            $data['edit_assign_courses'] = $assign_course_model->get($id);
            $data['department'] = $department_model->get();
            $data['program'] = $program_model->getProgramCategoriesByDepartment($data['edit_assign_courses']['dept_id']);
            // print_r( $data['program']); die;
            $data['courses'] = $courses_model->getActiveData();
            $data['assign_courses'] = $assign_course_model->get();
            return view('admin/course/edit-assign-course',$data);
        }else if ($this->request->is("post")) {
            $data =[
                'course_id' => $this->request->getVar('course_id'),
                'dept_id' => $this->request->getVar('Deptid'),
                'program_id' => $this->request->getVar('Progid'),
                'semester' => $this->request->getVar('semester'),
                'credits' => $this->request->getVar('credit_score'),
            ];
            $result = $assign_course_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-assign-course/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            }else{
                return redirect()->to('admin/edit-assign-course/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_assign_course($id){
        $assign_course_model = new Assign_course_model();
        $result = $assign_course_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
        }else{
            return redirect()->to('admin/assignCourseList')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }
}
