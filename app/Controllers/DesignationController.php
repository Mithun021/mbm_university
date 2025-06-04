<?php
    namespace App\Controllers;

use App\Models\Designation_model;

    class DesignationController extends BaseController{
        public function designation(){ 
            $designation_model = new Designation_model();
            $data = ['title' => 'Designation'];
            if ($this->request->is("get")) {
                $data['designation'] = $designation_model->get();
                return view('admin/designation/designation',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('designation_title'),
                    'designation_hold' => $this->request->getPost('designation_hold'),
                    // 'description' => $this->request->getPost('description'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' => $loggeduserId
                ];

               $result = $designation_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/designation')->with('msg','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/designation')->with('msg','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
    }
?>