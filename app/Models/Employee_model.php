<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee_model extends Model
{
    // Define the table name
    protected $table      = 'employees';

    // Define the primary key
    protected $primaryKey = 'id';

    // Define which fields can be inserted/updated
    protected $allowedFields = [
        'name', 
        'email', 
        'phone', 
        'dob', 
        'gender', 
        'address', 
        'department', 
        'designation', 
        'hire_date', 
        'salary', 
        'status',
        'role',
        'profile_picture'
    ];

    protected $returnType = 'array';

    public function get_all_employees()
    {
        return $this->findAll();
    }

    public function search_employees($search_term)
    {
        return $this->like('employee_id', $search_term)->findAll();
    }
}
