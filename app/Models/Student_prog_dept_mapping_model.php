<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_prog_dept_mapping_model extends Model
    {
        protected $table         = 'student_prog_dept_mapping';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_id','department_id','program_id','semester','upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }
        }

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->orderBy('name','asc')->findAll();
            }
            return $result;
        }

        // public function getStudentProgramDeptData(){
        //     $builder = $this->db->table('student_prog_dept_mapping');
        //     $builder->select('
        //         student_prog_dept_mapping.id as student_mapping_id,
        //         student_prog_dept_mapping.student_id,
        //         student_prog_dept_mapping.department_id,
        //         student_prog_dept_mapping.program_id,
        //         student_prog_dept_mapping.semester,
        //         student_prog_dept_mapping.upload_by,
        //         student_prog_dept_mapping.created_at,
        //         IFNULL(students.first_name, "____") as first_name,
        //         IFNULL(students.middle_name, "____") as middle_name,
        //         IFNULL(students.last_name, "____") as last_name,
        //         IFNULL(department.name, "____") as department_name,
        //         IFNULL(program_category.name, "____") as program_name
        //     ');
            
        //     // Perform the LEFT JOINs with the other tables
        //     $builder->join('students', 'student_prog_dept_mapping.student_id = students.id', 'left');
        //     $builder->join('department', 'student_prog_dept_mapping.department_id = department.id', 'left');
        //     $builder->join('program_category', 'student_prog_dept_mapping.program_id = program_category.id', 'left');
            
        //     $builder->orderBy('student_prog_dept_mapping.department_id', 'ASC');
        //     $builder->orderBy('student_prog_dept_mapping.program_id', 'ASC');
        //     $builder->orderBy('student_prog_dept_mapping.student_id', 'ASC');

        //     // Execute and get the result
        //     $query = $builder->get();
        //     return $query->getResultArray();
        // }

        public function getStudentProgramDeptData($student_id = null){
            $builder = $this->db->table('student_prog_dept_mapping');
            $builder->select('
                student_prog_dept_mapping.id as student_mapping_id,
                student_prog_dept_mapping.student_id,
                student_prog_dept_mapping.department_id,
                student_prog_dept_mapping.program_id,
                student_prog_dept_mapping.semester,
                student_prog_dept_mapping.upload_by,
                student_prog_dept_mapping.created_at,
                IFNULL(students.first_name, "____") as first_name,
                IFNULL(students.middle_name, "____") as middle_name,
                IFNULL(students.last_name, "____") as last_name,
                IFNULL(department.name, "____") as department_name,
                IFNULL(program_category.name, "____") as program_name
            ');
        
            // Join related tables
            $builder->join('students', 'student_prog_dept_mapping.student_id = students.id', 'left');
            $builder->join('department', 'student_prog_dept_mapping.department_id = department.id', 'left');
            $builder->join('program_category', 'student_prog_dept_mapping.program_id = program_category.id', 'left');
        
            // Optional filtering
            if (!empty($student_id)) {
                $builder->where('student_prog_dept_mapping.student_id', $student_id);
            }
        
            // Ordering
            $builder->orderBy('student_prog_dept_mapping.department_id', 'ASC');
            $builder->orderBy('student_prog_dept_mapping.program_id', 'ASC');
            $builder->orderBy('student_prog_dept_mapping.student_id', 'ASC');
        
            // Execute query
            $query = $builder->get();
        
            // Return single record if filtering by student_id, else return all
            if (!empty($student_id)) {
                return $query->getRowArray(); // one record (associative array)
            } else {
                return $query->getResultArray(); // all records (array of arrays)
            }
        }
        

    }
?>