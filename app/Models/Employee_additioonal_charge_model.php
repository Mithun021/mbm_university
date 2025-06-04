<?php
    namespace App\Models;

    use CodeIgniter\Model;
    
    class Employee_additioonal_charge_model extends Model
    {
        protected $table = 'employee_additional_charge';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id', 'designation_id', 'upload_by'];
    
        public function updateEmployeeDesignations(int $employeeId, array $designations)
        {
            $db = \Config\Database::connect();
            $builder = $db->table($this->table);
            $sessionData = session()->get('loggedUserData');
            if ($sessionData) {
                $loggeduserId = $sessionData['loggeduserId']; 
            }
    
            // Fetch existing designations for the employee
            $existing = $builder->where('employee_id', $employeeId)->get()->getResultArray();
            $existingIds = array_column($existing, 'designation_id');
    
            // Determine new designations to insert
            $toInsert = array_diff($designations, $existingIds);
    
            // Determine designations to delete
            $toDelete = array_diff($existingIds, $designations);
    
            // Insert new designations
            if (!empty($toInsert)) {
                $insertData = [];
                foreach ($toInsert as $designationId) {
                    $insertData[] = [
                        'employee_id' => $employeeId,
                        'designation_id' => $designationId,
                        'upload_by' => $loggeduserId,
                    ];
                }
                $builder->insertBatch($insertData);
            }
    
            // Delete unchecked designations
            if (!empty($toDelete)) {
                $builder->where('employee_id', $employeeId)
                    ->whereIn('designation_id', $toDelete)
                    ->delete();
            }
    
            return true;
        }

    }
    
?>