<?php

namespace App\Controllers\student;

use App\Controllers\BaseController;
use App\Models\Student_model;

class AuthController extends BaseController
{
    public function login()
    {
        $student_model = new Student_model();
        $data = ['title' => 'Student Login'];
        if ($this->request->is('get')) {
            return view('student/login', $data);
        } else if ($this->request->is('post')) {
            $userId = $this->request->getPost('userId');
            $userPassword = $this->request->getVar('userPassword');

            $data = $student_model->where('enrollment_no', $userId)->first();
            if ($data) {
                session()->remove(['loggedstudentName','loggedstudentId', 'studentLoginned']);
                $session_data = [
                    'loggedstudentName' => $data['first_name'],
                    'loggedstudentId' => $data['id']
                ];
                if (password_verify($userPassword, $data['password'])) {
                    $this->session->set('loggedStudentData', $session_data);
                    $this->session->set('studentLoginned', "studentLoginned");
                    echo "dataMatch";
                } else {
                    echo 'User ID or Password Mismatch';
                }
            } else {
                echo "Given Userid not found";
            }
        }
        
    }

    public function forget_password()
    {
        $student_model = new Student_model();
        $data = ['title' => 'Forget Password'];

        if ($this->request->is('get')) {
            return view('student/forget-password', $data);
        }

        if ($this->request->is('post')) {
            $student_id = $this->request->getPost('student_id');
            $student = $student_model->where('personal_mail', $student_id)
                                    ->orWhere('enrollment_no', $student_id)
                                    ->first();

            if ($student) {
                $email = $student['personal_mail'];
                helper('text');
                $token = random_string('alnum', 64);
                $expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));

                // Save token and expiry to DB
                $student_model->update($student['id'], [
                    'reset_token' => $token,
                    'reset_token_expiry' => $expiry
                ]);

                // Send Email
                $reset_link = base_url("reset-password/$token");

                $email_service = \Config\Services::email();
                $email_service->setTo($email);
                $email_service->setFrom('noreply@hptuexam.com', 'NIPER Raebareli');
                $email_service->setSubject('Password Reset Request');
                $email_service->setMessage("
                    <p>Dear {$student['first_name']},</p>
                    <p>You requested a password reset. Click the link below to reset your password. This link will expire in 10 minutes.</p>
                    <p><a href='{$reset_link}'>{$reset_link}</a></p>
                    <p>If you did not request this, please ignore this email.</p>
                    <br>
                    <p>Regards,<br>NIPER Team</p>
                ");

                if ($email_service->send()) {
                    return redirect()->back()->with('status',
                        '<div class="alert alert-success" role="alert">Reset link sent successfully to your email.</div>');
                } else {
                    return redirect()->back()->with('status',
                        '<div class="alert alert-danger" role="alert">Failed to send email. Please try again later.</div>');
                }
            }

            return redirect()->back()->with('status',
                '<div class="alert alert-danger" role="alert">Email or Enrollment Number not found.</div>');
        }

        return redirect()->back()->with('status',
            '<div class="alert alert-danger" role="alert">Invalid request.</div>');
    }


    public function reset_password($id){
        $student_model = new Student_model();
        $data = ['title' => 'Reset Password', 'token' => $id];

        if ($this->request->is('get')) {
            return view('student/reset-password', $data);
        }

        if ($this->request->is('post')) {
            $password = $this->request->getPost('new_password');
            $user = $student_model->where('reset_token', $id)->first();

            if ($user && strtotime($user['reset_token_expiry']) > time()) {
                // Update password
                $student_model->update($user['id'], [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'reset_token' => null,
                    'reset_token_expiry' => null
                ]);

                // Send confirmation email
                $email_service = \Config\Services::email();
                $email_service->setTo($user['personal_mail']);
                $email_service->setFrom('noreply@hptuexam.com', 'NIPER Raebareli');
                $email_service->setSubject('Password Changed Successfully');
                $email_service->setMessage("
                    <p>Dear {$user['first_name']},</p>
                    <p>Your password has been successfully changed.</p>
                    <p>If you did not perform this action, please contact support immediately.</p>
                    <br>
                    <p>Regards,<br>NIPER Team</p>
                ");

                // Attempt to send email
                if ($email_service->send()) {
                    return redirect()->to('stdlogin')->with('status', 
                        '<div class="alert alert-success" role="alert">Password updated and confirmation email sent.</div>');
                } else {
                    return redirect()->to('stdlogin')->with('status', 
                        '<div class="alert alert-warning" role="alert">Password updated, but failed to send confirmation email.</div>');
                }
            }

            return redirect()->to('forgot-password')->with('status', 
                '<div class="alert alert-danger" role="alert">Token expired or invalid.</div>');
        }
    }


    public function logout(){
        $session = session();
        session_unset();
        session_destroy();
        return redirect()->to(base_url('stdlogin'));    
    }
}
