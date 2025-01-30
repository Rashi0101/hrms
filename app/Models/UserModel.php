<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
<<<<<<< HEAD
    protected $table            = 'users';
    protected $primaryKey       = 'emp_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id','username', 'password', 'role','status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'password' => 'required|min_length[6]',
        'role'     => 'required|in_list[admin,user]',
        'status' => 'required|in_list[active,inactive]',
        // 'emp_id' => 'required|is_unique[employees.emp_id]',
    ];
    protected $validationMessages   = [
        'username' => [
            'required'   => 'The username is required.',
            'min_length' => 'The username must be at least 3 characters long.',
            'max_length' => 'The username cannot exceed 50 characters.',
            'is_unique'  => 'The username must be unique.',

        ],
        'password' => [
            'required'   => 'The password is required.',
            'min_length' => 'The password must be at least 6 characters long.',
        ],
        'role' => [
            'required' => 'The role is required.',
            'in_list'  => 'The role must be one of the following: admin, user.',
        ],
        'status' => [
            'required'=>  'The Employee Status is required', 
            'in_list'=> 'The Employee Status Should be active or inactive',
        ],
        
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Method to find a user by their username
    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    // Method to create a new user (with validation)
    public function createUser($data)
    {
        if ($this->validate($data)) {
            return $this->insert($data);
        }
        return false; // Validation failed
    }

    // Method to update an existing user (with validation)
    public function updateUser($id, $data)
    {
        if ($this->validate($data)) {
            return $this->update($id, $data);
        }
        return false; // Validation failed
    }

    public function saveUserData($data)
    {
        return $this->insert($data);
    }

    // Method to find a user by emp_id
    public function getUserByEmpId($emp_id)
    {
        return $this->where('emp_id', $emp_id)->first();
    }
}
=======
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password','role'];
    protected $useTimestamps = true;
    protected $returnType = 'array'; 
}

>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
