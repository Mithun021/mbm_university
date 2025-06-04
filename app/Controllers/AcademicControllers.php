<?php

namespace App\Controllers;

use App\Models\Academic_model;
use App\Models\Admission_brochure_model;
use App\Models\Announcement_model;
use App\Models\Classified_mou_value_model;
use App\Models\Collaboration_faculties_model;
use App\Models\Collaboration_gallery_model;
use App\Models\Collaboration_model;
use App\Models\Department_model;
use App\Models\Research_publication_gallery_model;
use App\Models\Research_publication_model;
use App\Models\Research_publication_type_model;
use App\Models\Rules_regulations_model;

class AcademicControllers extends BaseController
{
    public function academic_details()
    {
        $academic_model = new Academic_model();
        $data = ['title' => 'Academic Details'];
        if ($this->request->is("get")) {
            $data['academic_details'] = $academic_model->get();
            return view('admin/academics/academic-details', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $calendarFile = $this->request->getFile('acdcalenderfileupload');
            if ($calendarFile->isValid() && ! $calendarFile->hasMoved()) {
                $calendarFileImageName = "calendar" . $calendarFile->getRandomName();
                $calendarFile->move(ROOTPATH . 'public/admin/uploads/academic', $calendarFileImageName);
            } else {
                $calendarFileImageName = "";
            }

            $feesFile = $this->request->getFile('acdfeesfileupload');
            if ($feesFile->isValid() && ! $feesFile->hasMoved()) {
                $feesFileImageName = "fees" . $feesFile->getRandomName();
                $feesFile->move(ROOTPATH . 'public/admin/uploads/academic', $feesFileImageName);
            } else {
                $feesFileImageName = "";
            }

            // $examin_grade_file = $this->request->getFile('examin_grade_file');
            // if ($examin_grade_file->isValid() && ! $examin_grade_file->hasMoved()) {
            //     $examin_grade_fileImageName = "grade" . $examin_grade_file->getRandomName();
            //     $examin_grade_file->move(ROOTPATH . 'public/admin/uploads/academic', $examin_grade_fileImageName);
            // } else {
            //     $examin_grade_fileImageName = "";
            // }

            $data = [
                'session_start' => $this->request->getPost('session_start_year'),
                'session_end' => $this->request->getPost('session_end_year'),
                'calendar_file' => $calendarFileImageName,
                'fees_file' => $feesFileImageName,
                // 'exam_grade_file' => $examin_grade_fileImageName,
                'upload_by' => $loggeduserId
            ];

            $result = $academic_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/academic-details')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function accouncement()
    {
        $announcement_model = new Announcement_model();
        $data = ['title' => 'Accouncement'];
        if ($this->request->is("get")) {
            $data['announcement'] = $announcement_model->get();
            return view('admin/academics/accouncement', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $annFile = $this->request->getFile('announcement_file');
            if ($annFile->isValid() && ! $annFile->hasMoved()) {
                $annFileImageName = "calendar" . $annFile->getRandomName();
                $annFile->move(ROOTPATH . 'public/admin/uploads/announcement', $annFileImageName);
            } else {
                $annFileImageName = "";
            }

            $data = [
                'announcement_date' => $this->request->getPost('annoncement_date'),
                'announcement_title' => $this->request->getPost('title'),
                'announcement_desc' => $this->request->getPost('description'),
                'upload_file' => $annFileImageName,
                'announcement_status' => $this->request->getPost('status'),
                'marquee_status' => $this->request->getPost('Marqueestatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $announcement_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/accouncement')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function rules_regulations()
    {
        $rules_regulations_model = new Rules_regulations_model();
        $data = ['title' => 'Rules & Regulations'];
        if ($this->request->is("get")) {
            $data['rules_regulations'] = $rules_regulations_model->get(1);
            return view('admin/academics/rules-regulations', $data);
        } else if ($this->request->is("post")) {
            $new_file = $this->request->getFile('upload_file');
            $data = $rules_regulations_model->where('id', 1)->first();
            $old_file =  $data['upload_file'];
            if ($new_file->isValid() && !$new_file->hasMoved()) {
                if (file_exists("public/admin/uploads/rules_regulation/" . $old_file)) {
                    unlink("public/admin/uploads/rules_regulation/" . $old_file);
                }
                $new_filename = $new_file->getRandomName();
                $new_file->move(ROOTPATH . 'public/admin/uploads/rules_regulation', $new_filename);
            } else {
                $new_filename = $old_file;
            }
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'upload_file' => $new_filename
            ];
            $result = $rules_regulations_model->add($data, 1);
            if ($result === true) {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/rules-regulations')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function research_publication()
    {
        $department_model = new Department_model();
        $research_publication_type_model = new Research_publication_type_model();
        $research_publication_model = new Research_publication_model();
        $research_publication_gallery_model = new Research_publication_gallery_model();
        $data = ['title' => 'Research Publication'];
        if ($this->request->is("get")) {
            $data['department'] = $department_model->activeData();
            // echo "<pre>";print_r($data['department']); die;
            $data['research_publication_type'] = $research_publication_type_model->get();
            $data['research_publication'] = $research_publication_model->get();
            return view('admin/academics/research-publication', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData && isset($sessionData['loggeduserId'])) {
                $loggedUserId = $sessionData['loggeduserId'];
            } else {
                return redirect()->to('admin/login')->with('status', '<div class="alert alert-danger" role="alert"> User not logged in </div>');
            }

            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailNewName = "";

            if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
                $thumbnailNewName = rand(0, 9999) . $thumbnail->getRandomName();
                $thumbnail->move(ROOTPATH . 'public/admin/uploads/research_publication', $thumbnailNewName);
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'thumbnail' => $thumbnailNewName,
                'reseach_publication_type_id' => $this->request->getPost('research_type'),
                'impact_factor' => $this->request->getPost('impact_factor'),
                'faculty_name' => $this->request->getPost('faculty_name'),
                'patent_no' => $this->request->getPost('patent_no'),
                'issn_no' => $this->request->getPost('issn_no'),
                'isbn_no' => $this->request->getPost('isbn_no'),
                'doi_no' => $this->request->getPost('doi_no'),
                'department_id' => $this->request->getPost('department'),
                'upload_by' => $loggedUserId,
            ];
            $result = $research_publication_model->add($data);

            if ($result == true) {
                $insert_id = $research_publication_model->getInsertID();
                $albumFiles = $this->request->getFiles();
                if ($albumFiles && isset($albumFiles['gallery_file'])) {
                    foreach ($albumFiles['gallery_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/research_publication', $newName);
                            $fileData = [
                                'research_publication_id' => $insert_id,
                                'files' => $newName,
                            ];
                            $research_publication_gallery_model->add($fileData);
                        }
                    }
                }
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/research-publication')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function collaboration()
    {
        $collaboration_faculties_model = new Collaboration_faculties_model();
        $collaboration_gallery_model = new Collaboration_gallery_model();
        $collaboration_model = new Collaboration_model();
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Collaboration'];
        if ($this->request->is("get")) {
            $data['classified_mou'] = $classified_mou_value_model->get();
            $data['collaboration'] = $collaboration_model->get();
            return view('admin/academics/collaboration', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $institutelogo = $this->request->getFile('institutelogo');
            if ($institutelogo->isValid() && ! $institutelogo->hasMoved()) {
                $institutelogoNewName = "calendar" . $institutelogo->getRandomName();
                $institutelogo->move(ROOTPATH . 'public/admin/uploads/collaboration', $institutelogoNewName);
            } else {
                $institutelogoNewName = "";
            }
            $Collabfile = $this->request->getFile('Collabfile');
            if ($Collabfile->isValid() && ! $Collabfile->hasMoved()) {
                $CollabfileNewName = "file" . $Collabfile->getRandomName();
                $Collabfile->move(ROOTPATH . 'public/admin/uploads/collaboration', $CollabfileNewName);
            } else {
                $CollabfileNewName = "";
            }
            $gallery_file = $this->request->getFiles();
            $data = [
                'title' => $this->request->getPost('Collabtitle'),
                'description' => $this->request->getPost('description'),
                'institute_name' => $this->request->getPost('Collabinstitutename'),
                'collaboration_date' => $this->request->getPost('Collaborationdate'),
                'collaboration_end_date' => $this->request->getPost('Collaborationenddate'),
                'institute_logo' => $institutelogoNewName,
                'institute_link' => $this->request->getPost('Collabinstituelink'),
                'collaboration_file' => $CollabfileNewName,
                // 'faculty_coordinator' => $this->request->getPost('faculty_coordinator'),
                'classified_mou' => $this->request->getPost('classified_mou'),
                // 'collaboration_tenure_year' => $this->request->getPost('Collabtenure'),
                'status' => $this->request->getPost('Collabstatus'),
                'upload_by' => $loggeduserId
            ];

            $result = $collaboration_model->add($data);
            if ($result === true) {
                $insert_id = $collaboration_model->getInsertID();

                $faculty_coordinator = $this->request->getPost('faculty_coordinator');
                if (!empty($faculty_coordinator)) {
                    foreach ($faculty_coordinator as $key => $faculty) {
                       $data2 = [
                        'collaboration_id' => $insert_id,
                        'faculty_name' => $faculty,
                       ];
                       $result = $collaboration_faculties_model->add($data2);
                    }
                }

                if ($gallery_file) {
                    foreach ($gallery_file['collab_gallery'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = "gallery".rand(0,9999).$file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/collaboration', $newName);
                
                            $data = [
                                'gallery_file' => $newName,
                                'collaboration_id' => $insert_id,
                            ];
                
                            $result = $collaboration_gallery_model->save($data);
                        }
                    }
                }
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/collaboration')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function research_publication_type(){
        $research_publication_type_model = new Research_publication_type_model();
        $data = ['title' => 'Research Publication Type'];
        if ($this->request->is("get")) {
            $data['research_publication_type'] = $research_publication_type_model->get();
            return view('admin/academics/research-publication-type', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('category_name'),
                'upload_by' => $loggeduserId
            ];
            $result = $research_publication_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/research-publication-type')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function classified_mou_value(){
        $classified_mou_value_model = new Classified_mou_value_model();
        $data = ['title' => 'Classified MoU Value'];
        if ($this->request->is("get")) {
            $data['classified_mou_value'] = $classified_mou_value_model->get();
            return view('admin/academics/classified-mou-value',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $data = [
                'name' => $this->request->getPost('mou_value'),
                'upload_by' => $loggeduserId
            ];
            $result = $classified_mou_value_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/classified-mou-value')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }


    public function admission_brochure()
    {
        $admission_brochure_model = new Admission_brochure_model();
        $data = ['title' => 'Admission Brochure'];
        if ($this->request->is("get")) {
            $data['admission_brochure'] = $admission_brochure_model->get();
            return view('admin/academics/admission-brochure', $data);
        } else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId'];
            }
            $upload_file = $this->request->getFile('upload_file');
            if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                $upload_fileNewName = "brochure" . $upload_file->getRandomName();
                $upload_file->move(ROOTPATH . 'public/admin/uploads/brochure', $upload_fileNewName);
            } else {
                $upload_fileNewName = "";
            }

            $data = [
                'title' => $this->request->getPost('title'),
                'upload_file' => $upload_fileNewName,
                'description' => $this->request->getPost('description'),
                'start_batch' => $this->request->getPost('start_year'),
                'end_batch' => $this->request->getPost('end_year'),
                'upload_by' => $loggeduserId,
            ];
            $result = $admission_brochure_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/admission-brochure')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/admission-brochure')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

}
