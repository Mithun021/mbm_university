<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class UserModel extends Model
    {
        protected $table         = 'users';
        protected $primaryKey = 'userId';
        protected $allowedFields = [
            'firstName',
            'lastName',
            'phoneNumber',
            'city',
            'state',
            'email',
            'password',
            'authority',
            'registed_date',
            'status'
        ];
        
    }
?>