<?php

namespace App\Controllers;

use App\Models\Company_contact_person_model;
use App\Models\Job_result_stage_mapping_model;
use App\Models\Placement_company_detail_model;
use App\Models\Placement_job_details_model;
use App\Models\Placement_job_result_model;
use App\Models\Placement_page_gallery_model;
use App\Models\Placement_page_notification_details_model;
use App\Models\Placement_page_section_gallery_model;
use App\Models\Placement_page_section_model;
use App\Models\Placement_student_result_mapping_model;
use App\Models\Student_model;

class PlacementController extends BaseController
{
    public function company_details()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $data = ['title' => 'Company Details'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            return view('admin/placement/company-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $file = $this->request->getFile('company_logo');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "logo" . $file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/placement', $fileNewName);
            } else {
                $fileNewName = "";
            }
            $photo = $this->request->getFile('company_photo');
            if ($photo->isValid() && ! $photo->hasMoved()) {
                $photoNewName = "company" . $photo->getRandomName();
                $photo->move(ROOTPATH . 'public/admin/uploads/placement', $photoNewName);
            } else {
                $photoNewName = "";
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'company_profile' => $this->request->getPost('company_profile'),
                'company_website' => $this->request->getPost('company_website'),
                'linkedin' => $this->request->getPost('linkedin'),
                'facebook' => $this->request->getPost('facebook'),
                'instagram' => $this->request->getPost('instagram'),
                'twitter' => $this->request->getPost('twitter'),
                'email_1' => $this->request->getPost('email_1'),
                'email_2' => $this->request->getPost('email_2'),
                'helpline_number1' => $this->request->getPost('helpline_number1'),
                'helpline_number2' => $this->request->getPost('helpline_number2'),
                'company_logo' => $fileNewName,
                'company_photo' => $photoNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $placement_company_detail_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_placement_company_details($id){
        $placement_company_detail_model = new Placement_company_detail_model();
        $placementData = $placement_company_detail_model->get($id);
        if ($placementData) {
            if (file_exists("public/admin/uploads/placement/" . $placementData['company_logo'])) {
                unlink("public/admin/uploads/placement/" . $placementData['company_logo']);
            }
            if (file_exists("public/admin/uploads/placement/" . $placementData['company_photo'])) {
                unlink("public/admin/uploads/placement/" . $placementData['company_photo']);
            }
            $result = $placement_company_detail_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/placement-company-details')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
    }

    public function company_contact_person()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $company_contact_person_model = new Company_contact_person_model();
        $data = ['title' => 'Company Contact Person'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            $data['company_contact_person'] = $company_contact_person_model->get();
            return view('admin/placement/company-contact-person', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'contact_name' => $this->request->getPost('contact_name'),
                'contact_designation' => $this->request->getPost('contact_designation'),
                'linkedin' => $this->request->getPost('linkedin'),
                'facebook' => $this->request->getPost('facebook'),
                'instagram' => $this->request->getPost('instagram'),
                'twitter' => $this->request->getPost('twitter'),
                'email_1' => $this->request->getPost('email_1'),
                'email_2' => $this->request->getPost('email_2'),
                'helpline_number1' => $this->request->getPost('helpline_number1'),
                'helpline_number2' => $this->request->getPost('helpline_number2'),
                'upload_by' => $loggeduserId
            ];
            $result = $company_contact_person_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_company_contact_person($id){
        $company_contact_person_model = new Company_contact_person_model();
        $result = $company_contact_person_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/company-contact-person')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function job_details()
    {
        $placement_company_detail_model = new Placement_company_detail_model();
        $placement_job_details_model = new Placement_job_details_model();
        $data = ['title' => 'Job Details'];
        if ($this->request->is('get')) {
            $data['company_details'] = $placement_company_detail_model->get();
            $data['job_details'] = $placement_job_details_model->get();
            return view('admin/placement/job-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'company_name' => $this->request->getPost('company_name'),
                'job_title' => $this->request->getPost('job_title'),
                'job_description' => $this->request->getPost('job_description'),
                'no_of_position' => $this->request->getPost('no_of_position'),
                'minimum_salary' => $this->request->getPost('minimum_salary'),
                'maximun_salary' => $this->request->getPost('maximun_salary'),
                'hiring_date_time' => $this->request->getPost('hiring_date_time'),
                'venue' => $this->request->getPost('venue'),
                'meeting_link' => $this->request->getPost('meeting_link'),
                'upload_by' => $loggeduserId
            ];
            $result = $placement_job_details_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_placement_job_details($id){
        $placement_job_details_model = new Placement_job_details_model();
        $result = $placement_job_details_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/placement-job-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function result_details()
    {
        $placement_job_details_model = new Placement_job_details_model();
        $placement_job_result_model = new Placement_job_result_model();
        $data = ['title' => 'Result Details'];
        if ($this->request->is('get')) {
            $data['job_details'] = $placement_job_details_model->get();
            $data['result_details'] = $placement_job_result_model->get();
            return view('admin/placement/result-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $file = $this->request->getFile('result_file');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "result" . $file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/placement', $fileNewName);
            } else {
                $fileNewName = "";
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),
                'result_title' => $this->request->getPost('result_title'),
                'result_description' => $this->request->getPost('result_description'),
                'result_file' => $fileNewName,
                'notification_date' => $this->request->getPost('notification_date'),
                'upload_by' => $loggeduserId
            ];
            $result = $placement_job_result_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/result-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/result-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_result_details($id){
        $placement_job_result_model = new Placement_job_result_model();
        $placementData = $placement_job_result_model->get($id);
        if ($placementData) {
            if (file_exists("public/admin/uploads/placement/" . $placementData['result_file'])) {
                unlink("public/admin/uploads/placement/" . $placementData['result_file']);
            }
            $result = $placement_job_result_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/result-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/result-details')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
    }

    public function job_student_mapping(){
        $placement_job_details_model = new Placement_job_details_model();
        $data = ['title' => 'Job Student Mapping'];
        if ($this->request->is('get')) {
            $data['job_details'] = $placement_job_details_model->get();
            return view('admin/placement/job-student-mapping', $data);
        } else if ($this->request->is('post')) {
        }
    }

    public function job_result_stage_mapping()
    {
        $placement_job_details_model = new Placement_job_details_model();
        $job_result_stage_mapping_model = new Job_result_stage_mapping_model();
        $data = ['title' => 'Job Result Stage Mapping'];
        if ($this->request->is('get')) {
            $data['job_details'] = $placement_job_details_model->get();
            $data['job_result_stage_mapping'] = $job_result_stage_mapping_model->get();
            return view('admin/placement/job-result-stage-mapping', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),
                'result_title' => $this->request->getPost('result_title'),
                'result_description' => $this->request->getPost('result_description'),
                'upload_by' => $loggeduserId
            ];
            $result = $job_result_stage_mapping_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/job-result-stage-mapping')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/job-result-stage-mapping')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_job_result_stage_mapping($id){
        $job_result_stage_mapping_model = new Job_result_stage_mapping_model();
        $result = $job_result_stage_mapping_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/job-result-stage-mapping')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

    public function student_result_mapping()
    {
        $placement_job_details_model = new Placement_job_details_model();
        $placement_student_result_mapping_model = new Placement_student_result_mapping_model();
        $student_model = new Student_model();
        $data = ['title' => 'Student Result Mapping'];
        if ($this->request->is('get')) {
            $data['job_details'] = $placement_job_details_model->get();
            $data['student_details'] = $student_model->get();
            $data['job_result_stage_mapping'] = $placement_student_result_mapping_model->get();
            return view('admin/placement/student-result-mapping', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'job_id' => $this->request->getPost('job_id'),
                'job_stage' => $this->request->getPost('job_stage'),
                'student_id' => $this->request->getPost('student_id'),
                'result' => $this->request->getPost('result'),
                'upload_by' => $loggeduserId
            ];
            $result = $placement_student_result_mapping_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/student-result-mapping')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/student-result-mapping')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_student_result_mapping($id){
        $placement_student_result_mapping_model = new Placement_student_result_mapping_model();
        $result = $placement_student_result_mapping_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/student-result-mapping')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
        } else {
            return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
        }
    }

   

    public function page_notification_details()
    {
        $placement_page_notification_details_model = new Placement_page_notification_details_model();
        $data = ['title' => 'Page Notification Details'];
        if ($this->request->is('get')) {
            $data['page_notification_details'] = $placement_page_notification_details_model->get();
            return view('admin/placement/page-notification-details', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $file = $this->request->getFile('file_upload');
            if ($file->isValid() && ! $file->hasMoved()) {
                $fileNewName = "notify".$file->getRandomName();
                $file->move(ROOTPATH . 'public/admin/uploads/placement', $fileNewName);    
            }else{
                $fileNewName = "";
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'marquee' => $this->request->getPost('marquee') ?? 0,
                'notification_date' => $this->request->getPost('notification_date'),
                'file_upload' => $fileNewName,
                'upload_by' => $loggeduserId
            ];
            $result = $placement_page_notification_details_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/placement-page-notification-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-page-notification-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_placement_page_notification_details($id){
        $placement_page_notification_details_model = new Placement_page_notification_details_model();
        $placementData = $placement_page_notification_details_model->get($id);
        if ($placementData) {
            if (file_exists("public/admin/uploads/placement/" . $placementData['file_upload'])) {
                unlink("public/admin/uploads/placement/" . $placementData['file_upload']);
            }
            $result = $placement_page_notification_details_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/placement-page-notification-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/placement-page-notification-details')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
    }

    public function page_section_details()
    {
        $placement_page_section_model = new Placement_page_section_model();
        $placement_page_section_gallery_model = new Placement_page_section_gallery_model();
        $data = ['title' => 'Page Section Details'];
        if ($this->request->is('get')) {
            $data['section'] = $placement_page_section_model->get();
            return view('admin/placement/page-section-details', $data);
        } else if ($this->request->is('post')) {
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
            $result = $placement_page_section_model->add($data);
            if ($result === true) {
                $insertId = $placement_page_section_model->insertID();

                if ($gallery_file) {
                    foreach ($gallery_file['file_upload'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = "pagesec".$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/placement', $newName);
                
                            $data = [
                                'placement_page_section_id' => $insertId,
                                'gallery_file' => $newName,
                            ];
                
                            $result = $placement_page_section_gallery_model->save($data);
                        }
                    }
                }


                return redirect()->to('admin/placement-page-section-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-page-section-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_placement_page_section($id){
        $placement_page_section_model = new Placement_page_section_model();
        $placement_page_section_gallery_model = new Placement_page_section_gallery_model();
        $aluminiData = $placement_page_section_model->get($id);
        if ($aluminiData) {
            $section_images = $placement_page_section_gallery_model->getBysection($id);
            if ($section_images) {
                foreach ($section_images as $key => $image) {
                    if (file_exists("public/admin/uploads/placement/" . $image['gallery_file'])) {
                        unlink("public/admin/uploads/placement/" . $image['gallery_file']);
                    }
                    $placement_page_section_gallery_model->where('placement_page_section_id',$id)->delete();
                }
            }
            $result = $placement_page_section_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/placement-page-section-details')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/placement-page-section-details')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
        
    }

    public function page_gallery()
    {
        $placement_page_gallery_model = new Placement_page_gallery_model();
        $data = ['title' => 'Page Gallery'];
        if ($this->request->is('get')) {
            $data['gallery'] = $placement_page_gallery_model->get();
            return view('admin/placement/page-gallery', $data);
        } else if ($this->request->is('post')) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $gallery_file = $this->request->getFiles();
            if ($gallery_file) {
                foreach ($gallery_file['file_upload'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = "gallery".$file->getRandomName();
                        $file->move(ROOTPATH . 'public/admin/uploads/placement', $newName);
            
                        $data = [
                            'title' => $this->request->getPost('title'),
                            'description' => $this->request->getPost('description'),
                            'gallery_date' => $this->request->getPost('gallery_date'),
                            'file_upload' => $newName,
                            'upload_by' => $loggeduserId,
                        ];
            
                        $result = $placement_page_gallery_model->save($data);
                    }
                }
            }
            if ($result === true) {
                return redirect()->to('admin/placement-page-gallery')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/placement-page-gallery')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_placement_page_gallery($id){
        $placement_page_gallery_model = new Placement_page_gallery_model();
        $placementData = $placement_page_gallery_model->get($id);
        if ($placementData) {
            if (file_exists("public/admin/uploads/placement/" . $placementData['file_upload'])) {
                unlink("public/admin/uploads/placement/" . $placementData['file_upload']);
            }
            $result = $placement_page_gallery_model->delete($id);
            if ($result === true) {
                return redirect()->to('admin/placement-page-gallery')->with('status', '<div class="alert alert-success" role="alert">Data deleted successfully.</div>');
            } else {
                return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
            }
        } else {
            return redirect()->to('admin/placement-page-gallery')->with('status', '<div class="alert alert-danger" role="alert">Data not found.</div>');
        }
    }
}
