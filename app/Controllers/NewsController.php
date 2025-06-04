<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\News_model;

    class NewsController extends BaseController{
        public function news_post(){
            $department_model = new Department_model();
            $news_model = new News_model();
            $data = ['title' => 'News Post'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['news'] = $news_model->get();
                // print_r($data['department']);die;

                return view('admin/news_post/news-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $news_file = $this->request->getFile('news_file');
                if ($news_file->isValid() && ! $news_file->hasMoved()) {
                    $news_fileImageName = "news".$news_file->getRandomName();
                    $news_file->move(ROOTPATH . 'public/admin/uploads/news', $news_fileImageName);    
                }else{
                 $news_fileImageName = "";
                }
                $data = [
                    'publish_date' => $this->request->getPost('news_date'),
                    'title' => $this->request->getPost('news_title'),
                    'upload_file' => $news_fileImageName,
                    'department_id' => $this->request->getPost('department_id'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'description' => $this->request->getPost('description'),
                    'upload_by' => $loggeduserId
                ];
                $result = $news_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/news-post')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/news-post')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function edit_news_post($id){
            $department_model = new Department_model();
            $news_model = new News_model();
            $data = ['title' => 'Edit News Post'];
            if ($this->request->is("get")) {
                $data['new_id'] = $id;
                $data['department'] = $department_model->activeData();
                $data['news'] = $news_model->get();
                $data['edit_news'] = $news_model->get($id);
                // print_r($data['department']);die;

                return view('admin/news_post/edit-news-post',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $news_file = $this->request->getFile('news_file');

                $edit_news = $news_model->get($id);
                $old_news_file =  $edit_news['upload_file'];

                if ($news_file->isValid() && !$news_file->hasMoved()) {
                    if(file_exists("public/admin/uploads/news/".$old_news_file)){
                        unlink("public/admin/uploads/news/".$old_news_file);
                    }
                    $new_news_file = $news_file->getRandomName();
                    $news_file->move(ROOTPATH.'public/admin/uploads/news/', $new_news_file);
                }
                else{
                    $new_news_file = $old_news_file;
                }
                $data = [
                    'publish_date' => $this->request->getPost('news_date'),
                    'title' => $this->request->getPost('news_title'),
                    'upload_file' => $new_news_file,
                    'department_id' => $this->request->getPost('department_id'),
                    'marquee_status' => $this->request->getPost('marquee_status'),
                    'status' => $this->request->getPost('status'),
                    'description' => $this->request->getPost('description'),
                    'upload_by' => $loggeduserId
                ];
                $result = $news_model->add($data,$id);
                if ($result === true) {
                    return redirect()->to('admin/edit-news-post/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-news-post/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


        public function delete_news_post($id){
            $news_model = new News_model();
            $edit_news = $news_model->get($id);
            $old_news_file =  $edit_news['upload_file'];
            if(file_exists("public/admin/uploads/news/".$old_news_file)){
                unlink("public/admin/uploads/news/".$old_news_file);
            }
            $delete = $news_model->delete($id);
            if ($delete) {
                return redirect()->to('admin/news-post')->with('status','<div class="alert alert-success" role="alert"> Data delete Successful </div>');
            } else {
                return redirect()->to('admin/news-post')->with('status','<div class="alert alert-danger" role="alert"> Failed to delete </div>');
            }
        }

    }
?>