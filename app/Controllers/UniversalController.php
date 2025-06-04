<?php
    namespace App\Controllers;

use App\Models\Assign_course_model;
use App\Models\Country_model;
use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Event_fee_category_model;
use App\Models\Event_fee_subcategory_model;
use App\Models\Facility_section_model;
use App\Models\Instruments_model;
use App\Models\Job_result_stage_mapping_model;
use App\Models\Mapping_question_model;
use App\Models\Menu_heading_model;
use App\Models\Menu_name_model;
use App\Models\Program_department_mapping_model;
use App\Models\Program_model;
use App\Models\State_city_model;
use App\Models\Student_model;   
    class UniversalController extends BaseController{
        public function findcity(){
            $state_city_model = new State_city_model();
            $state = $this->request->getPost('state');
            $data = $state_city_model->find_city($state);
            return $this->response->setJSON($data);
        }
        public function fetch_programs(){
            $program_model = new Program_model();
            $department_id = $this->request->getPost('dept_id');
            $programCategories = $program_model->getProgramCategoriesByDepartment($department_id);
            return $this->response->setJSON($programCategories);
        }
        public function fetch_menu_heading(){
            $menu_heading_model = new Menu_heading_model();
            $menu_id = $this->request->getPost('menu_id');
            $headings = $menu_heading_model->getAllMenuHeading($menu_id);
            return $this->response->setJSON($headings);
        }
        public function get_event_fee_category(){
            $event_fee_category_model = new Event_fee_category_model();
            $event_id = $this->request->getPost('event_id');
            $event_fee_categories = $event_fee_category_model->getEventFeeCategories($event_id);
            return $this->response->setJSON($event_fee_categories);
        }
        public function get_event_fee_subcategory(){
            $event_fee_subcategory_model = new Event_fee_subcategory_model();
            $event_id = $this->request->getPost('event_id');
            $evtfeestype = $this->request->getPost('evtfeestype');
            $event_fee_categories = $event_fee_subcategory_model->getEventFeeSubcategories($event_id,$evtfeestype);
            return $this->response->setJSON($event_fee_categories);
        }

        public function getStates(){
            $country_name = $this->request->getPost('country_name');
            $country_model = new Country_model();
            $states = $country_model->getState($country_name);
            return $this->response->setJSON($states);
        }

        public function getCourseByDepartment(){
            $department_id = $this->request->getPost('department_id');
            $assign_course_model = new Assign_course_model();
            $course = $assign_course_model->getCourseByDepartment($department_id);
            return $this->response->setJSON($course);
        }

        public function getFacilitySection(){
            $facility_section_model = new Facility_section_model();
            $facility_id = $this->request->getPost('facility_id');
            $sections = $facility_section_model->getFacilitySection($facility_id);
            return $this->response->setJSON($sections);
        }

        public function get_answer_options(){
            $mapping_question_model =new Mapping_question_model();
            $questionId = $this->request->getPost('question_id');
            $answers = $mapping_question_model->getByQuestionType($questionId);
            return $this->response->setJSON($answers);
        }

        public function get_job_restult_stage($job_id){
            $job_result_stage_mapping_model = new Job_result_stage_mapping_model();
            $stages = $job_result_stage_mapping_model->getByJobid($job_id);
            return $this->response->setJSON($stages);
        }

        public function fetch_instrument_by_department(){
            $department_id = $this->request->getPost('department_id');
            $instrument_model = new Instruments_model();
            $instruments = $instrument_model->getInstrumentByDepartment($department_id);
            return $this->response->setJSON($instruments);
        }

        public function testmail(){
            $email = \Config\Services::email();
    
            // Set SMTP configuration (if not configured globally)
            $email->setFrom('noreply@hptuexam.com', 'Vocman Inida');
            $email->setTo('mithunkr79038@gmail.com');
            $email->setSubject('Test Emai');
    
            // HTML message with embedded image
            $email->setMessage('
                <html>
                <body>
                    <h1>Welcome to NIPER</h1>
                    <p>Kese ho dosto:</p>
                    <p>Thank you for choosing us!</p>
                </body>
                </html>
            ');
    
            // Send the email
            if ($email->send()) {
                echo "Email with logo successfully sent!";
            } else {
                echo "Failed to send email. Debug: " . $email->printDebugger(['headers']);
            }
        }

    }
?>