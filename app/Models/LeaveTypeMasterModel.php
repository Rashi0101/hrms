<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveTypeMasterModel extends Model
{
    protected $table            = 'leavetypemasters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['type'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'type' => 'required|min_length[3]|max_length[50]|is_unique[leavetypemasters.type]',
    ];
    protected $validationMessages   = [
        'type' => [
            'required'      => 'The leave type is required.',
            'min_length'    => 'The leave type must be at least 3 characters long.',
            'max_length'    => 'The leave type cannot exceed 50 characters.',
            'is_unique'     => 'The leave type must be unique.',
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

    // Method to create a new leave type
    public function createLeaveType($data)
    {
        if ($this->validate($data)) {
            return $this->insert($data);
        }
        return false; // Validation failed
    }

    // Method to delete a leave type
    public function deleteLeaveType($id)
    {
        return $this->delete($id);
    }

    // Method to update an existing leave type
    public function updateLeaveType($id, $data)
    {
        if ($this->validate($data)) {
            return $this->update($id, $data);
        }
        return false; // Validation failed
    }
}

