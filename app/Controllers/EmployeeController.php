<?php
    namespace App\Controllers;

use App\Models\Books_chapter_author;
use App\Models\Books_chapter_coauthor;
use App\Models\Books_chapter_model;
use App\Models\Country_model;
use App\Models\Course_tought_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Emp_other_academic_detail_model;
use App\Models\Employee_academic_details_model;
use App\Models\Employee_additioonal_charge_model;
use App\Models\Employee_awards_model;
use App\Models\Employee_collaboration_model;
use App\Models\Employee_experience_model;
use App\Models\Employee_fellowship_model;
use App\Models\Employee_model;
use App\Models\Employee_mou_model;
use App\Models\Employee_nature_model;
use App\Models\Employee_patent_model;
use App\Models\Employee_projects_model;
use App\Models\Employee_publication_author_model;
use App\Models\Employee_publication_model;
use App\Models\Employee_seed_money_model;
use App\Models\Employee_seminar_conference_model;
use App\Models\Employee_talk_poster_model;
use App\Models\Mphil_ug_pg_model;
use App\Models\Nature_of_work_model;
use App\Models\Ongoing_phd_model;
use App\Models\Organisation_type_model;
use App\Models\Phd_detail_model;
use App\Models\Student_model;

    class EmployeeController extends BaseController{
        public function employee(){
            $employee_nature_model = new Employee_nature_model();
            $department_model = new Department_model();
            $designation_model = new Designation_model();
            $employee_model = new Employee_model();
            $data = ['title' => 'Employee Details'];
            if ($this->request->is("get")) {
                $data['employee_nature'] = $employee_nature_model->get();
                $data['departments'] = $department_model->get();
                $data['designations'] = $designation_model->get();
                $data['employee'] = $employee_model->get();
                return view('admin/employee/employee',$data);
            }else if ($this->request->is("post")) {
                // echo "<pre>";print_r($this->request->getPost('department_id')); die;
                // $department =  implode(",",  $this->request->getPost('department_id'));
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $profile_image = $this->request->getFile('profile_photo');
                if ($profile_image->isValid() && ! $profile_image->hasMoved()) {
                    $imageName = $profile_image->getRandomName();
                    $profile_image->move(ROOTPATH . 'public/admin/uploads/employee', $imageName);    
                }else{
                 $imageName = "";
                }
                $resume_file = $this->request->getFile('resume_file');
                if ($resume_file->isValid() && ! $resume_file->hasMoved()) {
                    $resumeimageName = $resume_file->getRandomName();
                    $resume_file->move(ROOTPATH . 'public/admin/uploads/employee', $resumeimageName);    
                }else{
                 $resumeimageName = "";
                }
                $password = "123456";
                $data = [
                    'employee_unique_id' => $this->request->getPost('employee_unique_id'),
                    'sir_name' => $this->request->getPost('sir_name'),
                    'first_name' => $this->request->getPost('first_name'),
                    'middle_name' => $this->request->getPost('middle_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'bloods_group' => $this->request->getPost('blood_group'),
                    'gender' => $this->request->getPost('gender'),
                    'material_status' => $this->request->getPost('material_status'),
                    'designation_id' => $this->request->getPost('designation_id'),
                    'department_id' => implode(",",  $this->request->getPost('department_id')),
                    'mobile_no' => $this->request->getPost('mobile_no'),
                    'alternate_mobile_no' => $this->request->getPost('alternate_mobile_no'),
                    'landline_no' => $this->request->getPost('landline_no'),
                    'official_mail' => $this->request->getPost('official_mail'),
                    'personal_mail' => $this->request->getPost('personal_mail'),
                    'caste' => $this->request->getPost('caste'),
                    'ews' => $this->request->getPost('ews') ?? '',
                    'religion' => $this->request->getPost('religion'),
                    'employee_nature' => $this->request->getPost('employee_nature'),
                    'employee_type' => $this->request->getPost('employee_type'),
                    'profile_photo' => $imageName,
                    'resume_file' => $resumeimageName,
                    'twitter' => $this->request->getPost('twitter'),
                    'facebook' => $this->request->getPost('facebook'),
                    'linkedin' => $this->request->getPost('linkedin'),
                    'research' => $this->request->getPost('research'),
                    'google_h_index' => $this->request->getPost('google_h_index'),
                    'i10_index' => $this->request->getPost('i10_index'),
                    'scopus_h_index' => $this->request->getPost('scopus_h_index'),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status' => $this->request->getPost('status'),
                    'joining_date' => $this->request->getPost('joining_date'),
                    'employee_status' => $this->request->getPost('employee_status'),
                    'relieving_date' => $this->request->getPost('releiving_date'),
                    'research_gate_id' => $this->request->getPost('research_gate_id'),
                    'orcid_id' => $this->request->getPost('orcid_id'),
                    'google_scholar_id' => $this->request->getPost('google_scholar_id'),
                    'vidwan' => $this->request->getPost('vidwan'),
                    'authority' => 'user',
                    'upload_by' =>  $loggeduserId,
                    // 'first_name' => $this->request->getPost('first_name'),
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function edit_employee($id){
            $employee_nature_model = new Employee_nature_model();
            $department_model = new Department_model();
            $designation_model = new Designation_model();
            $employee_model = new Employee_model();
            $data = ['title' => 'Employee Details','employee_id' => $id];
            $data['employee_details'] = $employee_model->get($id);
            // echo "<pre>";print_r($data['employee_details']); die;
            if ($this->request->is("get")) {
                $data['employee_nature'] = $employee_nature_model->get();
                $data['departments'] = $department_model->get();
                $data['designations'] = $designation_model->get();
                $data['employee'] = $employee_model->get();
                // print_r($data['employee_detail']); die;
                return view('admin/employee/edit-employee',$data);
            }else if ($this->request->is("post")) {
                // echo "<pre>";print_r($this->request->getPost('department_id')); die;
                // $department =  implode(",",  $this->request->getPost('department_id'));
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $employee_details = $employee_model->get($id);
                $old_profile_image = $employee_details['profile_photo'];
                $old_resume_file = $employee_details['resume_file'];

                $profile_image = $this->request->getFile('profile_photo');
                
                if (empty($old_profile_image)) {
                    if ($profile_image->isValid() && !$profile_image->hasMoved()) {
                        $new_profile_image = "profile" . $profile_image->getRandomName();
                        $profile_image->move(ROOTPATH . 'public/admin/uploads/employee/', $new_profile_image);
                    } else {
                        $new_profile_image = null;
                    }
                } else {
                    if ($profile_image->isValid() && !$profile_image->hasMoved()) {
                        if (file_exists("public/admin/uploads/employee/" . $old_profile_image)) {
                            unlink("public/admin/uploads/employee/" . $old_profile_image);
                        }
                        $new_profile_image = "report" . $profile_image->getRandomName();
                        $profile_image->move(ROOTPATH . 'public/admin/uploads/employee/', $new_profile_image);
                    } else {
                        $new_profile_image = $old_profile_image;
                    }
                }


                $resume_file = $this->request->getFile('resume_file');
                if (empty($old_resume_file)) {
                    if ($resume_file->isValid() && !$resume_file->hasMoved()) {
                        $new_resume_file = "report" . $resume_file->getRandomName();
                        $resume_file->move(ROOTPATH . 'public/admin/uploads/employee/', $new_resume_file);
                    } else {
                        $new_resume_file = null;
                    }
                } else {
                    if ($resume_file->isValid() && !$resume_file->hasMoved()) {
                        if (file_exists("public/admin/uploads/employee/" . $old_resume_file)) {
                            unlink("public/admin/uploads/employee/" . $old_resume_file);
                        }
                        $new_resume_file = "resume" . $resume_file->getRandomName();
                        $resume_file->move(ROOTPATH . 'public/admin/uploads/employee/', $new_resume_file);
                    } else {
                        $new_resume_file = $old_resume_file;
                    }
                }
                

                $data = [
                    'employee_unique_id' => $this->request->getPost('employee_unique_id'),
                    'sir_name' => $this->request->getPost('sir_name'),
                    'first_name' => $this->request->getPost('first_name'),
                    'middle_name' => $this->request->getPost('middle_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'bloods_group' => $this->request->getPost('blood_group'),
                    'gender' => $this->request->getPost('gender'),
                    'material_status' => $this->request->getPost('material_status'),
                    'designation_id' => $this->request->getPost('designation_id'),
                    'department_id' => implode(",",  $this->request->getPost('department_id')),
                    'mobile_no' => $this->request->getPost('mobile_no'),
                    'alternate_mobile_no' => $this->request->getPost('alternate_mobile_no'),
                    'landline_no' => $this->request->getPost('landline_no'),
                    'official_mail' => $this->request->getPost('official_mail'),
                    'personal_mail' => $this->request->getPost('personal_mail'),
                    'caste' => $this->request->getPost('caste'),
                    'ews' => $this->request->getPost('ews') ?? '',
                    'religion' => $this->request->getPost('religion'),
                    'employee_nature' => $this->request->getPost('employee_nature'),
                    'employee_type' => $this->request->getPost('employee_type'),
                    'profile_photo' => $new_profile_image,
                    'resume_file' => $new_resume_file,
                    'twitter' => $this->request->getPost('twitter'),
                    'facebook' => $this->request->getPost('facebook'),
                    'linkedin' => $this->request->getPost('linkedin'),
                    'research' => $this->request->getPost('research'),
                    'google_h_index' => $this->request->getPost('google_h_index'),
                    'i10_index' => $this->request->getPost('i10_index'),
                    'scopus_h_index' => $this->request->getPost('scopus_h_index'),
                    'status' => $this->request->getPost('status'),
                    'joining_date' => $this->request->getPost('joining_date'),
                    'employee_status' => $this->request->getPost('employee_status'),
                    'relieving_date' => $this->request->getPost('releiving_date'),
                    'research_gate_id' => $this->request->getPost('research_gate_id'),
                    'orcid_id' => $this->request->getPost('orcid_id'),
                    'google_scholar_id' => $this->request->getPost('google_scholar_id'),
                    'vidwan' => $this->request->getPost('vidwan'),
                    'authority' => 'user',
                    'upload_by' =>  $loggeduserId,
                    // 'first_name' => $this->request->getPost('first_name'),
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-employee/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function delete_employee($id){
            $employee_model = new Employee_model();
            $employee_details = $employee_model->get($id);
            $old_profile_image = $employee_details['profile_photo'];
            $old_resume_file = $employee_details['resume_file'];
            $profile_image_path = "public/admin/uploads/employee/" . $old_profile_image;
            $resume_file_path = "public/admin/uploads/employee/" . $old_resume_file;

            // Check if the file exists and is actually a file (not a directory)
            if (!empty($old_profile_image) && file_exists($profile_image_path) && is_file($profile_image_path)) {
                unlink($profile_image_path);
            }

            if (!empty($old_resume_file) && file_exists($resume_file_path) && is_file($resume_file_path)) {
                unlink($resume_file_path);
            }
            $result = $employee_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/employee')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function employee_details($id){
            $employee_model = new Employee_model();
            $data = ['title' => 'Employee Details','employee_id' => $id];
            $data['employee_details'] = $employee_model->get($id);
            return view('admin/employee/employee-details',$data);
        }

        public function employee_experience(){
            $organisation_type_model = new Organisation_type_model();
            $nature_of_work_model = new Nature_of_work_model();
            $employee_model = new Employee_model();
            $employee_experience_model = new Employee_experience_model();
            $data = ['title' => 'Employee Experience'];
            if ($this->request->is("get")) {
                $data['organisation_type'] = $organisation_type_model->get();
                $data['nature_of_work'] = $nature_of_work_model->get();
                $data['employee'] = $employee_model->get();
                $data['employee_exp'] = $employee_experience_model->get();
                return view('admin/employee/employee-experience',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $orgname = $this->request->getPost('orgname');
                $stillwork = $this->request->getPost('stillwork');
                
                foreach ($orgname as $key => $value) {
                    $isStillWorking = isset($stillwork[$key]) ? 1 : 0; 
                    $data = [
                        'emplyee_id' => $this->request->getPost('Empid'),
                        'organization_name' => $value,
                        'start_date' => $this->request->getPost('startdate')[$key],
                        'end_date' => $this->request->getPost('enddate')[$key],
                        'stillwork' => $isStillWorking ? 1 : 0,
                        'exp_description' => $this->request->getVar('expdesc')[$key],
                        'org_type' => $this->request->getPost('orgtype')[$key],
                        'work_nature' => $this->request->getPost('natureofwork')[$key],
                        'work_description' => $this->request->getPost('work_description')[$key] ?? '',
                        'upload_by' =>  $loggeduserId,
                    ];
    
                    // echo "<pre>";print_r($data);
                    $result = $employee_experience_model->add($data);
                }
                // die;
                if ($result === true) {
                    return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


        public function edit_employee_experience($id){
            $organisation_type_model = new Organisation_type_model();
            $nature_of_work_model = new Nature_of_work_model();
            $employee_model = new Employee_model();
            $employee_experience_model = new Employee_experience_model();
            $data = ['title' => 'Employee Experience','employee_exp_id' => $id];
            
            // print_r($data['employee_exp_detail']); die;
            if ($this->request->is("get")) {
                $data['organisation_type'] = $organisation_type_model->get();
                $data['nature_of_work'] = $nature_of_work_model->get();
                $data['employee'] = $employee_model->get();
                $data['employee_exp'] = $employee_experience_model->get();
                $data['employee_exp_detail'] = $employee_experience_model->get($id);
                return view('admin/employee/edit-employee-experience',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }

                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'organization_name' => $this->request->getPost('orgname'),
                    'start_date' => $this->request->getPost('startdate'),
                    'end_date' => $this->request->getPost('enddate'),
                    'stillwork' => $this->request->getPost('stillwork') ?? 0,
                    'exp_description' => $this->request->getVar('expdesc'),
                    'org_type' => $this->request->getPost('orgtype'),
                    'work_nature' => $this->request->getPost('natureofwork'),
                    'work_description' => $this->request->getPost('work_description') ?? '',
                    'upload_by' =>  $loggeduserId,
                ];
    
                    // echo "<pre>";print_r($data);
                $result = $employee_experience_model->add($data,$id);
            
                // die;
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-experience/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-experience/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_employee_experience($id){
            $employee_experience_model = new Employee_experience_model();
            $delete = $employee_experience_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/employee-experience/')->with('msg','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/employee-experience/')->with('msg','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }

        }

        public function employee_projects(){
            $employee_model = new Employee_model();
            $employee_projects_model = new Employee_projects_model();
            $data = ['title' => 'Employee Projects'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['employee_projects'] = $employee_projects_model->get();
                return view('admin/employee/employee-projects',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $project_start_date = $this->request->getPost('project_start_date');
                foreach ($project_start_date as $key => $value) {
                    $data = [
                        'emplyee_id' => $this->request->getPost('Empid'),
                        'project_title' => $this->request->getPost('projecttitle')[$key],
                        // 'project_description' => $this->request->getPost('projectdesc')[$key],
                        'start_date' => $value,
                        // 'start_time' => $this->request->getPost('project_start_time')[$key],
                        'end_date' => $this->request->getPost('project_end_date')[$key],
                        // 'end_time' => $this->request->getPost('project_end_time')[$key],
                        'sanctioned_year' => $this->request->getPost('sanctioned_year')[$key],
                        'project_status' => $this->request->getPost('projectstatus')[$key],
                        'sponsored_by' => $this->request->getPost('projectsponseredby')[$key],
                        'project_value' => $this->request->getPost('projectvalue')[$key],
                        'role' => $this->request->getPost('role')[$key],
                        'funding_source' => $this->request->getPost('funding_source')[$key],
                        'other_funding_source' => $this->request->getPost('other_funding_source')[$key] ?? '',
                        'upload_by' =>  $loggeduserId,
                    ];

                    // echo "<pre>";print_r($data);
                    $result = $employee_projects_model->add($data);
                }
                // die;
                if ($result === true) {
                    return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_employee_projects($id){
            $employee_model = new Employee_model();
            $employee_projects_model = new Employee_projects_model();
            $data = ['title' => 'Employee Projects','emp_project_id' => $id];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['employee_projects'] = $employee_projects_model->get();
                $data['employee_projects_detail'] = $employee_projects_model->get($id);
                return view('admin/employee/edit-employee-projects',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'project_title' => $this->request->getPost('projecttitle'),
                    // 'project_description' => $this->request->getPost('projectdesc'),
                    'start_date' => $this->request->getPost('project_start_date'),
                    // 'start_time' => $this->request->getPost('project_start_time'),
                    'end_date' => $this->request->getPost('project_end_date'),
                    // 'end_time' => $this->request->getPost('project_end_time'),
                    'sanctioned_year' => $this->request->getPost('sanctioned_year'),
                    'project_status' => $this->request->getPost('projectstatus'),
                    'sponsored_by' => $this->request->getPost('projectsponseredby'),
                    'project_value' => $this->request->getPost('projectvalue'),
                    'role' => $this->request->getPost('role'),
                    'funding_source' => $this->request->getPost('funding_source'),
                    'other_funding_source' => $this->request->getPost('other_funding_source') ?? '',
                    'upload_by' =>  $loggeduserId,
                ];

                // echo "<pre>";print_r($data);
                $result = $employee_projects_model->add($data,$id);
                
                // die;
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-projects/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-projects/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_employee_projects($id){
            $employee_projects_model = new Employee_projects_model();
            $delete = $employee_projects_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/employee-projects/')->with('msg','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/employee-projects/')->with('msg','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }

        }

        public function employee_publication(){
            $employee_model = new Employee_model();
            $employee_publication_model = new Employee_publication_model();
            $employee_publication_author_model = new Employee_publication_author_model();
            $data = ['title' => 'Employee Publication'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['publication'] = $employee_publication_model->get();
                return view('admin/employee/employee-publication',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $publication_photo = $this->request->getFile('Pubphotoupload');
                if ($publication_photo->isValid() && ! $publication_photo->hasMoved()) {
                    $publicationimageName = $publication_photo->getRandomName();
                    $publication_photo->move(ROOTPATH . 'public/admin/uploads/publication', $publicationimageName);    
                }else{
                 $publicationimageName = "";
                }

                $author_name = $this->request->getPost('author_name');

                $data = [
                    'emplyee_id' => implode(",",$this->request->getPost('Empid')),
                    'title' => $this->request->getPost('Pubtitle'),
                    'description' => $this->request->getPost('description'),
                    'keywords' => $this->request->getPost('Pubkeyword'),
                    'publication_photo' => $publicationimageName,
                    'published_name' => $this->request->getPost('published_name'),
                    'volume_number' => $this->request->getPost('volume_number'),
                    'publish_date_online' => $this->request->getPost('publish_date_online'),
                    'publish_date_print' => $this->request->getPost('publish_date_print'),
                    'date_of_acceptance' => $this->request->getPost('date_of_acceptance'),
                    'date_of_communication' => $this->request->getPost('date_of_communication'),
                    'doi_details' => $this->request->getPost('DoIdetails'),
                    'publication_year' => $this->request->getPost('Pubyear'),
                    'journal_name' => $this->request->getPost('journal_name'),
                    'page_no' => $this->request->getPost('page_no'),
                    'reffered' => $this->request->getPost('reffered'),
                    'issn_no' => $this->request->getPost('issn_no'),
                    'isbn_no' => $this->request->getPost('isbn_no'),
                    'impact_factor' => $this->request->getPost('impact_factor'),
                    'web_link' => $this->request->getPost('web_link'),
                    'publication_type' => $this->request->getPost('Pubtype'),
                    'status' => $this->request->getPost('Pubstatus'),
                    'publication_role' => $this->request->getPost('publication_role'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $employee_publication_model->add($data);
                if ($result === true) {
                    $insertId = $employee_publication_model->getInsertID();
                    foreach ($author_name as $value) {
                        $data2 = [
                            'author_name' => $value,
                            'emp_publication_id' => $insertId,
                        ];
                        $employee_publication_author_model->add($data2);
                    }
                    return redirect()->to('admin/employee-publication')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-publication')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_employee_publication($id){
            $employee_model = new Employee_model();
            $employee_publication_model = new Employee_publication_model();
            $employee_publication_author_model = new Employee_publication_author_model();
            $data = ['title' => 'Employee Publication','emp_publication_id' => $id];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['publication'] = $employee_publication_model->get();
                $data['publication_detail'] = $employee_publication_model->get($id);
                $data['publication_author_detail'] = $employee_publication_author_model->getByPublication($id);
                return view('admin/employee/edit-employee-publication',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $publication_photo = $this->request->getFile('Pubphotoupload');
                $publication_detail = $employee_publication_model->get($id);
                $old_publication_photo = $publication_detail['publication_photo'];
                if (empty($old_publication_photo)) {
                    if ($publication_photo->isValid() && !$publication_photo->hasMoved()) {
                        $publication_photo_name = "publication" . $publication_photo->getRandomName();
                        $publication_photo->move(ROOTPATH . 'public/admin/uploads/publication/', $publication_photo_name);
                    } else {
                        $publication_photo_name = null;
                    }
                } else {
                    if ($publication_photo->isValid() && !$publication_photo->hasMoved()) {
                        if (file_exists("public/admin/uploads/publication/" . $old_publication_photo)) {
                            unlink("public/admin/uploads/publication/" . $old_publication_photo);
                        }
                        $publication_photo_name = "publication" . $publication_photo->getRandomName();
                        $publication_photo->move(ROOTPATH . 'public/admin/uploads/publication/', $publication_photo_name);
                    } else {
                        $publication_photo_name = $old_publication_photo;
                    }
                }

                // $author_name = $this->request->getPost('author_name');

                $data = [
                    'emplyee_id' => implode(",",$this->request->getPost('Empid')),
                    'title' => $this->request->getPost('Pubtitle'),
                    // 'description' => $this->request->getPost('description'),
                    'keywords' => $this->request->getPost('Pubkeyword'),
                    'publication_photo' => $publication_photo_name,
                    'published_name' => $this->request->getPost('published_name'),
                    'volume_number' => $this->request->getPost('volume_number'),
                    'publish_date_online' => $this->request->getPost('publish_date_online'),
                    'publish_date_print' => $this->request->getPost('publish_date_print'),
                    'date_of_acceptance' => $this->request->getPost('date_of_acceptance'),
                    'date_of_communication' => $this->request->getPost('date_of_communication'),
                    'doi_details' => $this->request->getPost('DoIdetails'),
                    'publication_year' => $this->request->getPost('Pubyear'),
                    'journal_name' => $this->request->getPost('journal_name'),
                    'page_no' => $this->request->getPost('page_no'),
                    'reffered' => $this->request->getPost('reffered'),
                    'issn_no' => $this->request->getPost('issn_no'),
                    'isbn_no' => $this->request->getPost('isbn_no'),
                    'impact_factor' => $this->request->getPost('impact_factor'),
                    'web_link' => $this->request->getPost('web_link'),
                    'publication_type' => $this->request->getPost('Pubtype'),
                    'status' => $this->request->getPost('Pubstatus'),
                    'publication_role' => $this->request->getPost('publication_role'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $employee_publication_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-publication/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-publication/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function addnewpubauthor(){
            $employee_publication_author_model = new Employee_publication_author_model();
            $pub_id = $this->request->getPost('pub_id');
             $data2 = [
                'author_name' => $this->request->getPost('newPubAuthor'),
                'emp_publication_id' => $pub_id,
            ];
            $result = $employee_publication_author_model->add($data2);
            if ($result === true) {
                return redirect()->to('admin/edit-employee-publication/'.$pub_id)->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-employee-publication/'.$pub_id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function delete_employee_publication($id){
            $employee_publication_model = new Employee_publication_model();
            $employee_publication_author_model = new Employee_publication_author_model();
            $delete = $employee_publication_model->delete($id);
            if ($delete) {
                $employee_publication_author_model->where('emp_publication_id',$id)->delete();
                return redirect()->to('admin/employee-publication/')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee-publication/')->with('msg','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }

        }

        public function deletPubAuthor($id){
            $employee_publication_author_model = new Employee_publication_author_model();
            $delete = $employee_publication_author_model->delete($id);
            if ($delete) {
                echo true;
            } else {
                echo "Failed to delete";
            }

        }

        public function employee_awards(){
            $employee_model = new Employee_model();
            $employee_awards_model = new Employee_awards_model();
            $data = ['title' => 'Employee Awards'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['awards'] = $employee_awards_model->get();
                return view('admin/employee/employee-awards',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $awards_photo = $this->request->getFileMultiple('Awardphotoupload');
                $awards_titles = $this->request->getPost('Awardtitle');
                foreach ($awards_titles as $key => $title) {    
                    $photo = $awards_photo[$key];
                    $photoName = "";
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        $photoName = "awards".$photo->getRandomName();
                        $photo->move(ROOTPATH . 'public/admin/uploads/employee', $photoName);
                    }
                    $data = [
                        'employee_id' => $this->request->getPost('Empid'),
                        'name_of_awarding' => $title,
                        'document_file' => $photoName,
                        'award_reason' => $this->request->getPost('award_reason')[$key],
                        'date_of_awarding' => $this->request->getPost('date_of_awarding')[$key],
                        'body_name_of_awarding' => $this->request->getPost('body_name_of_awarding')[$key],
                        'level' => $this->request->getPost('level')[$key],
                        'upload_by' =>  $loggeduserId,
                    ]; 

                    // echo "<pre>";print_r($data);
                    $result = $employee_awards_model->add($data);
                }
                if ($result === true) {
                    return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function edit_employee_awards($id){
            $employee_model = new Employee_model();
            $employee_awards_model = new Employee_awards_model();
            $data = ['title' => 'Employee Awards','emp_awards_id' => $id];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['awards'] = $employee_awards_model->get();
                $data['awards_detail'] = $employee_awards_model->get($id);
                return view('admin/employee/edit-employee-awards',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $awards_photo = $this->request->getFile('Awardphotoupload');
                $awards_detail = $employee_awards_model->get($id);
                $old_awards_photo = $awards_detail['document_file'];
                if (empty($old_awards_photo)) {
                    if ($awards_photo->isValid() && !$awards_photo->hasMoved()) {
                        $awards_photo_name = "award" . $awards_photo->getRandomName();
                        $awards_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $awards_photo_name);
                    } else {
                        $awards_photo_name = null;
                    }
                } else {
                    if ($awards_photo->isValid() && !$awards_photo->hasMoved()) {
                        if (file_exists("public/admin/uploads/employee/" . $old_awards_photo)) {
                            unlink("public/admin/uploads/employee/" . $old_awards_photo);
                        }
                        $awards_photo_name = "award" . $awards_photo->getRandomName();
                        $awards_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $awards_photo_name);
                    } else {
                        $awards_photo_name = $old_awards_photo;
                    }
                }
                
                $data = [
                    'employee_id' => $this->request->getPost('Empid'),
                    'name_of_awarding' => $this->request->getPost('Awardtitle'),
                    'document_file' => $awards_photo_name,
                    'award_reason' => $this->request->getPost('award_reason'),
                    'date_of_awarding' => $this->request->getPost('date_of_awarding'),
                    'body_name_of_awarding' => $this->request->getPost('body_name_of_awarding'),
                    'level' => $this->request->getPost('level'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $employee_awards_model->add($data,$id);
                
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-awards/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-awards/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function delete_employee_awards($id){
            $employee_awards_model = new Employee_awards_model();
            $delete = $employee_awards_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/employee-awards/')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee-awards/')->with('msg','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

        public function employee_patent(){
            $employee_model = new Employee_model();
            $employee_patent_model = new Employee_patent_model();
            $data = ['title' => 'Employee Patent'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['patent'] = $employee_patent_model->get();
                return view('admin/employee/employee-patent',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $awards_photo = $this->request->getFileMultiple('patent_document');
                $patent_title = $this->request->getPost('patent_title');
                foreach ($patent_title as $key => $title) {    
                    $photo = $awards_photo[$key];
                    $photoName = "";
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        $photoName = "patent".$photo->getRandomName();
                        $photo->move(ROOTPATH . 'public/admin/uploads/employee', $photoName);
                    }
                    $data = [
                        'employee_id' => $this->request->getPost('Empid'),
                        'patent_title' => $title,
                        'document_file' => $photoName,
                        'patent_number' => $this->request->getPost('patent_number')[$key],
                        'patent_level' => $this->request->getPost('level')[$key],
                        'awards_date' => $this->request->getPost('date_of_awarding')[$key],
                        'fund_generated' => $this->request->getPost('fund_generate')[$key],
                        'patent_status' => $this->request->getPost('patent_status')[$key],
                        'upload_by' =>  $loggeduserId,
                    ]; 

                    // echo "<pre>";print_r($data);
                    $result = $employee_patent_model->add($data);
                }
                if ($result === true) {
                    return redirect()->to('admin/employee-patent')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-patent')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_employee_patent($id){
            $employee_model = new Employee_model();
            $employee_patent_model = new Employee_patent_model();
            $data = ['title' => 'Employee Patent','patent_id' => $id];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['patent'] = $employee_patent_model->get();
                $data['patent_detail'] = $employee_patent_model->get($id);
                return view('admin/employee/edit-employee-patent',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $document_photo = $this->request->getFile('patent_document');
                $patent_detail = $employee_patent_model->get($id);
                $old_document_photo = $patent_detail['document_file'];
                if (empty($old_document_photo)) {
                    if ($document_photo->isValid() && !$document_photo->hasMoved()) {
                        $document_photo_name = "patent" . $document_photo->getRandomName();
                        $document_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $document_photo_name);
                    } else {
                        $document_photo_name = null;
                    }
                } else {
                    if ($document_photo->isValid() && !$document_photo->hasMoved()) {
                        if (file_exists("public/admin/uploads/employee/" . $old_document_photo)) {
                            unlink("public/admin/uploads/employee/" . $old_document_photo);
                        }
                        $document_photo_name = "patent" . $document_photo->getRandomName();
                        $document_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $document_photo_name);
                    } else {
                        $document_photo_name = $old_document_photo;
                    }
                }


                $data = [
                    'employee_id' => $this->request->getPost('Empid'),
                    'patent_title' => $this->request->getPost('patent_title'),
                    'document_file' => $document_photo_name,
                    'patent_number' => $this->request->getPost('patent_number'),
                    'patent_level' => $this->request->getPost('level'),
                    'awards_date' => $this->request->getPost('date_of_awarding'),
                    'fund_generated' => $this->request->getPost('fund_generate'),
                    'patent_status' => $this->request->getPost('patent_status'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                    // echo "<pre>";print_r($data);
                    $result = $employee_patent_model->add($data,$id);
                
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-patent/'.$id)->with('msg','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-patent/'.$id)->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_employee_patent($id){
            $employee_patent_model = new Employee_patent_model();
            $patent_detail = $employee_patent_model->get($id);
            $old_document_photo = $patent_detail['document_file'];
            $file_path = "public/admin/uploads/employee/" . $old_document_photo;
            if (!empty($old_document_photo) && file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
            $result = $employee_patent_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/employee-patent')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee-patent')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }



        public function employee_charge(){
            $employee_model = new Employee_model();
            $designation_model = new Designation_model();
            $employee_projects_model = new Employee_projects_model();
            $employee_additioonal_charge_model = new Employee_additioonal_charge_model();
            $data = ['title' => 'Employee Additonal Charge'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                $data['designation'] = $designation_model->get();
                $data['employee_projects'] = $employee_projects_model->get();
                return view('admin/employee/employee-charge',$data);
            }else if ($this->request->is("post")) {
                $employeeId = $this->request->getPost('employee_id');
                $designations = $this->request->getPost('designation') ?? [];

                $save = $employee_additioonal_charge_model->updateEmployeeDesignations((int) $employeeId, $designations);

                if ($save) {
                    return redirect()->to('admin/employee-charge')->with('msg', '<div class="alert alert-success" role="alert">Data saved successfully</div>');
                } else {
                    return redirect()->to('admin/employee-charge')->with('msg', '<div class="alert alert-danger" role="alert">Failed to save data</div>');
                }
                
            }
        }




        // Export Employee Sample Controller function ============================

        public function export_emp_experience_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-experience')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,organization_name,start_date,end_date,description,organization_type,nature_of_work\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Sample Organization',
                        '2024-01-01',
                        '2024-12-31',
                        'Sample Description',
                        'Private',
                        'Development'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_experience_sample.csv');
            }
        }

        public function export_emp_project_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-projects')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,project_title,start_date,end_date,sanctioned_year,project_status,sponsored_by,project_value\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Project title',
                        '2024-01-01',
                        '2024-12-31',
                        '2000',
                        'Not Started',
                        'Sponsored name',
                        '10000'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_project_sample.csv');
            }
        }

        public function export_emp_award_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,name_of_awarding,award_reason,date_of_awarding,body_name_of_awarding,level\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Award test title',
                        'Acadmic/Research',
                        '2024-01-01',
                        'IT Industry',
                        'National/International'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_award_sample.csv');
            }
        }

        public function export_emp_publication_sample(){
            $employee_model = new Employee_model();
            $empIds = $this->request->getPost('emp_id');
            //echo "<pre>"; print_r($empIds); die;
            if (empty($empIds) || !is_array($empIds)) {
                return redirect()->to('admin/employee-awards')->with('msg','<div class="alert alert-danger" role="alert"> No Employee Selected </div>');
            }
            //echo "<pre>"; print_r($employees); die;
            if ($empIds) {
                $employeeDetails = $employee_model->getEmployeeDetailsByIds($empIds);
                $csvData = "emp_name,email,emp_phone,title,description,keywords,author_name,doi_details,publication_year,publication_type,status\n";
                foreach ($employeeDetails as $employee) {
                    $csvData .= implode(",", [
                        $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'],
                        $employee['official_mail'],
                        $employee['mobile_no'],
                        'Publication test title',
                        'Publication Description',
                        'keywords1',
                        'Name1',
                        'DoI Details',
                        '2024',
                        'Review Article',
                        'In Proceeding/Published'
                    ]) . "\n";
                }
                // Generate CSV file
                $this->generateCSV($csvData, 'employee_publication_sample.csv');
            }
        }

        private function generateCSV($csvData, $fileName){
        $response = $this->response->setContentType('text/csv')
                                    ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                                    ->setBody($csvData)
                                    ->send();
            return $response;
        }



        // Import CSV File of Employees ===========================================================

        public function upload_emp_experience_csv(){
            $employeeModel = new \App\Models\Employee_model();
            $experienceModel = new \App\Models\Employee_experience_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim header row

                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values

                    // Validate mandatory fields
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['organization_name'])) {
                        continue; // Skip if mandatory fields are missing
                    }

                    // Find the employee_id based on email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();

                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'emplyee_id'       => $employee['id'],
                            'organization_name' => $data['organization_name'],
                            'start_date'        => date('Y-m-d', strtotime($data['start_date'])),
                            'end_date'          => date('Y-m-d', strtotime($data['end_date'])),
                            'exp_description'   => $data['description'],
                            'org_type'          => $data['organization_type'],
                            'work_nature'       => $data['nature_of_work'],
                            'upload_by'         => $loggeduserId,
                        ];

                        // echo "<pre>"; print_r($experienceData);
                        // Validate and insert
                        $experienceModel->insert($experienceData);
                    }
                }

                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
            }

            return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
        }

        public function upload_emp_project_csv() {
            $employeeModel = new \App\Models\Employee_model();
            $employeeProjectsModel = new Employee_projects_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggedUserId = $sessionData['loggeduserId']; 
            } else {
                return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Session expired. Please log in again.</div>');
            }
        
            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
        
                // Read the CSV data into an array
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim the header row
        
                // Loop through each row in the CSV
                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values
        
                    // Validate mandatory fields (email, emp_phone, and organization_name)
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['project_title'])) {
                        continue; // Skip if mandatory fields are missing
                    }
        
                    // Find the employee by email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();
        
                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'emplyee_id'        => $employee['id'],
                            'project_title'     => $data['project_title'],
                            // 'project_description' => $data['project_description'],
                            'start_date'        => date('Y-m-d', strtotime($data['start_date'])),
                            // 'start_time'        => $data['start_time'],
                            'end_date'          => date('Y-m-d', strtotime($data['end_date'])),
                            'sanctioned_year'          => $data['sanctioned_year'],
                            'project_status'    => $data['project_status'],
                            'sponsored_by'      => $data['sponsored_by'],
                            'project_value'     => $data['project_value'],
                            'upload_by'         => $loggedUserId,
                        ];
        
                        // Debug output (remove in production)
                        // echo "<pre>"; print_r($experienceData);
        
                        // Insert the data into the database (uncomment to enable)
                        $employeeProjectsModel->insert($experienceData);
                    }
                }
        
                // Return success message
                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
        
            } else {
                // Return error message if the file is invalid
                return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
            }
        }        


        public function upload_emp_award_csv(){
            $employeeModel = new \App\Models\Employee_model();
            $employee_awards_model = new Employee_awards_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim header row

                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values

                    // Validate mandatory fields
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['name_of_awarding'])) {
                        continue; // Skip if mandatory fields are missing
                    }

                    // Find the employee_id based on email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();

                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'employee_id'        => $employee['id'],
                            'name_of_awarding'       => $data['name_of_awarding'],
                            'award_reason'        => $data['award_reason'],
                            'date_of_awarding'   => date('Y-m-d', strtotime($data['date_of_awarding'])),
                            'body_name_of_awarding' => $data['body_name_of_awarding'],
                            'level' => $data['level'],
                            'upload_by'         => $loggeduserId,
                        ];

                        // echo "<pre>"; print_r($data['email']);
                        // Validate and insert
                        $employee_awards_model->insert($experienceData);
                    }
                }

                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
            }

            return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
        }


        public function upload_emp_publication_csv(){
            $employeeModel = new \App\Models\Employee_model();
            $employee_publication_model = new Employee_publication_model();
            $employee_publication_author_model = new Employee_publication_author_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }

            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
                $csvData = array_map('str_getcsv', file($fileContent));
                $header = array_map('trim', array_shift($csvData)); // Extract and trim header row

                foreach ($csvData as $row) {
                    $data = array_combine($header, $row); // Combine header with row values

                    // Validate mandatory fields
                    if (empty($data['email']) || empty($data['emp_phone']) || empty($data['title'])) {
                        continue; // Skip if mandatory fields are missing
                    }

                    // Find the employee_id based on email and phone
                    $employee = $employeeModel
                        ->where('official_mail', $data['email'])
                        ->where('mobile_no', $data['emp_phone'])
                        ->first();

                        
                        $author_name = explode(',',$data['author_name']);

                    if ($employee) {
                        // Prepare data for insertion
                        $experienceData = [
                            'emplyee_id'        => $employee['id'],
                            'title'             => $data['title'],
                            'description'       => $data['description'],
                            'keywords'          => $data['keywords'],
                            'doi_details'       => $data['doi_details'],
                            'publication_year'  => $data['publication_year'],
                            'publication_type'  => $data['publication_type'],
                            'status'            => ($data['status'] == "Published") ? 1 : 0,
                            'upload_by'         => $loggeduserId,
                        ];

                        // echo "<pre>"; print_r($experienceData);

                        // Validate and insert
                        $save = $employee_publication_model->insert($experienceData);

                        if($save){
                            foreach ($author_name as $value) {
                                $data2 = [
                                    'author_name' => $value,
                                    'emp_publication_id' => $save,
                                ];
                                // echo "<pre>"; print_r($data2);
                                $employee_publication_author_model->add($data2);
                            }
                        }

                    }
                }

                return redirect()->back()->with('msg', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully!</div>');
            }

            return redirect()->back()->with('msg', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
        }


        public function getEmployeeDesignations($emp_id){
            $employee_additioonal_charge_model = new Employee_additioonal_charge_model();
            $designations = $employee_additioonal_charge_model->where('employee_id',$emp_id)->findAll();
            return $this->response->setJSON($designations);
        }

        public function organisation_type(){
            $organisation_type_model = new Organisation_type_model();
            $data = ['title' => 'Organization Type'];
            if ($this->request->is('get')) {
                $data['organisation_type'] = $organisation_type_model->get();
                return view('admin/employee/organisation-type',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('organisation_name'),
                    'upload_by' => $loggeduserId
                ];
                $result = $organisation_type_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/organisation-type')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/organisation-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_organisation_type($id){
            $organisation_type_model = new Organisation_type_model();
            $data = ['title' => 'Organization Type','organisation_id' => $id];
            if ($this->request->is('get')) {
                $data['organisation_type'] = $organisation_type_model->get();
                $data['organisation_detail'] = $organisation_type_model->get($id);
                return view('admin/employee/edit-organisation-type',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('organisation_name'),
                    'upload_by' => $loggeduserId
                ];
                $result = $organisation_type_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-organisation-type/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-organisation-type/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_organisation_type($id){
            $organisation_type_model = new Organisation_type_model();
            $result = $organisation_type_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/organisation-type')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/organisation-type')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function work_nature(){
            $nature_of_work_model = new Nature_of_work_model();
            $data = ['title' => 'Nature of Work'];
            if ($this->request->is('get')) {
                $data['work_nature'] = $nature_of_work_model->get();
                return view('admin/employee/work-nature',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('work_nature'),
                    'upload_by' => $loggeduserId
                ];
                $result = $nature_of_work_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/work-nature')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/work-nature')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_work_nature($id){
            $nature_of_work_model = new Nature_of_work_model();
            $data = ['title' => 'Nature of Work','work_nature_id' => $id];
            if ($this->request->is('get')) {
                $data['work_nature'] = $nature_of_work_model->get();
                $data['work_nature_detail'] = $nature_of_work_model->get($id);
                return view('admin/employee/edit-work-nature',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('work_nature'),
                    'upload_by' => $loggeduserId
                ];
                $result = $nature_of_work_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-work-nature/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-work-nature/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_work_nature($id){
            $nature_of_work_model = new Nature_of_work_model();
            $result = $nature_of_work_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/work-nature')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/work-nature')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function employee_nature(){
            $employee_nature_model = new Employee_nature_model();
            $data = ['title' => 'Nature of Work'];
            if ($this->request->is('get')) {
                $data['employee_nature'] = $employee_nature_model->get();
                return view('admin/employee/employee-nature',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('emp_nature'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_nature_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-nature')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-nature')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_employee_nature($id){
            $employee_nature_model = new Employee_nature_model();
            $data = ['title' => 'Nature of Work','emp_nature_id' => $id];
            if ($this->request->is('get')) {
                $data['employee_nature'] = $employee_nature_model->get();
                $data['employee_nature_detail'] = $employee_nature_model->get($id);
                return view('admin/employee/edit-employee-nature',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('emp_nature'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_nature_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-nature/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-nature/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_employee_nature($id){
            $employee_nature_model = new Employee_nature_model();
            $result = $employee_nature_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/employee-nature')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee-nature')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function book_chapter(){
            $employee_model = new Employee_model();
            $books_chapter_model = new Books_chapter_model();
            $books_chapter_author = new Books_chapter_author();
            $books_chapter_coauthor = new Books_chapter_coauthor();
            $data = ['title' => 'Book Chapter'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['books_chapter'] = $books_chapter_model->get();
                return view('admin/employee/book-chapter',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }

                $upload_file = $this->request->getFile('upload_file');
                if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                    $upload_fileNewName = 'books'.rand(0,9999) .$upload_file->getRandomName();
                    $upload_file->move(ROOTPATH . 'public/admin/uploads/books', $upload_fileNewName);    
                }else{
                 $upload_fileNewName = "";
                }

                $data = [
                    'emplyee_id' => $this->request->getPost('Empid'),
                    'book_chapter' => $this->request->getPost('book_chapter'),
                    'title' => $this->request->getPost('title'),
                    'publisher' => $this->request->getPost('publisher'),
                    'level' => $this->request->getPost('level'),
                    'total_pages' => $this->request->getPost('total_pages'),
                    'publich_date_online' => $this->request->getPost('publich_date_online'),
                    'publich_date_print' => $this->request->getPost('publich_date_print'),
                    'acceptance_date' => $this->request->getPost('acceptance_date'),
                    'communication_date' => $this->request->getPost('communication_date'),
                    'isbn' => $this->request->getPost('isbn'),
                    'issn_no' => $this->request->getPost('issn_no'),
                    'doi' => $this->request->getPost('doi'),
                    'web_link' => $this->request->getPost('web_link'),
                    'upload_file' => $upload_fileNewName,
                    'upload_by' => $loggeduserId,
                ];

                $author_name = $this->request->getPost('author_name');
                $co_author_name = $this->request->getPost('co_author_name');

                $result = $books_chapter_model->add($data);
                if ($result === true) {
                    $insertId = $books_chapter_model->getInsertID();

                    foreach ($author_name as $key => $value) {
                        $data =[
                            'books_chapter_id' => $insertId,
                            'author_name' => $value,
                        ];
                        $result = $books_chapter_author->add($data);
                    }
                    foreach ($co_author_name as $key => $value) {
                        $data =[
                            'books_chapter_id' => $insertId,
                            'coauthor_name' => $value,
                        ];
                        $result = $books_chapter_coauthor->add($data);
                    }
                    return redirect()->to('admin/book-chapter')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                }else {
                    return redirect()->to('admin/book-chapter')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }  
            }
        }

        

        public function employee_academic_details(){
            $employee_model = new Employee_model();
            $country_model = new Country_model();
            $employee_academic_details_model = new Employee_academic_details_model();
            $data = ['title' => 'Employee Acadmic Details'];
            if ($this->request->is('get')) {
                $data['country'] = $country_model->getCountry();
                $data['employee'] = $employee_model->get();
                $data['employee_academic_details'] = $employee_academic_details_model->get();
                return view('admin/employee/employee-academic-details',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $document = $this->request->getFile('document_file');
                if ($document->isValid() && ! $document->hasMoved()) {
                    $documentNewName = "academic".rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                }else{
                 $documentNewName = "";
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'degree_type' => $this->request->getPost('degree_type'),
                    'degree_name' => $this->request->getPost('degree_name'),
                    'subject_studied' => $this->request->getPost('subject_studied'),
                    // 'marking_scheme' => $this->request->getPost('marking_scheme'),
                    // 'obtained_result' => $this->request->getPost('obtained_result'),
                    'passing_year' => $this->request->getPost('passing_year'),
                    'university' => $this->request->getPost('university'),
                    'university_country' => $this->request->getPost('university_country'),
                    'university_state' => $this->request->getPost('university_state'),
                    'document_file' => $documentNewName,
                    'upload_by' => $loggeduserId,
                ];
                $result = $employee_academic_details_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-academic-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-academic-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_employee_academic_details($id){
            $employee_model = new Employee_model();
            $country_model = new Country_model();
            $employee_academic_details_model = new Employee_academic_details_model();
            $data = ['title' => 'Employee Acadmic Details','academic_id' => $id];
            if ($this->request->is('get')) {
                $data['country'] = $country_model->getCountry();
                $data['employee'] = $employee_model->get();
                $data['employee_academic_details'] = $employee_academic_details_model->get();
                $data['academic_details'] = $employee_academic_details_model->get($id);
                return view('admin/employee/edit-employee-academic-details',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $document_photo = $this->request->getFile('document_file');
                $academic_details = $employee_academic_details_model->get($id);
                $old_document_photo = $academic_details['document_file'];
                if (empty($old_document_photo)) {
                    if ($document_photo->isValid() && !$document_photo->hasMoved()) {
                        $document_photo_name = "acadmic" . $document_photo->getRandomName();
                        $document_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $document_photo_name);
                    } else {
                        $document_photo_name = null;
                    }
                } else {
                    if ($document_photo->isValid() && !$document_photo->hasMoved()) {
                        if (file_exists("public/admin/uploads/employee/" . $old_document_photo)) {
                            unlink("public/admin/uploads/employee/" . $old_document_photo);
                        }
                        $document_photo_name = "acadmic" . $document_photo->getRandomName();
                        $document_photo->move(ROOTPATH . 'public/admin/uploads/employee/', $document_photo_name);
                    } else {
                        $document_photo_name = $old_document_photo;
                    }
                }
                
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'degree_type' => $this->request->getPost('degree_type'),
                    'degree_name' => $this->request->getPost('degree_name'),
                    'subject_studied' => $this->request->getPost('subject_studied'),
                    // 'marking_scheme' => $this->request->getPost('marking_scheme'),
                    // 'obtained_result' => $this->request->getPost('obtained_result'),
                    'passing_year' => $this->request->getPost('passing_year'),
                    'university' => $this->request->getPost('university'),
                    'university_country' => $this->request->getPost('university_country'),
                    'university_state' => $this->request->getPost('university_state'),
                    'document_file' => $document_photo_name,
                    'upload_by' => $loggeduserId,
                ];
                $result = $employee_academic_details_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-employee-academic-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-employee-academic-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_employee_academic_details($id){
             $employee_academic_details_model = new Employee_academic_details_model();
            $patent_detail = $employee_academic_details_model->get($id);
            $old_document_photo = $patent_detail['document_file'];
            $file_path = "public/admin/uploads/employee/" . $old_document_photo;
            if (!empty($old_document_photo) && file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
            $result = $employee_academic_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/employee-academic-details')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/employee-academic-details')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function employee_other_academic_details(){
            $employee_model = new Employee_model();
            $employee_academic_details_model = new Emp_other_academic_detail_model();
            $data = ['title' => 'Employee Other Acadmic Details'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_academic_details'] = $employee_academic_details_model->get();
                return view('admin/employee/emp-other-academic-details',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'examination_type' => $this->request->getPost('examination_type'),
                    'passing_year' => $this->request->getPost('passing_year'),
                    'conduct_by' => $this->request->getPost('conduct_by'),
                    'roll_no' => $this->request->getPost('roll_no'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_academic_details_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/emp-other-academic-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/emp-other-academic-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
            
        }

        public function edit_emp_other_academic_details($id){
            $employee_model = new Employee_model();
            $employee_academic_details_model = new Emp_other_academic_detail_model();
            $data = ['title' => 'Employee Other Acadmic Details','other_acadmic_id' => $id];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_academic_details'] = $employee_academic_details_model->get();
                $data['employee_other_academic'] = $employee_academic_details_model->get($id);
                return view('admin/employee/edit-emp-other-academic-details',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'examination_type' => $this->request->getPost('examination_type'),
                    'passing_year' => $this->request->getPost('passing_year'),
                    'conduct_by' => $this->request->getPost('conduct_by'),
                    'roll_no' => $this->request->getPost('roll_no'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_academic_details_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-emp-other-academic-details/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/edit-emp-other-academic-details/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function delete_emp_other_academic_details($id){
            $employee_academic_details_model = new Emp_other_academic_detail_model();
            $result = $employee_academic_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/emp-other-academic-details')->with('msg','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
            } else {
                return redirect()->to('admin/emp-other-academic-details')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }


        public function phd_detail(){
            $country_model = new Country_model();
            $employee_model = new Employee_model();
            $department_model = new Department_model();
           $phd_detail_model =  new Phd_detail_model();
            $data = ['title' => 'PHD Details'];
            if ($this->request->is('get')) {
                $data['country'] = $country_model->getCountry();
                $data['employee'] = $employee_model->get();
                $data['department'] = $department_model->get();
                $data['phd_detail'] = $phd_detail_model->get();
                return view('admin/employee/phd-detail',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                // $document = $this->request->getFile('document_file');
                // if ($document->isValid() && ! $document->hasMoved()) {
                //     $documentNewName = "phd_detail".rand(0,9999).$document->getRandomName();
                //     $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                // }else{
                //  $documentNewName = "";
                // }

                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'degree_type' => $this->request->getPost('degree_type') ?? '',
                    'subject_studied' => $this->request->getPost('subject_studied') ?? '',
                    'phd_thesis' => $this->request->getPost('phd_thesis'),
                    'degree_status' => $this->request->getPost('degree_status'),
                    'registration_date' => $this->request->getPost('registration_date'),
                    'submission_date' => $this->request->getPost('submission_date'),
                    'award_date' => $this->request->getPost('award_date'),
                    'university' => $this->request->getPost('university'),
                    'university_country' => $this->request->getPost('university_country'),
                    'university_state' => $this->request->getPost('university_state'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $phd_detail_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/phd-detail')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/phd-detail')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function mphil_ug_pg_detail(){
            $student_model = new Student_model();
            $employee_model = new Employee_model();
            $mphil_ug_pg_model = new Mphil_ug_pg_model();
            $data = ['title' => 'MPhil/PG/UG Ongoing Details'];
            if ($this->request->is('get')) {
                $data['student'] = $student_model->get();
                $data['employee'] = $employee_model->get();
                $data['mphil_ug_pg'] = $mphil_ug_pg_model->get();
                return view('admin/employee/mphil-ug-pg-detail',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $document = $this->request->getFile('documemt_file');
                if ($document->isValid() && ! $document->hasMoved()) {
                    $documentNewName = "ugpg".rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                }else{
                 $documentNewName = "";
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    // 'student_title' => $this->request->getPost('student_title'),
                    'student_name' => $this->request->getPost('student_name'),
                    // 'student_category' => $this->request->getPost('student_category'),
                    'synopsis_name' => $this->request->getPost('synopsis_name'),
                    // 'roll_no' => $this->request->getPost('roll_no'),
                    // 'semester' => $this->request->getPost('semester'),
                    'remarks' => $this->request->getPost('remarks'),
                    'university_name' => $this->request->getPost('university_name'),
                    'registration_date' => $this->request->getPost('registration_date'),
                    'status' => $this->request->getPost('status'),
                    'submission_date' => $this->request->getPost('submission_date') ?? '',
                    'award_date' => $this->request->getPost('award_date') ?? '',
                    'documemt_file' => $documentNewName,
                    'upload_by' => $loggeduserId,
                ];
                $result = $mphil_ug_pg_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/mphil-ug-pg-detail')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/mphil-ug-pg-detail')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function ongoing_phd(){
            $department_model = new Department_model();
            $ongoing_phd_model = new Ongoing_phd_model();
            $employee_model = new Employee_model();
            $employee_academic_details_model = new Emp_other_academic_detail_model();
            $data = ['title' => 'Ongoing PHD Details'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['department'] = $department_model->get();
                $data['ongoing_php'] = $ongoing_phd_model->get();
                $data['employee_academic_details'] = $employee_academic_details_model->get();
                return view('admin/employee/ongoing-phd',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $document = $this->request->getFile('document_file');
                if ($document->isValid() && ! $document->hasMoved()) {
                    $documentNewName = "ongoing_phd".rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                }else{
                 $documentNewName = "";
                }

                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'student_name' => $this->request->getPost('student_name'),
                    'subject_thesis' => $this->request->getPost('subject_thesis'),
                    'university_name' => $this->request->getPost('university_name'),
                    'department' => $this->request->getPost('department'),
                    'university_country' => $this->request->getPost('university_country'),
                    'role' => $this->request->getPost('role'),
                    'registration_date' => $this->request->getPost('registration_date'),
                    'registration_date' => $this->request->getPost('registration_date'),
                    'registration_date' => $this->request->getPost('registration_date'),
                    'status' => $this->request->getPost('status'),
                    'submission_date' => $this->request->getPost('submission_date') ?? '',
                    'award_date' => $this->request->getPost('award_date') ?? '',
                    'document_file' => $documentNewName,
                    'upload_by' => $loggeduserId,
                ];
                $result = $ongoing_phd_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/ongoing-phd')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/ongoing-phd')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function course_tought(){
            $employee_model = new Employee_model();
            $department_model = new Department_model();
            $course_tought_model = new Course_tought_model();
            $data = ['title' => 'Employee Course Tought'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['department'] = $department_model->get();
                $data['course_tought'] = $course_tought_model->get();
                return view('admin/employee/course-tought',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                // $course_names = $this->request->getPost('course_name');
                $data = [
                    'employee_id' => $this->request->getPost('Empid'),
                    'course_name' => implode(',', $this->request->getPost('course_name')),
                    'department_id' => $this->request->getPost('department_id'),
                    'upload_by' => $loggeduserId,
                ];
                // print_r($data); die;
                $result = $course_tought_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/course-tought')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/course-tought')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function emp_fellowship(){
            $employee_model = new Employee_model();
            $employee_fellowship_model = new Employee_fellowship_model();
            $data = ['title' => 'Employee Fellowship'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_fellowship'] = $employee_fellowship_model->get();
                return view('admin/employee/emp-fellowship',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }

                $document = $this->request->getFile('upload_file');
                if ($document->isValid() && ! $document->hasMoved()) {
                    $documentNewName = "fellowship".rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                }else{
                 $documentNewName = "";
                }

                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'membership_title' => $this->request->getPost('membership_title'),
                    'description' => $this->request->getPost('description'),
                    'organization' => $this->request->getPost('organization'),
                    'member_reg_no' => $this->request->getPost('member_reg_no'),
                    'member_since' => $this->request->getPost('member_since'),
                    'membership_end' => $this->request->getPost('membership_end'),
                    'current_member' => $this->request->getPost('current_member') ?? 0,
                    'upload_file' => $documentNewName,
                    'upload_by' => $loggeduserId,
                ];
                $result = $employee_fellowship_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/emp-fellowship')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/emp-fellowship')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


        public function employee_seed_money(){
            $employee_model = new Employee_model();
            $employee_seed_money_model = new Employee_seed_money_model();
            $data = ['title' => 'Employee Seed Money'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_seed_money'] = $employee_seed_money_model->get();
                return view('admin/employee/employee-seed-money',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'received_money' => $this->request->getPost('received_money'),
                    'years' => $this->request->getPost('years'),
                    'grant_duration' => $this->request->getPost('grant_duration'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_seed_money_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-seed-money')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-seed-money')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_collaboration(){
            $employee_model = new Employee_model();
            $employee_collaboration_model = new Employee_collaboration_model();
            $data = ['title' => 'Employee Collaboration'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_collaboration'] = $employee_collaboration_model->get();
                return view('admin/employee/employee-collaboration',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                
                $document = $this->request->getFile('file_upload');
                if ($document->isValid() && ! $document->hasMoved()) {
                    $documentNewName = "coll".rand(0,9999).$document->getRandomName();
                    $document->move(ROOTPATH . 'public/admin/uploads/employee', $documentNewName);    
                }else{
                 $documentNewName = "";
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'title' => $this->request->getPost('title'),
                    'collaborative_agency' => $this->request->getPost('collaborative_agency'),
                    'collaboration_year' => $this->request->getPost('collaboration_year'),
                    'duartion_in_month' => $this->request->getPost('duartion_in_month'),
                    'name_of_activity' => $this->request->getPost('name_of_activity'),
                    'file_upload' => $documentNewName,
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_collaboration_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-collaboration')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-collaboration')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_mou(){
            $employee_model = new Employee_model();
            $employee_mou_model = new Employee_mou_model();
            $data = ['title' => 'Employee MoUs'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_mou'] = $employee_mou_model->get();
                return view('admin/employee/employee-mou',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'mou_title' => $this->request->getPost('mou_title'),
                    'institution_name' => $this->request->getPost('institution_name'),
                    'entring_mou_year' => $this->request->getPost('entring_mou_year'),
                    'duration' => $this->request->getPost('duration'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_mou_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-mou')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-mou')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_seminar_conference(){
            $employee_model = new Employee_model();
            $employee_seminar_conference_model = new Employee_seminar_conference_model();
            $data = ['title' => 'Employee Seminar Conference'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_seminar_conference'] = $employee_seminar_conference_model->get();
                return view('admin/employee/employee-seminar-conference',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }

                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'type_of_activity' => $this->request->getPost('type_of_activity'),
                    'other_activity' => $this->request->getPost('other_activity'),
                    'seminar_name' => $this->request->getPost('seminar_name'),
                    'from_date' => $this->request->getPost('from_date'),
                    'to_date' => $this->request->getPost('to_date'),
                    'role' => $this->request->getPost('role'),
                    'designation' => $this->request->getPost('designation'),
                    'level' => $this->request->getPost('level'),
                    'start_date' => $this->request->getPost('start_date'),
                    'end_date' => $this->request->getPost('end_date'),
                    'no_of_participant' => $this->request->getPost('no_of_participant'),
                    'funding_agency_name' => $this->request->getPost('funding_agency_name'),
                    'fund_amount' => $this->request->getPost('fund_amount'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_seminar_conference_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-seminar-conference')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-seminar-conference')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function employee_talk_poster(){
            $employee_model = new Employee_model();
            $employee_talk_poster_model = new Employee_talk_poster_model();
            $data = ['title' => 'Employee Talk/Poster Presented'];
            if ($this->request->is('get')) {
                $data['employee'] = $employee_model->get();
                $data['employee_talk_poster'] = $employee_talk_poster_model->get();
                return view('admin/employee/employee-talk-poster',$data);
            }else if ($this->request->is('post')) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'employee_id' => $this->request->getPost('employee_id'),
                    'event_name' => $this->request->getPost('event_name'),
                    'location' => $this->request->getPost('location'),
                    'organizing_institute_name' => $this->request->getPost('organizing_institute_name'),
                    'role' => $this->request->getPost('role'),
                    'other_role' => $this->request->getPost('other_role') ??'',
                    'start_date' => $this->request->getPost('start_date'),
                    'end_date' => $this->request->getPost('end_date'),
                    'upload_by' => $loggeduserId
                ];
                $result = $employee_talk_poster_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/employee-talk-poster')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/employee-talk-poster')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

    }
?>