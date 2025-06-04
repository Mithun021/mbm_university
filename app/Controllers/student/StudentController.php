<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;
use App\Models\Employee_model;
use App\Models\Program_department_mapping_model;
use App\Models\State_city_model;
use App\Models\Student_academic_details_model;
use App\Models\Student_achievement_model;
use App\Models\Student_area_interest_model;
use App\Models\Student_book_chapter_model;
use App\Models\Student_bookchapter_author_model;
use App\Models\Student_conference_workshop_model;
use App\Models\Student_copyright_author_model;
use App\Models\Student_copyright_model;
use App\Models\Student_experience_model;
use App\Models\Student_hobbies_model;
use App\Models\Student_language_model;
use App\Models\Student_model;
use App\Models\Student_patent_author_model;
use App\Models\Student_patent_model;
use App\Models\Student_phd_details_model;
use App\Models\Student_profile_achievement_model;
use App\Models\Student_prog_dept_mapping_model;
use App\Models\Student_publication_author_model;
use App\Models\Student_publication_model;
use App\Models\Student_skills_model;

class StudentController extends BaseController
{
    public function index()
    {
        $data = ['title' =>'Student Dashboard'];
        return view('student/index',$data); 
    }

    public function student_profile()
    {
        $student_prog_dept_mapping_model = new Student_prog_dept_mapping_model();
        $student_model = new Student_model();
        $program_department_mapping_model = new Program_department_mapping_model();
        $student_academic_details_model = new Student_academic_details_model();
        $student_phd_details_model = new Student_phd_details_model();
        $student_publication_model = new Student_publication_model();
        $student_book_chapter_model = new Student_book_chapter_model();
        $student_patent_model = new Student_patent_model();
        $student_conference_workshop_model = new Student_conference_workshop_model();
        $student_copyright_model = new Student_copyright_model();
        $student_achievement_model = new Student_profile_achievement_model();
        $student_experience_model = new Student_experience_model();
        $student_skills_model = new Student_skills_model();
        $student_hobbies_model = new Student_hobbies_model();
        $student_area_interest_model = new Student_area_interest_model();
        $student_language_model = new Student_language_model();

        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $data = ['title' =>'Student Profile'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_model->get($loggedstudentId);
            $data['studentDataCourses'] = $student_prog_dept_mapping_model->getStudentProgramDeptData($loggedstudentId);
            if ($data['studentDataCourses']) {
                $data['batchName'] = $program_department_mapping_model->getBatchName(
                    $data['studentDataCourses']['program_id'],
                    $data['studentDataCourses']['department_id']
                );
            } else {
                $data['batchName'] = null;
            } 
            $data['studentAcademicDetails'] = $student_academic_details_model->getByStudent($loggedstudentId);
            $data['phdstudentData'] = $student_phd_details_model->getByStudent($loggedstudentId);
            $data['pubstudentData'] = $student_publication_model->getByStudent($loggedstudentId);
            $data['bookstudentData'] = $student_book_chapter_model->getByStudent($loggedstudentId);
            $data['patentstudentData'] = $student_patent_model->getByStudent($loggedstudentId);
            $data['confstudent_data'] = $student_conference_workshop_model->getByStudent($loggedstudentId);
            $data['copystudentData'] = $student_copyright_model->getByStudent($loggedstudentId);
            $data['student_acchievement'] = $student_achievement_model->getByStudent($loggedstudentId);
            $data['student_experience'] = $student_experience_model->getByStudent($loggedstudentId);

            $data['studentSkills'] = $student_skills_model->getByStudent($loggedstudentId);
            $data['studentHobbies'] = $student_hobbies_model->getByStudent($loggedstudentId);
            $data['studentAreaInterest'] = $student_area_interest_model->getByStudent($loggedstudentId);
            $data['studentLanguage'] = $student_language_model->getByStudent($loggedstudentId);

            return view('student/student-profile',$data);
        }else  if ($this->request->is('post')) {
            
        }
    }
    public function resume_details()
    {
        $student_skills_model = new Student_skills_model();
        $student_hobbies_model = new Student_hobbies_model();
        $student_area_interest_model = new Student_area_interest_model();
        $student_language_model = new Student_language_model();
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $data = [
            'title' =>'Student Resume Details',
            'studentSkills' => $student_skills_model->getByStudent($loggedstudentId),
            'studentHobbies' => $student_hobbies_model->getByStudent($loggedstudentId),
            'studentAreaInterest' => $student_area_interest_model->getByStudent($loggedstudentId),
            'studentLanguage' => $student_language_model->getByStudent($loggedstudentId),
        ];
        return view('student/resume-details',$data);
    }

    public function student_skills(){
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_skills_model = new Student_skills_model();
        $data = [
            'student_id' => $loggedstudentId,
            'skills' => $this->request->getPost('skills'),
        ];
        $result = $student_skills_model->add($data);
        if ($result === true) {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Skills details added successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function student_area_interest(){
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_skills_model = new Student_area_interest_model();
        $data = [
            'student_id' => $loggedstudentId,
            'area_interest' => $this->request->getPost('area_interest'),
        ];
        $result = $student_skills_model->add($data);
        if ($result === true) {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function student_language(){
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_skills_model = new Student_language_model();
        $data = [
            'student_id' => $loggedstudentId,
            'language' => $this->request->getPost('language'),
        ];
        $result = $student_skills_model->add($data);
        if ($result === true) {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function student_hobbies(){
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_skills_model = new Student_hobbies_model();
        $data = [
            'student_id' => $loggedstudentId,
            'hobbies' => $this->request->getPost('hobbies'),
        ];
        $result = $student_skills_model->add($data);
        if ($result === true) {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }


    public function delete_skills($id){
        $student_skills_model = new Student_skills_model();
        $studentData = $student_skills_model->get($id);
        if ($studentData) {
            $result = $student_skills_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Skills details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-danger" role="alert">Skills details not found.</div>');
        }
    }

    public function delete_area_interest($id){
        $student_area_interest_model = new Student_area_interest_model();
        $studentData = $student_area_interest_model->get($id);
        if ($studentData) {
            $result = $student_area_interest_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Area Interest details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-danger" role="alert">Area Interest details not found.</div>');
        }
    }

    public function delete_language($id){
        $student_language_model = new Student_language_model();
        $studentData = $student_language_model->get($id);
        if ($studentData) {
            $result = $student_language_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Language details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-danger" role="alert">Language details not found.</div>');
        }
    }

    public function delete_hobbies($id){
        $student_hobbies_model = new Student_hobbies_model();
        $studentData = $student_hobbies_model->get($id);
        if ($studentData) {
            $result = $student_hobbies_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-success" role="alert">Hobbies details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/resume-details')->with('status', '<div class="alert alert-danger" role="alert">Hobbies details not found.</div>');
        }
    }


    public function personal_details()
    {
        $employee_model = new Employee_model();
        $state_city_model = new State_city_model();
        $student_prog_dept_mapping_model = new Student_prog_dept_mapping_model();
        $student_model = new Student_model();
        $program_department_mapping_model = new Program_department_mapping_model();
        
        $data = ['title' =>'Personal Details'];
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }

        $data['studentData'] = $student_model->get($loggedstudentId);
        $data['studentDataCourses'] = $student_prog_dept_mapping_model->getStudentProgramDeptData($loggedstudentId);
        if ($data['studentDataCourses']) {
            $data['batchName'] = $program_department_mapping_model->getBatchName(
                $data['studentDataCourses']['program_id'],
                $data['studentDataCourses']['department_id']
            );
        } else {
            $data['batchName'] = null;
        }

        $data['employeeData'] = $employee_model->get();
        $data['stateData'] = $state_city_model->get_state();
        if ($this->request->is('get')) {
            return view('student/personal-details',$data);
        }else  if ($this->request->is('post')) {
            $studentData = $student_model->get($loggedstudentId);

            $std_profile_image = $this->request->getFile('std_profile_image');
            $std_signature_image = $this->request->getFile('std_signature_image');

            $old_profile_image = $studentData['profile_image'];
            $old_signature_image = $studentData['signature'];

            if (empty($old_profile_image)) {
                if ($std_profile_image->isValid() && !$std_profile_image->hasMoved()) {
                    $new_profile_file = "profile" . $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_profile_file);
                } else {
                    $new_profile_file = null;
                }
            } else {
                if ($std_profile_image->isValid() && !$std_profile_image->hasMoved()) {
                    if (file_exists("public/admin/uploads/students/" . $old_profile_image)) {
                        unlink("public/admin/uploads/students/" . $old_profile_image);
                    }
                    $new_profile_file = "profile" . $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_profile_file);
                } else {
                    $new_profile_file = $old_profile_image;
                }
            }

            if (empty($old_signature_image)) {
                if ($std_signature_image->isValid() && !$std_signature_image->hasMoved()) {
                    $new_signature_file = "signature" . $std_signature_image->getRandomName();
                    $std_signature_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_signature_file);
                } else {
                    $new_signature_file = null;
                }
            } else {
                if ($std_signature_image->isValid() && !$std_signature_image->hasMoved()) {
                    if (file_exists("public/admin/uploads/students/" . $old_signature_image)) {
                        unlink("public/admin/uploads/students/" . $old_signature_image);
                    }
                    $new_signature_file = "signature" . $std_signature_image->getRandomName();
                    $std_signature_image->move(ROOTPATH . 'public/admin/uploads/students/', $new_signature_file);
                } else {
                    $new_signature_file = $old_signature_image;
                }
            }

            $data = [
                // 'first_name' => $this->request->getPost('std_first_name'),
                'middle_name' => $this->request->getPost('std_middle_name'),
                'last_name' => $this->request->getPost('std_last_name'),
                // 'enrollment_no' => $this->request->getPost('Stdenrollid'),
                'father_name' => $this->request->getPost('std_father_name'),
                'mother_name' => $this->request->getPost('std_mother_name'),
                'date_of_birth' => $this->request->getPost('std_date_of_birth'),
                'blood_group' => $this->request->getPost('std_blood_group'),
                // 'personal_mail' => $this->request->getPost('std_personal_mail'),
                'official_mail' => $this->request->getPost('std_official_mail'),
                'phone_no' => $this->request->getPost('Stdphone'),
                'gender' => $this->request->getPost('gender'),
                'permanent_address' => $this->request->getPost('std_permanent_address'),
                'correspondence_address' => $this->request->getPost('std_corrospondence_address'),
                'category' => $this->request->getPost('category'),
                'ews' => $this->request->getPost('ews') ?? 0,
                'relegion' => $this->request->getPost('relegion'),
                'other_relegion' => $this->request->getPost('other_relegion'),
                'supervisor_name' => $this->request->getPost('supervisor'),
                'linkedin_id' => $this->request->getPost('linkedin_id'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'pincode' => $this->request->getPost('pincode'),
                'career_objective' => $this->request->getPost('career_objective'),
                'profile_image' => $new_profile_file ?? '',
                'signature' => $new_signature_file ?? '',
            ];
            $result = $student_model->add($data, $loggedstudentId);
            if ($result === true) {
                return redirect()->to('student/personal-details')->with('status', '<div class="alert alert-success" role="alert">Profile update successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function academic_details(){
        $student_academic_details_model = new Student_academic_details_model();
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $data = ['title' =>'Academic Details'];
        if ($this->request->is('get')) {
            $data['studentAcademicDetails'] = $student_academic_details_model->getByStudent($loggedstudentId);
            return view('student/academic-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "acadmic".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'degree_type' => $this->request->getPost('degree_type'),
                'other_degree_name' => $this->request->getPost('other_degree_name') ?? '',
                'board_institute_name' => $this->request->getPost('board_institute_name'),
                'subject_studied' => $this->request->getPost('subject_studied'),
                'marks_type' => $this->request->getPost('marks_type'),
                'marks_obtained' => $this->request->getPost('marks_obtained'),
                'result_declaration_date' => $this->request->getPost('result_declaration_date')."-01",
                'degree_date' => $this->request->getPost('degree_date')."-01",
                'upload_file' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_academic_details_model->add($data);
            if ($result === true) {
                return redirect()->to('student/academic-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_academic_details($id){
        $student_academic_details_model = new Student_academic_details_model();
        $studentData = $student_academic_details_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['upload_file'])) {
                unlink("public/admin/uploads/students/" . $studentData['upload_file']);
            }
            $result = $student_academic_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/academic-details')->with('status', '<div class="alert alert-success" role="alert">Acadmic details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/acadmic-details')->with('status', '<div class="alert alert-danger" role="alert">Acadmic details not found.</div>');
        }
    }

    public function phd_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_phd_details_model = new Student_phd_details_model();
        $employee_model = new Employee_model();
        $data = ['title' =>'PHD Details'];
        if ($this->request->is('get')) {
            $data['employeeData'] = $employee_model->get();
            $data['studentData'] = $student_phd_details_model->getByStudent($loggedstudentId);
            return view('student/phd-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "phdfile".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'phd_title' => $this->request->getPost('phd_title'),
                'description' => $this->request->getPost('description') ?? '',
                'supervisor_name' => $this->request->getPost('supervisor_name'),
                'current_status' => $this->request->getPost('current_status'),
                'registration_date' => $this->request->getPost('registration_date'),
                'submission_date' => $this->request->getPost('submission_date'),
                'award_date' => $this->request->getPost('award_date'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_phd_details_model->add($data);
            if ($result === true) {
                return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_phd_details($id){
        $student_phd_details_model = new Student_phd_details_model();
        $studentData = $student_phd_details_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_phd_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-success" role="alert">PhD details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/phd-details')->with('status', '<div class="alert alert-danger" role="alert">PhD details not found.</div>');
        }
    }

    public function publication_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_publication_model = new Student_publication_model();
        $student_publication_author_model = new Student_publication_author_model();
        $data = ['title' =>'Publication Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_publication_model->getByStudent($loggedstudentId);
            // print_r($data);die;
            return view('student/publication-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "publication".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'publication_title' => $this->request->getPost('publication_title'),
                'publication_description' => $this->request->getPost('publication_description') ?? '',
                'journal_name' => $this->request->getPost('journal_name'),
                'volume_number' => $this->request->getPost('volume_number'),
                'page_number' => $this->request->getPost('page_number'),
                'publication_type' => $this->request->getPost('publication_type'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi' => $this->request->getPost('doi'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'publication_year' => $this->request->getPost('publication_year'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_publication_model->add($data);
            if ($result === true) {
                $publicationId = $student_publication_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_publication_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_publication_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-success" role="alert">Academic details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_publication_details($id){
        $student_publication_model = new Student_publication_model();
        $student_publication_author_model = new Student_publication_author_model();
        $studentData = $student_publication_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_publication_model->delete($id);
            if ($result === true) {
                $student_publication_author_model->where('student_publication_id', $id)->delete();
                return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-success" role="alert">Publication details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/publication-details')->with('status', '<div class="alert alert-danger" role="alert">Publication details not found.</div>');
        }
    }

    public function book_chapter_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_book_chapter_model = new Student_book_chapter_model();
        $student_bookchapter_author_model = new Student_bookchapter_author_model();
        $data = ['title' =>'Book Chapter Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_book_chapter_model->getByStudent($loggedstudentId);
            return view('student/book-chapter-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "book".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'chapter_title' => $this->request->getPost('chapter_title'),
                'book_title' => $this->request->getPost('book_title'),
                'publication_description' => $this->request->getPost('publication_description') ?? '',
                'publisher_name' => $this->request->getPost('publisher_name'),
                'volume_number' => $this->request->getPost('volume_number'),
                'page_number' => $this->request->getPost('page_number'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi' => $this->request->getPost('doi'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'publication_year' => $this->request->getPost('publication_year'),
                'file_upload' => $studentFileName ?? '',
            ];
            // print_r($data);die;
            $result = $student_book_chapter_model->add($data);
            if ($result === true) {
                $publicationId = $student_book_chapter_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_bookchapter_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_bookchapter_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-success" role="alert">Book Chapter details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_book_chapter_details($id){
        $student_book_chapter_model = new Student_book_chapter_model();
        $student_bookchapter_author_model = new Student_bookchapter_author_model();
        $studentData = $student_book_chapter_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_book_chapter_model->delete($id);
            if ($result === true) {
                $student_bookchapter_author_model->where('student_bookchapter_id', $id)->delete();
                return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-success" role="alert">Book Chapter details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/book-chapter-details')->with('status', '<div class="alert alert-danger" role="alert">Book Chapter details not found.</div>');
        }
    }

    public function patent_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_patent_model = new Student_patent_model();
        $student_patent_author_model = new Student_patent_author_model();
        $data = ['title' =>'Patent Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_patent_model->getByStudent($loggedstudentId);
            return view('student/patent-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "patent".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'patent_title' => $this->request->getPost('patent_title'),
                'description' => $this->request->getPost('description') ?? '',
                'patent_number' => $this->request->getPost('patent_number'),
                'patent_status' => $this->request->getPost('patent_status'),
                'patent_filing_date' => $this->request->getPost('patent_filing_date'),
                'patent_grant_date' => $this->request->getPost('patent_grant_date') ?? '',
                'patent_level' => $this->request->getPost('patent_level'),
                'fund_generated' => $this->request->getPost('fund_generated'),
                'file_upload' => $studentFileName ?? '',
            ];
            $result = $student_patent_model->add($data);
            if ($result === true) {
                $publicationId = $student_patent_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_patent_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_patent_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/patent-details')->with('status', '<div class="alert alert-success" role="alert">Patent details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_patent_details($id){
        $student_patent_model = new Student_patent_model();
        $student_patent_author_model = new Student_patent_author_model();
        $studentData = $student_patent_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_patent_model->delete($id);
            if ($result === true) {
                $student_patent_author_model->where('student_patent_id', $id)->delete();
                return redirect()->to('student/patent-details')->with('status', '<div class="alert alert-success" role="alert">Patent details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/patent-details')->with('status', '<div class="alert alert-danger" role="alert">Patent details not found.</div>');
        }
    }

    public function conference_workshop_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_conference_workshop_model = new Student_conference_workshop_model();
        $data = ['title' =>'Conference/Workshop Details'];
        if ($this->request->is('get')) {
            $data['student_data'] = $student_conference_workshop_model->getByStudent($loggedstudentId);
            return view('student/conference-workshop-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'conference' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'student_id' => $loggedstudentId,
                'conference_title' => $this->request->getVar('conference_title'),
                'description' => $this->request->getVar('description'),
                'conference_date' => $this->request->getVar('conference_date'),
                'conference_duration' => $this->request->getVar('conference_duration'),
                'paper_datils' => $this->request->getVar('paper_datils'),
                'file_upload' => $upload_file_new_name,
            ];
            $result = $student_conference_workshop_model->add($data);
            if ($result === true) {
                return redirect()->to('student/conference-workshop-details')->with('status', '<div class="alert alert-success" role="alert">Workshop/Conference details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_conference_workshop_details($id){
        $student_conference_workshop_model = new Student_conference_workshop_model();
        $studentData = $student_conference_workshop_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_conference_workshop_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/conference-workshop-details')->with('status', '<div class="alert alert-success" role="alert">Conference/workshop details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/conference-workshop-details')->with('status', '<div class="alert alert-danger" role="alert">Conference/workshop details not found.</div>');
        }
    }

    public function copyright_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_copyright_model = new Student_copyright_model();
        $student_copyright_author_model = new Student_copyright_author_model();
        $data = ['title' =>'Copyright Details'];
        if ($this->request->is('get')) {
            $data['studentData'] = $student_copyright_model->getByStudent($loggedstudentId);
            return view('student/copyright-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $studentFileName = "copyright".$upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
            }
            $data = [
                'student_id' => $loggedstudentId,
                'copyright_title' => $this->request->getPost('copyright_title'),
                'description' => $this->request->getPost('description') ?? '',
                'copyright_number' => $this->request->getPost('copyright_number'),
                'copyright_status' => $this->request->getPost('copyright_status'),
                'copyright_filing_date' => $this->request->getPost('copyright_filing_date'),
                'copyright_grant_date' => $this->request->getPost('copyright_grant_date') ?? '',
                'file_upload' => $studentFileName ?? '',
            ];
            $result = $student_copyright_model->add($data);
            if ($result === true) {
                $publicationId = $student_copyright_model->insertID();
                $authors = $this->request->getPost('author_name');
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        $authorData = [
                            'student_copyright_id' => $publicationId,
                            'author_name' => $author,
                        ];
                        $student_copyright_author_model->add($authorData);
                    }
                }
                return redirect()->to('student/copyright-details')->with('status', '<div class="alert alert-success" role="alert">Copyright details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_copyright_details($id){
        $student_copyright_model = new Student_copyright_model();
        $student_copyright_author_model = new Student_copyright_author_model();
        $studentData = $student_copyright_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_copyright_model->delete($id);
            if ($result === true) {
                $student_copyright_author_model->where('student_copyright_id', $id)->delete();
                return redirect()->to('student/copyright-details')->with('status', '<div class="alert alert-success" role="alert">Copyright details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/copyright-details')->with('status', '<div class="alert alert-danger" role="alert">Copyright details not found.</div>');
        }
    }

    public function achievement_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_achievement_model = new Student_profile_achievement_model();
        $data = ['title' =>'Achievements Details'];
        if ($this->request->is('get')) {
            $data['student_acchievement'] = $student_achievement_model->getByStudent($loggedstudentId);
            return view('student/achievement-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'achievement' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'student_id' => $loggedstudentId,
                'achievement_title' => $this->request->getVar('achievement_title'),
                'description' => $this->request->getVar('description'),
                'award_level' => $this->request->getVar('award_level'),
                'award_date' => $this->request->getVar('award_date'),
                'awarded_agency' => $this->request->getVar('awarded_agency'),
                'file_upload' => $upload_file_new_name,
            ];
            $result = $student_achievement_model->add($data);
            if ($result === true) {
                return redirect()->to('student/achievement-details')->with('status', '<div class="alert alert-success" role="alert">Achievement details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_achievement_details($id){
        $student_achievement_model = new Student_profile_achievement_model();
        $studentData = $student_achievement_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_achievement_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/achievement-details')->with('status', '<div class="alert alert-success" role="alert">Achievement details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/achievement-details')->with('status', '<div class="alert alert-danger" role="alert">Achievement details not found.</div>');
        }
    }

    public function experience_details()
    {
        $sessionData = session()->get('loggedStudentData');
        if ($sessionData) {
            $loggedstudentId = $sessionData['loggedstudentId'];
        }
        $student_experience_model = new Student_experience_model();
        $data = ['title' =>'Experience Details'];
        if ($this->request->is('get')) {
            $data['student_experience'] = $student_experience_model->getByStudent($loggedstudentId);
            return view('student/experience-details',$data);
        }else  if ($this->request->is('post')) {
            $upload_file = $this->request->getFile('file_upload');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_file_new_name = 'experience' . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/students', $upload_file_new_name);
            } else {
                $upload_file_new_name = "";
            }
            $data = [
                'student_id' => $loggedstudentId,
                'designation' => $this->request->getVar('designation'),
                'organization_name' => $this->request->getVar('organization_name'),
                'organization_type' => $this->request->getVar('organization_type'),
                'joining_date' => $this->request->getVar('joining_date'),
                'releiving_date' => $this->request->getVar('releiving_date'),
                'file_upload' => $upload_file_new_name,
            ];
            $result = $student_experience_model->add($data);
            if ($result === true) {
                return redirect()->to('student/experience-details')->with('status', '<div class="alert alert-success" role="alert">Experience details added successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        }
    }

    public function delete_experience_details($id){
        $student_experience_model = new Student_experience_model();
        $studentData = $student_experience_model->get($id);
        if ($studentData) {
            if (file_exists("public/admin/uploads/students/" . $studentData['file_upload'])) {
                unlink("public/admin/uploads/students/" . $studentData['file_upload']);
            }
            $result = $student_experience_model->delete($id);
            if ($result === true) {
                return redirect()->to('student/experience-details')->with('status', '<div class="alert alert-success" role="alert">Experience details deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('student/experience-details')->with('status', '<div class="alert alert-danger" role="alert">Experience details not found.</div>');
        }
    }

}
