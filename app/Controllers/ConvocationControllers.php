<?php

namespace App\Controllers;

use App\Models\Convocation_model;
use App\Models\Convocation_session_model;

class ConvocationControllers extends BaseController
{
    public function convocation(){
        $convocation_session_model = new Convocation_session_model();
        $convocation_model = new Convocation_model();
        $data = ['title' => 'Convocation'];
        if ($this->request->is("get")) {
            $data['convocation'] = $convocation_model->get();
            return view('admin/convocation/convocation',$data);
        }else if ($this->request->is("post")) {
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
            $conv_file = $this->request->getFile('upload_file');
            if ($conv_file->isValid() && ! $conv_file->hasMoved()) {
                $conv_fileNewName = rand(0,9999).$conv_file->getRandomName();
                $conv_file->move(ROOTPATH . 'public/admin/uploads/convocation', $conv_fileNewName);    
            }else{
                $conv_fileNewName = "";
            }
            $academic_start_year = $this->request->getPost('academic_start_year');
            $data = [
                'title' => $this->request->getPost('conv_title'),
                'upload_file' => $conv_fileNewName,
                'upload_by' => $loggeduserId
            ];

            $result = $convocation_model->add($data);
            if ($result === true) {
                $insertedId = $convocation_model->getInsertID();
                foreach ($academic_start_year as $key => $value) {
                    $data = [
                        'convocation_id' => $insertedId,
                        'session_start' => $value,
                        'session_end' => $this->request->getPost('academic_end_year')[$key]
                    ];
                    $convocation_session_model->add($data);
                }
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/convocation')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }
}
