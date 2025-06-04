<?php
    namespace App\Controllers;

use App\Models\About_niper_model;
use App\Models\Achievements_model;
use App\Models\Act_rules_category_model;
use App\Models\Act_rules_model;
use App\Models\Admission_model;
use App\Models\Annual_report_model;
use App\Models\Assign_quick_link_model;
use App\Models\Banner_slider_model;
use App\Models\Bog_gallery_model;
use App\Models\Bog_members_model;
use App\Models\Bog_model;
use App\Models\Contact_model;
use App\Models\Current_session_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Download_form_model;
use App\Models\Employee_model;
use App\Models\Flash_news_model;
use App\Models\Governmental_link_model;
use App\Models\Image_gallery_model;
use App\Models\Instrument_gallery_model;
use App\Models\Instrument_rates_model;
use App\Models\Instruments_model;
use App\Models\Leadership_media_link_model;
use App\Models\Media_model;
use App\Models\Membership_model;
use App\Models\Menu_heading_model;
use App\Models\Menu_name_model;
use App\Models\Menu_pages_model;
use App\Models\Newsletter_model;
use App\Models\Permission_model;
use App\Models\Photo_album_file_model;
use App\Models\Photo_album_model;
use App\Models\Placement_details_model;
use App\Models\Policy_model;
use App\Models\Private_research_lab_model;
use App\Models\Quick_link_model;
use App\Models\Recruiter_details_model;
use App\Models\Roles_model;
use App\Models\Testimonials_model;
use App\Models\UserModel;
use App\Models\Youtube_link_model;

    class AdminControllers extends BaseController{
        public function adminLogin(){
            $admin_model = new UserModel();
            $employee_model = new Employee_model();
            if ($this->request->is("get")) {
                if (isset($_SESSION['adminLoginned'])) {
                    return view("admin/index"); 
                }
                return view('admin/login');
            }
            else if ($this->request->is("post")) {
                $userId = $this->request->getPost('userId');
                $userPassword = $this->request->getVar('userPassword');

                $data = $employee_model->where('official_mail',$userId)
                                    ->orWhere('mobile_no',$userId)->first();
                if($data){
                    $session_data = [
                        'loggeduserFirstName' => $data['first_name'],
                        'loggeduserPhone' => $data['mobile_no'],
                        'loggeduseremail' => $data['official_mail'],
                        'loggeduserId' => $data['id']
                    ];
                    $userPhone = $data['mobile_no'];
                    if (password_verify($userPassword, $data['password'])) {
                        $this->session->set('loggedUserData',$session_data);
                        $this->session->set('adminLoginned',"adminLoginned");
                        echo "dataMatch";
                    } else {
                    echo 'User ID or Password Mismatch';
                    }
                }
                else{
                    echo "Given Username or Phone Number not found";
                }
            }
           
        }
        public function adminDashboard(){
            $data = [
                'title' => 'Home'
            ];
            return view('admin/index',$data);
        }
        public function logout(){
            $session = session();
            session_unset();
            session_destroy();
            return redirect()->to(base_url('admin/login'));
        }

        // public function director_message(){
        //     $data = ['title' => 'Director Message'];
        //     if ($this->request->is("get")) {
        //         return view('admin/director-message',$data);
        //     }else if ($this->request->is("post")) {

        //     }
        // }

        public function testimonial(){
            $testimonials_model = new Testimonials_model();
            $data = ['title' => 'Testimonial'];
            if ($this->request->is("get")) {
                $data['testimonial'] = $testimonials_model->get();
                return view('admin/testimonial',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $userPhoto = $this->request->getFile('userphoto');
                if ($userPhoto->isValid() && ! $userPhoto->hasMoved()) {
                    $userPhotoImageName = "admission".$userPhoto->getRandomName();
                    $userPhoto->move(ROOTPATH . 'public/admin/uploads/testimonials', $userPhotoImageName);    
                }else{
                 $userPhotoImageName = "";
                }

                $data = [
                    'name' => $this->request->getPost('name'),
                    'designition' => $this->request->getPost('designation'),
                    'upload_file' => $userPhotoImageName,
                    'feedback' => $this->request->getPost('feedback'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $testimonials_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/testimonial')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/testimonial')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function employee_department(){
            $data = ['title' => 'Employee Department Details'];
            if ($this->request->is("get")) {
                return view('admin/employee-department',$data);
            }else if ($this->request->is("post")) {

            }
        }

        

        public function images(){
            $image_gallery_model = new Image_gallery_model();
            $data = ['title' => 'Images'];
            if ($this->request->is("get")) {
                $data['gallery'] = $image_gallery_model->get();
                return view('admin/images',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $gallery_photo = $this->request->getFile('image_file');
                if ($gallery_photo->isValid() && ! $gallery_photo->hasMoved()) {
                    $galleryimageName = $gallery_photo->getRandomName();
                    $gallery_photo->move(ROOTPATH . 'public/admin/uploads/gallery', $galleryimageName);    
                }else{
                 $galleryimageName = "";
                }

                $data = [
                    'image_title' => $this->request->getPost('image_title'),
                    'upload_file' => $galleryimageName,
                    'event_start_date' => $this->request->getPost('event_start_date'),
                    'event_end_date' => $this->request->getPost('event_start_date'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $image_gallery_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/images')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/images')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }


            }
        }
        public function contact(){
            $contact_model = new Contact_model();
            $data = ['title' => 'Contact'];
            if ($this->request->is("get")) {
                $data['contact'] = $contact_model->get(1);
                return view('admin/contact',$data);
            }else if ($this->request->is("post")) {
                $data = [
                    'contact_address' => $this->request->getPost('Contactaddress'),
                    'contact1' => $this->request->getPost('Contactnumber1'),
                    'contact1_desc' => $this->request->getPost('Contactnumberdesc1'),
                    'contact2' => $this->request->getPost('Contactnumber2'),
                    'contact2_desc' => $this->request->getPost('Contactnumberdesc2'),
                    'contact3' => $this->request->getPost('Contactnumber3'),
                    'contact3_desc' => $this->request->getPost('Contactnumberdesc3'),
                    'email_id1' => $this->request->getPost('Contactemailid1'),
                    'email_id2' => $this->request->getPost('Contactemailid2'),
                    'working_days' => $this->request->getPost('Workingdays'),
                    'working_hours' => $this->request->getPost('Workinghours'),
                ];

                $result = $contact_model->add($data,1);
                if ($result === true) {
                    return redirect()->to('admin/contact')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/contact')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function download_forms(){
            $download_form_model = new Download_form_model();
            $data = ['title' => 'Download Forms'];
            if ($this->request->is("get")) {
                $data['download_forms'] = $download_form_model->get();
                return view('admin/download-forms',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $form_file = $this->request->getFile('Formfileupload');
                if ($form_file->isValid() && ! $form_file->hasMoved()) {
                    $form_fileName = $form_file->getRandomName();
                    $form_file->move(ROOTPATH . 'public/admin/uploads/forms', $form_fileName);    
                }else{
                 $form_fileName = "";
                }

                $data = [
                    'title' => $this->request->getPost('Formtitle'),
                    'description' => $this->request->getPost('Formdesc'),
                    'upload_file' => $form_fileName,
                    'status' => $this->request->getPost('Formstatus'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $download_form_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/download-forms')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/download-forms')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function photo_album() {
            $photo_album_model = new Photo_album_model();
            $photo_album_file_model = new Photo_album_file_model();
            $data = ['title' => 'Photo Album'];
        
            if ($this->request->is("get")) {
                $data['albums'] = $photo_album_model->get();
                return view('admin/photo-album', $data);
            } else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                $loggeduserId = $sessionData['loggeduserId'] ?? null;
        
                if (!$loggeduserId) {
                    return redirect()->to('admin/photo-album')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> User session is not valid. Please log in again. </div>'
                    );
                }
        
                $album_title = $this->request->getPost('album_title');
                if (empty($album_title)) {
                    return redirect()->to('admin/photo-album')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> Album title cannot be empty. </div>'
                    );
                }
        
                $album_data = [
                    'album_title' => $album_title,
                    'upload_by' => $loggeduserId,
                ];
        
                $album_id = $photo_album_model->add($album_data);
                if (!$album_id) {
                    return redirect()->to('admin/photo-album')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> Failed to create photo album. Please try again. </div>'
                    );
                }
        
                $album_files = $this->request->getFiles();
                if ($album_files && isset($album_files['album_file'])) {
                    foreach ($album_files['album_file'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(ROOTPATH . 'public/admin/uploads/album', $newName);
        
                            $file_data = [
                                'album_id' => $album_id,
                                'file_name' => $newName,
                            ];
                            // echo "<pre>"; print_r($file_data);
                            $photo_album_file_model->add($file_data);
                        }
                    }
                }
                //  die;
                return redirect()->to('admin/photo-album')->with(
                    'status', 
                    '<div class="alert alert-success" role="alert"> Data added successfully. </div>'
                );
            }
        
            return redirect()->to('admin/photo-album')->with(
                'status', 
                '<div class="alert alert-danger" role="alert"> Invalid request method. </div>'
            );
        }
        
        public function media(){
            $media_model = new Media_model();
            $data = ['title' => 'Media'];
            if ($this->request->is("get")) {
                $data['media'] = $media_model->get();
                return view('admin/media',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $media_photo = $this->request->getFile('media_photo');
                $media_file = $this->request->getFile('media_file');
                if ($media_photo->isValid() && ! $media_photo->hasMoved()) {
                    $media_photoNewName = 'photo_' .$media_photo->getRandomName();
                    $media_photo->move(ROOTPATH . 'public/admin/uploads/media', $media_photoNewName);    
                }else{
                 $media_photoNewName = "";
                }

                if ($media_file->isValid() && ! $media_file->hasMoved()) {
                    $media_fileNewName = 'file_' .$media_file->getRandomName();
                    $media_file->move(ROOTPATH . 'public/admin/uploads/media', $media_fileNewName);    
                }else{
                 $media_fileNewName = "";
                }

                $data = [
                    'title' => $this->request->getPost('media_title'),
                    'publish_date' => $this->request->getPost('publish_date'),
                    'photo_image' => $media_photoNewName,
                    'upload_file' => $media_fileNewName,
                    'description' => $this->request->getPost('mediadesc'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $media_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/media')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/media')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function youtube_link(){
            $youtube_link_model = new Youtube_link_model();
            $data = ['title' => 'Youtube Link'];
            if ($this->request->is("get")) {
                $data['youtube_link'] = $youtube_link_model->get();
                return view('admin/youtube-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $thumbnail = $this->request->getFile('thumbnail');
                if ($thumbnail->isValid() && ! $thumbnail->hasMoved()) {
                    $thumbnailNewName = 'bg_' .$thumbnail->getRandomName();
                    $thumbnail->move(ROOTPATH . 'public/admin/uploads/youtube', $thumbnailNewName);    
                }else{
                 $thumbnailNewName = "";
                }
                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'thumbnail' => $thumbnailNewName,
                    'featured' => $this->request->getPost('featured') ?? 0,
                    'link_url' => $this->request->getPost('youtube_url'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $youtube_link_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/youtube-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/youtube-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function quick_link(){
            $quick_link_model = new Quick_link_model();
            $data = ['title' => 'Quick Links'];
            if ($this->request->is("get")) {
                $data['quick_link'] = $quick_link_model->get();
                return view('admin/quick-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $quicklink_photo = $this->request->getFile('quicklink_file');
                if ($quicklink_photo->isValid() && ! $quicklink_photo->hasMoved()) {
                    $quicklinkimageName = $quicklink_photo->getRandomName();
                    $quicklink_photo->move(ROOTPATH . 'public/admin/uploads/quicklink', $quicklinkimageName);    
                }else{
                 $quicklinkimageName = "";
                }

                $data = [
                    'title' => $this->request->getPost('quicklink_title'),
                    'image_file' => $quicklinkimageName,
                    'page_url' => $this->request->getPost('page_url'),
                    // 'description' => $this->request->getPost('quicklinkdesc'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $quick_link_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/quick-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/quick-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function banner_slider() {
            $banner_slider_model = new Banner_slider_model();
            $data = ['title' => 'Banner Slider'];
        
            if ($this->request->is("get")) {
                $data['banner_slider'] = $banner_slider_model->get();
                return view('admin/banner-slider', $data);
            } else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                $loggeduserId = $sessionData['loggeduserId'] ?? null;
        
                if (!$loggeduserId) {
                    return redirect()->to('admin/banner-slider')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> User session is not valid. Please log in again. </div>'
                    );
                }
        
                $banner_photo = $this->request->getFile('slider_file');
                if ($banner_photo->isValid() && ! $banner_photo->hasMoved()) {
                    $bannerNewPhone = $banner_photo->getRandomName();
                    $banner_photo->move(ROOTPATH . 'public/admin/uploads/slider', $bannerNewPhone);    
                }else{
                 $bannerNewPhone = "";
                }

                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'slider_photo' => $bannerNewPhone,
                    'upload_by' => $loggeduserId,
                ];
                $result = $banner_slider_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/banner-slider')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/banner-slider')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            } // end else if
        }
        
        public function assign_quick_link(){
            $quick_link_model = new Quick_link_model();
            $assign_quick_link_model = new Assign_quick_link_model();
            $data = ['title' => 'Assign Quick Links'];
            if ($this->request->is("get")) {
                $data['quick_link'] = $quick_link_model->get();
                $data['assign_quick_link'] = $assign_quick_link_model->get();
                return view('admin/assign-quick-link',$data);
            }else if ($this->request->is("post")) {
                $quick_links = $this->request->getPost('quick_link');
                if (empty($quick_links)) {
                    return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Quick link cannot be empty or less than 0 selected data</div>');
                }
                foreach ($quick_links as $key => $value) {
                    $data = [
                        'quick_link_id' => $value,
                        'page_name' => $this->request->getPost('page_pane'),
                    ];
                    $result = $assign_quick_link_model->add($data);
                }
                if ($result === true) {
                    return redirect()->to('admin/assign-quick-link')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/assign-quick-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function about(){
            $about_niper_model = new About_niper_model();
            $data = ['title' => 'About Us'];
            if ($this->request->is("get")) {
                $data['about_us'] = $about_niper_model->get(1);
                return view('admin/about',$data);
            }else if ($this->request->is("post")) {
                $signature = $this->request->getFile('aboutusbannerphoto');

                $data = $about_niper_model->where('id',1)->first();
                $old_photo =  $data['banner_photo'];
                //$imageFile = $this->request->getFile('hostel_image');
                if ($signature->isValid() && !$signature->hasMoved()) {
                
                    if(file_exists("public/admin/uploads/frontweb/".$old_photo)){
                        unlink("public/admin/uploads/frontweb/".$old_photo);
                    }
                    $new_image = $signature->getRandomName();
                    $signature->move(ROOTPATH.'public/admin/uploads/frontweb', $new_image);
                }
                else{
                    $new_image = $old_photo;
                }

                $data = [
                    'title' => $this->request->getPost('about_title'),
                    'description' => $this->request->getPost('aboutus_description'),
                    'vision' => $this->request->getPost('about_vision'),
                    'mission' => $this->request->getPost('about_mission'),
                    'objective' => $this->request->getPost('about_objective'),
                    'banner_photo' => $new_image,
                ];

                $result = $about_niper_model->add($data,1);
                if ($result === true) {
                    return redirect()->to('admin/about')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/about')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function bog(){
            $bog_model = new Bog_model();
            $bog_gallery_model = new Bog_gallery_model();
            $data = ['title' => 'BoG Page'];
            if ($this->request->is("get")) {
                $data['bog'] = $bog_model->get();
                return view('admin/bog',$data);
            }else if ($this->request->is("post")) {
                $bog_file = $this->request->getFile('bog_file');
                if ($bog_file->isValid() && ! $bog_file->hasMoved()) {
                    $bog_fileImageName = "admission".$bog_file->getRandomName();
                    $bog_file->move(ROOTPATH . 'public/admin/uploads/bog', $bog_fileImageName);    
                }else{
                 $bog_fileImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('bogtitle'),
                    'description' => $this->request->getPost('bog_description'),
                    'status' => $this->request->getPost('bogstatus'),
                    'upload_file' => $bog_fileImageName
                ];
                $result = $bog_model->add($data);
                if ($result === true) {
                    $insert_id = $bog_model->getInsertID();
                    $gallery_files = $this->request->getFiles();
                    if ($gallery_files && isset($gallery_files['bog_gallery'])) {
                        foreach ($gallery_files['bog_gallery'] as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $newName = rand(0,9999).$file->getRandomName();
                                $file->move(ROOTPATH . 'public/admin/uploads/bog', $newName);
                                $file_data = [
                                    'bog_id' => $insert_id,
                                    'file_name' => $newName,
                                ];
                                $bog_gallery_model->add($file_data);
                            }
                        }
                    }
                    return redirect()->to('admin/bog')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/bog')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function bog_member(){
            $bog_members_model = new Bog_members_model();
            $data = ['title' => 'BoG Member'];
            if ($this->request->is("get")) {
                $data['bog_members'] = $bog_members_model->get();
                return view('admin/bog-member',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                $loggeduserId = $sessionData['loggeduserId'] ?? null;        
                if (!$loggeduserId) {
                    return redirect()->to('admin/bog-member')->with(
                        'status', 
                        '<div class="alert alert-danger" role="alert"> User session is not valid. Please log in again. </div>'
                    );
                }
                $data = [
                    'member_name' => $this->request->getPost('membername'),
                    'affiliation' => $this->request->getPost('affiliation'),
                    'designation' => $this->request->getPost('designation'),
                    'term_start_year' => $this->request->getPost('termyearstart'),
                    'term_end_year' => $this->request->getPost('termyearend'),
                    'upload_by' => $loggeduserId
                ];
                $result = $bog_members_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/bog-member')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/bog-member')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function update_bog_member_order(){
            $bog_members_model = new Bog_members_model();
            $order = $this->request->getPost('order');
            if ($order) {
                foreach ($order as $index => $id) {
                    $bog_members_model->update($id, ['sorted_no' => $index + 1]);
                }
                return $this->response->setJSON(['status' => 'success']);
            }else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No order data received']);
            }
        }

        public function leadership_and_media_link(){
            $leadership_media_link_model = new Leadership_media_link_model();
            $data = ['title' => 'Leadership & Media Links'];
            if ($this->request->is("get")) {
                $data['leadership_media_link'] = $leadership_media_link_model->get();
                return view('admin/leadership-and-media-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $leadership_photo = $this->request->getFile('leadership_file');
                if ($leadership_photo->isValid() && ! $leadership_photo->hasMoved()) {
                    $leadershipImageName = $leadership_photo->getRandomName();
                    $leadership_photo->move(ROOTPATH . 'public/admin/uploads/leader', $leadershipImageName);    
                }else{
                 $leadershipImageName = "";
                }
                $data = [
                    'name' => $this->request->getPost('leadership_name'),
                    'designition' => $this->request->getPost('leadership_designation'),
                    'upload_file' => $leadershipImageName,
                    'description' => $this->request->getPost('description'),
                    'link_url' => $this->request->getPost('link_url'),
                    'facebook_link' => $this->request->getPost('facebook_url'),
                    'instagram_link' => $this->request->getPost('instagram_url'),
                    'twitter_link' => $this->request->getPost('twitter_url'),
                    'youtube_link' => $this->request->getPost('youtube_url'),
                    'linkedin_link' => $this->request->getPost('linkedin_url'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $leadership_media_link_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/leadership-and-media-link')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/leadership-and-media-link')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function membership(){
            $membership_model = new Membership_model();
            $data = ['title' => 'Membership'];
            if ($this->request->is("get")) {
                $data['membership'] = $membership_model->get();
                return view('admin/membership',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                
                $data = [
                    'title' => $this->request->getPost('Membershiptitle'),
                    'description' => $this->request->getPost('description'),
                    'start_date' => $this->request->getPost('Membershipstartdate'),
                    'end_date' => $this->request->getPost('Membershipenddate'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $membership_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/membership')->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
                } else {
                    return redirect()->to('admin/membership')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function admission(){
            $admission_model = new Admission_model();
            $data = ['title' => 'Admission'];
            if ($this->request->is("get")) {
                $data['admission'] = $admission_model->get();
                return view('admin/admission',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $admission_file = $this->request->getFile('admission_file');
                if ($admission_file->isValid() && ! $admission_file->hasMoved()) {
                    $admission_fileImageName = "admission".$admission_file->getRandomName();
                    $admission_file->move(ROOTPATH . 'public/admin/uploads/admission', $admission_fileImageName);    
                }else{
                 $admission_fileImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('admission_title'),
                    'files' => $admission_fileImageName,
                    'description' => $this->request->getPost('Performance_description'),
                    'status' => $this->request->getPost('status'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $admission_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/admission')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/admission')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
                    
            }
        }

        public function act_rules(){
            $act_rules_model = new Act_rules_model();
            $act_rules_category_model = new Act_rules_category_model();
            $data = ['title' => 'Act Rules'];
            if ($this->request->is("get")) {
                $data['act_rules'] = $act_rules_model->get();
                $data['act_rules_category'] = $act_rules_category_model->getActiveData();
                return view('admin/act-rules',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $rules_file = $this->request->getFile('Actrulesfileupload');
                if ($rules_file->isValid() && ! $rules_file->hasMoved()) {
                    $rules_fileImageName = "admission".$rules_file->getRandomName();
                    $rules_file->move(ROOTPATH . 'public/admin/uploads/act_rules', $rules_fileImageName);    
                }else{
                 $rules_fileImageName = "";
                }
                $data = [
                    'rules_type' => $this->request->getPost('Actrulestype'),
                    'rules_title' => $this->request->getPost('Actrulestitle'),
                    'upload_file' => $rules_fileImageName,
                    'act_rules_date' => $this->request->getPost('act_date'),
                    'rules_description' => $this->request->getPost('Actrulesdesc'),
                    'status' => $this->request->getPost('act_status'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $act_rules_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/act-rules')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/act-rules')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function act_rules_category(){
            $act_rules_category_model = new Act_rules_category_model();
            $data = ['title' => 'Act Rules Category'];
            if ($this->request->is("get")) {
                $data['act_rules_category'] = $act_rules_category_model->get();
                return view('admin/act-rules-category',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'name' => $this->request->getPost('category_name'),
                    'status' => $this->request->getPost('act_status'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $act_rules_category_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/act-rules-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/act-rules-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }

            }
        }

        public function annual_report(){
            $annual_report_model = new Annual_report_model();
            $data = ['title' => 'Annual Report'];
            if ($this->request->is("get")) {
                $data['annual_report'] = $annual_report_model->get();
                return view('admin/annual-report',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $report_photo = $this->request->getFile('Annualreportphotoupload');
                if ($report_photo->isValid() && ! $report_photo->hasMoved()) {
                    $report_photoImageName = "photo".$report_photo->getRandomName();
                    $report_photo->move(ROOTPATH . 'public/admin/uploads/annual_report', $report_photoImageName);    
                }else{
                 $report_photoImageName = "";
                }
                $report_file = $this->request->getFile('Annualreportfileupload');
                if ($report_file->isValid() && ! $report_file->hasMoved()) {
                    $report_fileImageName = "file".$report_file->getRandomName();
                    $report_file->move(ROOTPATH . 'public/admin/uploads/annual_report', $report_fileImageName);    
                }else{
                 $report_fileImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('Annualreporttitle'),
                    'start_year' => $this->request->getPost('start_year'),
                    'end_year' => $this->request->getPost('end_year'),
                    'upload_photo' => $report_photoImageName,
                    'upload_file' => $report_fileImageName,
                    'description' => $this->request->getPost('Annualreportdesc'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $annual_report_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/annual-report')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/annual-report')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function placement_details(){
            $placement_details_model = new Placement_details_model();
            $department_model = new Department_model();
            $data = ['title' => 'Placement Details'];
            if ($this->request->is("get")) {
                $data['placement_details'] = $placement_details_model->get();
                $data['department'] = $department_model->get();
                return view('admin/placement-details',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'placement_batch' => $this->request->getPost('Plcbatch'),
                    'department_id' => $this->request->getPost('Deptname'),
                    'total_students' => $this->request->getPost('Totalstudents'),
                    'no_of_placed_students' => $this->request->getPost('Numberofplacedstudent'),
                    'not_interest_student' => $this->request->getPost('Notinterested'),
                    'phd_students' => $this->request->getPost('phd_student'),
                    'upload_by' =>  $loggeduserId,
                ];
                $result = $placement_details_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/placement-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/placement-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function recuiter_details(){
            $recruiter_details_model = new Recruiter_details_model();
            $data = ['title' => 'Recuiter Details'];
            if ($this->request->is("get")) {
                $data['recruiter_details'] = $recruiter_details_model->get();
                return view('admin/recuiter-details',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $Recruiterimage = $this->request->getFile('Recruiterimage');
                if ($Recruiterimage->isValid() && ! $Recruiterimage->hasMoved()) {
                    $RecruiterImageName = "photo".$Recruiterimage->getRandomName();
                    $Recruiterimage->move(ROOTPATH . 'public/admin/uploads/recruiter', $RecruiterImageName);    
                }else{
                 $RecruiterImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('Recruitertitle'),
                    'description' => $this->request->getPost('Recruiterdsc'),
                    'upload_file' => $RecruiterImageName,
                    'upload_by' =>  $loggeduserId,
                ];
                $result = $recruiter_details_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/recuiter-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/recuiter-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function instrument_facility(){
            $instruments_model = new Instruments_model();
            $department_model = new Department_model();
            $instrument_gallery_model = new Instrument_gallery_model();
            $data = ['title' => 'Instrument Facility'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->get();
                $data['instruments'] = $instruments_model->get();
                return view('admin/instrument-facility',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $Recruiterimage = $this->request->getFile('upload_file');
                if ($Recruiterimage->isValid() && ! $Recruiterimage->hasMoved()) {
                    $RecruiterImageName = "photo".$Recruiterimage->getRandomName();
                    $Recruiterimage->move(ROOTPATH . 'public/admin/uploads/instrument', $RecruiterImageName);    
                }else{
                 $RecruiterImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('Recruitertitle'),
                    'department_id' => $this->request->getPost('department'),
                    'description' => $this->request->getPost('description'),
                    'upload_file' => $RecruiterImageName,
                    'upload_by' =>  $loggeduserId,
                ];
                $album_files = $this->request->getFiles();
                $result = $instruments_model->add($data);
                if ($result === true) {
                    $insert_id = $instruments_model->getInsertID();
                    if ($album_files && isset($album_files['gallery_file'])) {
                        foreach ($album_files['gallery_file'] as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $newName = "gallery".rand(0,9999).$file->getRandomName();
                                $file->move(ROOTPATH . 'public/admin/uploads/instrument', $newName);
            
                                $file_data = [
                                    'instrument_id' => $insert_id,
                                    'images' => $newName,
                                ];
                                // echo "<pre>"; print_r($file_data);
                                $instrument_gallery_model->add($file_data);
                            }
                        }
                    }
                    return redirect()->to('admin/instrument-facility')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/instrument-facility')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function instrument_rates(){
            $instruments_model = new Instruments_model();
            $instrument_rates_model = new Instrument_rates_model();
            $data = ['title' => 'Instrument Rates'];
            if ($this->request->is("get")) {
                $data['instrument_rates'] = $instrument_rates_model->get();
                $data['instruments'] = $instruments_model->get();
                return view('admin/instrument-rates',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $data = [
                    'instrument_id' => $this->request->getPost('instrument_id'),
                    'experiment_name' => $this->request->getPost('experiment_names'),
                    'govt_rate' => $this->request->getPost('govt_rate'),
                    'industry_rate' => $this->request->getPost('industry_rate'),
                    'upload_by' =>  $loggeduserId,
                ];
                $result = $instrument_rates_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/instrument-rates')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/instrument-rates')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        public function private_research_labs(){
            $private_research_lab_model = new Private_research_lab_model();
            $instruments_model = new Instruments_model();
            $data = ['title' => 'Private Research Labs'];
            if ($this->request->is("get")) {
                $data['private_research_labs'] = $private_research_lab_model->get();
                $data['instruments'] = $instruments_model->get();
                return view('admin/private-research-labs',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $report_photo = $this->request->getFile('researchimage');
                if ($report_photo->isValid() && ! $report_photo->hasMoved()) {
                    $report_photoImageName = "photo".$report_photo->getRandomName();
                    $report_photo->move(ROOTPATH . 'public/admin/uploads/private_research', $report_photoImageName);    
                }else{
                 $report_photoImageName = "";
                }
                $report_file = $this->request->getFile('researchFile');
                if ($report_file->isValid() && ! $report_file->hasMoved()) {
                    $report_fileImageName = "file".$report_file->getRandomName();
                    $report_file->move(ROOTPATH . 'public/admin/uploads/private_research', $report_fileImageName);    
                }else{
                 $report_fileImageName = "";
                }
                $data = [
                    'title' => $this->request->getPost('researchtitle'),
                    'upload_photo' => $report_photoImageName,
                    'upload_file' => $report_fileImageName,
                    'description' => $this->request->getPost('researchdsc'),
                    'instrument_id' => $this->request->getPost('instrument_id'),
                    'upload_by' =>  $loggeduserId,
                ];

                $result = $private_research_lab_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/private-research-labs')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/private-research-labs')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }
        
        public function modules(){
            $roles_model = new Roles_model();
            $data = ['title' => 'Modules Details'];
            if ($this->request->is("get")) {
                $data['modules'] = $roles_model->get();
                return view('admin/modules',$data);
            }else if ($this->request->is("post")) {

            }
        }

        public function roles_permissions(){
            $roles_model = new Roles_model();
            $employee_model = new Employee_model();
            $designation_model = new Designation_model();
            $department_model = new Department_model();
            $data = ['title' => 'Roles & Permissions'];
            if ($this->request->is("get")) {
                $data['employee'] = $employee_model->get();
                return view('admin/roles-permissions',$data);
            }else if ($this->request->is("post")) {

            }
        }
        public function permission($emp_id){
            $roles_model = new Roles_model();
            $permission_model = new Permission_model();
            $data = ['title' => 'Permissions','emp_id' => $emp_id];
            if ($this->request->is("get")) {
                $data['modules'] = $roles_model->get();
                return view('admin/permission',$data);
            }else if ($this->request->is("post")) {
                $add_type_name = $this->request->getPost('add_type_name');
                $status = $this->request->getPost('status');
                $data = [
                    'emplyee_id' => $emp_id,
                    'module_cat_id' => $this->request->getPost('model_id'),
                ];
                $save  = $permission_model->manage_permission($data,$add_type_name,$status);
                if($save == true){
                    echo true;
                }else{
                    echo "Failed to update";
                }
            }
        }

        public function menu(){
            $menu_heading_model = new Menu_heading_model();
            $menu_name_model = new Menu_name_model();
            $data = ['title' => 'Menu'];
            if ($this->request->is("get")) {
                $data['menu_name'] = $menu_name_model->get();
                $data['menu_heading'] = $menu_heading_model->get();
                return view('admin/menu',$data);
            }else if ($this->request->is("post")) {
                $data = [
                    'name' => $this->request->getPost('menu_name'),
                ];
                $result = $menu_name_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/menu')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/menu')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function menu_heading(){
            $menu_heading_model = new Menu_heading_model();
            $data = [
                'menu_id' => $this->request->getPost('menu_id'),
                'heading' => $this->request->getPost('heading'),
                'custom_link' => $this->request->getPost('custom_link'),
            ];
            // echo "<pre>";print_r($data); die;
            $result = $menu_heading_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/menu')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/menu')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function save_menu_heading_sort_order() {
            $menu_heading_model = new Menu_heading_model();
            $sortedData = $this->request->getJSON(true); 
            if (empty($sortedData)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid data provided']);
            }
            foreach ($sortedData as $key => $value) {
                $id = $value['id'];
                $sort_order = $value['sort_order'];
                $result = $menu_heading_model->update($id, ['heading_sort_list' => $sort_order]);
            }
            if ($result === true) {
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Data updated successfully']);
            } else {
                return $this->response->setStatusCode(400)->setJSON(['error' => $result]);
            }
        }
         
        

        public function save_menu_page_sort_order(){
            $menu_pages_model = new Menu_pages_model();
            $sortedData = $this->request->getJSON(true); 
            if (empty($sortedData)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid data provided']);
            }
            foreach ($sortedData as $key => $value) {
                // print_r($value);
                $id = $value['id'];
                $sort_order = $value['sort_order'];
                $result = $menu_pages_model->update($id, ['page_sort_list' => $sort_order]);
            }
            if ($result === true) {
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Data updated successfully']);
            } else {
                return $this->response->setStatusCode(400)->setJSON(['error' => $result]);
            }
            
        }

        public function save_pages(){
            $menu_pages_model = new Menu_pages_model();
            $page_name = $this->request->getPost('page_name');
            foreach ($page_name as $key => $value) {
                $data = [
                    'menu_id' => $this->request->getPost('assign_menu_id'),
                    'menu_heading_id' => $this->request->getPost('heading_id'),
                    'page_name' => $value,
                ];
                $result = $menu_pages_model->add($data);
            }
            if ($result === true) {
                return redirect()->to('admin/menu')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/menu')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }

        public function currecnt_session(){
            $current_session_model = new Current_session_model();
            $data = ['title' => 'Current Session'];
            if ($this->request->is("get")) {
                $data['current_session'] = $current_session_model->get(1);
                return view('admin/currecnt-session',$data);
            }else if ($this->request->is("post")) {
                $data = [
                    'session_start' => $this->request->getPost('session_start'),
                    'session_end' => $this->request->getPost('session_end'),
                ];
                $result = $current_session_model->add($data,1);
                if ($result === true) {
                    return redirect()->to('admin/currecnt-session')->with('status','<div class="alert alert-success" role="alert"> Data update Successful </div>');
                } else {
                    return redirect()->to('admin/currecnt-session')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }


        public function governmental_link(){
            $governmental_link_model = new Governmental_link_model();
            $data = ['title' => 'Governmental Link'];
            if ($this->request->is("get")) {
                $data['governmental_link'] = $governmental_link_model->get();
                return view('admin/governmental-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $upload_file = $this->request->getFile('upload_file');
                if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                    $upload_file_new_name = rand(0,9999) . $upload_file->getRandomName();
                    $upload_file->move(ROOTPATH . 'public/admin/uploads/government_link', $upload_file_new_name);
                } else {
                    $upload_file_new_name = "";
                }
                $data = [
                    'title' => $this->request->getPost('title'),
                    'web_url' => $this->request->getPost('web_url'),
                    'upload_image' => $upload_file_new_name,
                    'upload_by' => $loggeduserId,
                ];
                $result = $governmental_link_model->add($data);
                if ($result) {
                    return redirect()->to('admin/governmental-link')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/governmental-link')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
                }
            }
        }

        public function edit_governmental_link($id){
            $governmental_link_model = new Governmental_link_model();
            $data = ['title' => 'Governmental Link', 'government_link_id' => $id];
            $data['governmental_link_detail'] = $governmental_link_model->get($id);
            if ($this->request->is("get")) {
                $data['governmental_link'] = $governmental_link_model->get();
                return view('admin/edit-governmental-link',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $new_upload_file = $this->request->getFile('upload_file');
                $governmental_link = $governmental_link_model->get($id);
                $old_image_name =  $governmental_link['upload_image'];
                if ($new_upload_file->isValid() && !$new_upload_file->hasMoved()) {
                    if(file_exists("public/admin/uploads/government_link/".$old_image_name)){
                        unlink("public/admin/uploads/government_link/".$old_image_name);
                    }
                    $new_file_name = rand(0,9999).$new_upload_file->getRandomName();
                    $new_upload_file->move(ROOTPATH.'public/admin/uploads/government_link/', $new_file_name);
                }
                else{
                    $new_file_name = $old_image_name;
                }
                $data = [
                    'title' => $this->request->getPost('title'),
                    'web_url' => $this->request->getPost('web_url'),
                    'upload_image' => $new_file_name,
                    'upload_by' => $loggeduserId,
                ];
                $result = $governmental_link_model->add($data,$id);
                if ($result) {
                    return redirect()->to('admin/edit-governmental-link/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/edit-governmental-link/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
                }
            }
        }

        public function delete_governmental_link($id){
            $governmental_link_model = new Governmental_link_model();
            $governmental_link = $governmental_link_model->get($id);
            $old_image_name =  $governmental_link['upload_image'];
            if(file_exists("public/admin/uploads/government_link/".$old_image_name)){
                unlink("public/admin/uploads/government_link/".$old_image_name);
            }
            $result = $governmental_link_model->delete($id);
            if ($result) {
                return redirect()->to('admin/governmental-link')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/governmental-link')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    
        public function newsletter(){
            $newsletter_model = new Newsletter_model();
            $data = ['title' => 'Newsletter'];
            if ($this->request->is("get")) {
                $data['newsletter'] = $newsletter_model->get();
                return view('admin/newsletter',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
              	$upload_image = $this->request->getFile('upload_image');
                if ($upload_image->isValid() && ! $upload_image->hasMoved()) {
                    $upload_image_new_name = "img".rand(0,9999) . $upload_image->getRandomName();
                    $upload_image->move(ROOTPATH . 'public/admin/uploads/newsletter', $upload_image_new_name);
                } else {
                    $upload_image_new_name = "";
                }
                $upload_file = $this->request->getFile('upload_file');
                if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                    $upload_file_new_name = rand(0,9999) . $upload_file->getRandomName();
                    $upload_file->move(ROOTPATH . 'public/admin/uploads/newsletter', $upload_file_new_name);
                } else {
                    $upload_file_new_name = "";
                }
                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'start_month' => $this->request->getPost('start_month'),
                    'start_year' => $this->request->getPost('start_year'),
                    'end_month' => $this->request->getPost('end_month'),
                    'end_year' => $this->request->getPost('end_year'),
                  	'upload_image' => $upload_image_new_name,
                    'upload_file' => $upload_file_new_name,
                    'upload_by' => $loggeduserId,
                ];
                $result = $newsletter_model->add($data);
                if ($result) {
                    return redirect()->to('admin/newsletter')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/newsletter')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
                }
            
            }
        }
    
        public function flash_news(){
            $flash_news_model = new Flash_news_model();
            $data = ['title' => 'Flash News'];
            if ($this->request->is("get")) {
                $data['flash_news'] = $flash_news_model->get();
                return view('admin/flash-news',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $flash_photo = $this->request->getFile('flash_photo');
                $flash_file = $this->request->getFile('flash_file');
                if ($flash_photo->isValid() && ! $flash_photo->hasMoved()) {
                    $flash_photoNewName = 'photo_' .$flash_photo->getRandomName();
                    $flash_photo->move(ROOTPATH . 'public/admin/uploads/flash_news', $flash_photoNewName);    
                }else{
                 $flash_photoNewName = "";
                }

                if ($flash_file->isValid() && ! $flash_file->hasMoved()) {
                    $flash_fileNewName = 'file_' .$flash_file->getRandomName();
                    $flash_file->move(ROOTPATH . 'public/admin/uploads/flash_news', $flash_fileNewName);    
                }else{
                 $flash_fileNewName = "";
                }

                $data = [
                    'title' => $this->request->getPost('title'),
                    'publish_Date' => $this->request->getPost('publish_date'),
                    'web_link' => $this->request->getPost('web_link'),
                    'status' => $this->request->getPost('status'),
                    'upload_image' => $flash_photoNewName,
                    'upload_file' => $flash_fileNewName,
                    'description' => $this->request->getPost('flashdesc'),
                    'upload_by' =>  $loggeduserId,
                ]; 

                // echo "<pre>";print_r($data);
                $result = $flash_news_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/flash-news')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/flash-news')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function achievements(){
            $achievements_model = new Achievements_model();
            $data = ['title' => 'Achievements -1'];
            if ($this->request->is("get")) {
                $data['achievements'] = $achievements_model->get();
                return view('admin/achievements',$data);
            }else if ($this->request->is("post")) {
                // echo "ok"; die;
                $data =[
                    'title' => $this->request->getPost('title'),
                    'counter_value' => $this->request->getPost('counter'),
                ];
                $result = $achievements_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/achievements')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/achievements')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

        public function policy_details(){
            $policy_model = new Policy_model();
            $data = ['title' => 'Policy Details'];
            if ($this->request->is("get")) {
                $data['policy'] = $policy_model->get();
                return view('admin/policy-details',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $upload_file = $this->request->getFile('upload_file');
                if ($upload_file->isValid() && ! $upload_file->hasMoved()) {
                    $upload_fileNewName = 'photo_' .$upload_file->getRandomName();
                    $upload_file->move(ROOTPATH . 'public/admin/uploads/policy', $upload_fileNewName);    
                }else{
                 $upload_fileNewName = "";
                }

                $data = [
                    'title' => $this->request->getPost('title'),
                    'type' => $this->request->getPost('policy_type'),
                    'upload_file' => $upload_fileNewName,
                    'description' => $this->request->getPost('description'),
                    'web_link' => $this->request->getPost('web_url'),
                    'upload_by' => $loggeduserId,
                ];
                $result = $policy_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/policy-details')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
                } else {
                    return redirect()->to('admin/policy-details')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
                }
            }
        }

    }

?>