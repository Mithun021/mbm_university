<?php
    namespace App\Controllers;

use App\Models\Department_model;
use App\Models\Designation_model;
use App\Models\Employee_model;
use App\Models\Program_model;
use App\Models\Student_model;
use App\Models\Student_prog_dept_mapping_model;
use App\Models\UserModel;

    
    class StudentController extends BaseController{
        public function students(){
            $student_model = new Student_model();
            $data = ['title' => 'Students'];
            if ($this->request->is("get")) {
                $data['students'] = $student_model->get();
                return view('admin/student/students',$data);
            }else if ($this->request->is("post")) {
                // Prepare data for insertion
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $std_profile_image = $this->request->getFile('std_profile_image');
                if ($std_profile_image->isValid() && ! $std_profile_image->hasMoved()) {
                    $studentFileName = $std_profile_image->getRandomName();
                    $std_profile_image->move(ROOTPATH . 'public/admin/uploads/students', $studentFileName);    
                }
                $data = [
                    'first_name' => $this->request->getPost('std_first_name'),
                    'middle_name' => $this->request->getPost('std_middle_name'),
                    'last_name' => $this->request->getPost('std_last_name'),
                    'enrollment_no' => $this->request->getPost('Stdenrollid'),
                    'father_name' => $this->request->getPost('std_father_name'),
                    'mother_name' => $this->request->getPost('std_mother_name'),
                    'date_of_birth' => $this->request->getPost('std_date_of_birth'),
                    'blood_group' => $this->request->getPost('std_blood_group'),
                    'personal_mail' => $this->request->getPost('std_personal_mail'),
                    'official_mail' => $this->request->getPost('std_official_mail'),
                    'phone_no' => $this->request->getPost('Stdphone'),
                    'gender' => $this->request->getPost('gender'),
                    'permanent_address' => $this->request->getPost('std_permanent_address'),
                    'correspondence_address' => $this->request->getPost('std_corrospondence_address'),
                    'profile_image' => $studentFileName ?? '',
                    'upload_by' => $loggeduserId ?? ''
                ];

                // Save the data
                $result = $student_model->add($data);
                if ($result === true) {
                    return redirect()->to('admin/students')->with('status', '<div class="alert alert-success" role="alert">Student added successfully.</div>');
                } else {
                    return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
                }
            }
        }

        public function export_student(){
            $student_model = new Student_model();
            // echo "ok";
            // CSV Header
            $csvData = "first_name,middle_name,last_name,enrollment_no,father_name,mother_name,date_of_birth,blood_group,personal_mail,official_mail,phone_no,gender,permanent_address,correspondence_address\n";

            // Sample data - this should be dynamically retrieved from the database or an input source
            $csvData .= implode(",", [
                'John',             // first_name
                'A',                // middle_name
                'Doe',              // last_name
                '123456',           // enrollment_no
                'Richard Doe',      // father_name
                'Jane Doe',         // mother_name
                '2000-01-01',       // date_of_birth
                'O+',               // blood_group
                'john.doe@example.com',  // personal_mail
                'john.doe@school.com',   // official_mail
                '9876543210',       // phone_no
                'Male',             // gender
                '123 Main St City', // permanent_address
                '456 Elm St City'   // correspondence_address
            ]) . "\n";

            $this->generateCSV($csvData, 'student_import_sample.csv');
        
        }
        private function generateCSV($csvData, $fileName){
            $response = $this->response->setContentType('text/csv')
                                        ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                                        ->setBody($csvData)
                                        ->send();
                return $response;
        }

        public function upload_student_csv(){
            $student_model = new Student_model();
            $file = $this->request->getFile('csv_file');
            $sessionData = session()->get('loggedUserData');
        
            // Check if user is logged in
            if (!$sessionData) {
                return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Session expired. Please log in again.</div>');
            }
        
            $loggedUserId = $sessionData['loggeduserId']; 
        
            // Check if a file is uploaded and is valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileContent = $file->getTempName();
        
                // Open the CSV file for reading
                if (($handle = fopen($fileContent, 'r')) !== false) {
                    $csvData = [];
                    $header = fgetcsv($handle, 1000, ","); // Get the header (first row)
        
                    if (!$header) {
                        return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">The CSV file is empty or not in the correct format.</div>');
                    }
        
                    $successCount = 0;  // To keep track of successful uploads
                    $skippedCount = 0;  // To keep track of skipped rows due to errors
        
                    // Loop through each row in the CSV
                    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                        // Ensure row has the correct number of columns
                        if (count($row) !== count($header)) {
                            $skippedCount++;
                            continue; // Skip row if it doesn't match header length
                        }
        
                        $data = array_combine($header, $row);
        
                        // Skip row if mandatory fields are missing (first name or enrollment number)
                        if (empty($data['first_name']) || empty($data['enrollment_no'])) {
                            $skippedCount++;
                            continue; 
                        }
        
                        // Handle date format if necessary (convert to Y-m-d)
                        $dateOfBirth = !empty($data['date_of_birth']) ? date('Y-m-d', strtotime($data['date_of_birth'])) : null;
        
                        $studentData = [
                            'first_name'        => $data['first_name'],
                            'middle_name'       => $data['middle_name'] ?? '',
                            'last_name'         => $data['last_name'] ?? '',
                            'enrollment_no'     => $data['enrollment_no'],
                            'father_name'       => $data['father_name'] ?? '',
                            'mother_name'       => $data['mother_name'] ?? '',
                            'date_of_birth'     => $dateOfBirth,
                            'blood_group'       => $data['blood_group'] ?? '',
                            'personal_mail'     => $data['personal_mail'] ?? '',
                            'official_mail'     => $data['official_mail'] ?? '',
                            'phone_no'          => $data['phone_no'] ?? '',
                            'gender'            => $data['gender'] ?? '',
                            'permanent_address' => $data['permanent_address'] ?? '',
                            'correspondence_address' => $data['correspondence_address'] ?? '',
                            'upload_by'         => $loggedUserId,
                        ];
        
                        // Insert the data into the database
                        try {
                            // echo "<pre>"; print_r($studentData);
                            $student_model->insert($studentData);
                            $successCount++;  // Increment on successful insert
                        } catch (\Exception $e) {
                            // Log the error and skip the record
                            log_message('error', 'Error inserting student: ' . $e->getMessage());
                            $skippedCount++;
                            continue;
                        }
                    }
        
                    fclose($handle);
        
                    // Return success message with the total number of records uploaded and skipped
                    return redirect()->back()->with('status', '<div class="alert alert-success" role="alert">Data uploaded and saved successfully! Total records uploaded: ' . $successCount . '. Skipped rows due to errors: ' . $skippedCount . '.</div>');
        
                } else {
                    // Return error message if the file could not be opened
                    return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Failed to process the CSV file. Please ensure the file is valid and try again.</div>');
                }
        
            } else {
                // Return error message if no valid file is uploaded
                return redirect()->back()->with('status', '<div class="alert alert-danger" role="alert">Please upload a valid CSV file.</div>');
            }
        }
        




        public function program_dept_std_mapping(){
            $department_model = new Department_model();
            $program_model = new Program_model();
            $student_model = new Student_model();
            $student_prog_dept_mapping_model = new Student_prog_dept_mapping_model();
            $data = ['title' => 'Program Dept. Std. Mapping'];
            if ($this->request->is("get")) {
                $data['department'] = $department_model->activeData();
                $data['program'] = $program_model->activeData();
                $data['students'] = $student_model->getUnmappedStudents();
                $data['students_mapped_data'] = $student_prog_dept_mapping_model->getStudentProgramDeptData();
                // echo "<pre>"; print_r($data['students_mapped_data']); die;
                return view('admin/student/program-dept-std-mapping',$data);
            }else if ($this->request->is("post")) {
                $sessionData = session()->get('loggedUserData');
                if ($sessionData) {
                    $loggeduserId = $sessionData['loggeduserId']; 
                }
                $student_id = $this->request->getPost('student_id');
                if (empty($student_id)) {
                    return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">Please select at least one student.</div>');
                }
                $num = 0;
                foreach ($student_id as $value) {
                    $data = [
                        'student_id' => $value,
                        'department_id' => $this->request->getPost('Deptid'),
                        'program_id' => $this->request->getPost('Progid'),
                        'semester' => $this->request->getPost('semester'),
                        'upload_by' => $loggeduserId
                    ];
                    $num++;
                    $result = $student_prog_dept_mapping_model->add($data);
                //    echo "<pre>"; print_r($data);
                }
                // die;
                if ($result) {
                    return redirect()->back()->with('status', '<div class="alert alert-success" role="alert">'.$num.' Student mapped successfully.</div>');
                } else {
                    return redirect()->back()->withInput()->with('status', '<div class="alert alert-danger" role="alert">'.$result.'</div>');
                }
            }
        }
    }
?>