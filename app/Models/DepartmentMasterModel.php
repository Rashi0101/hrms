<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentMasterModel extends Model
{
    protected $table            = 'departmentmasters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

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
        'name' => 'required|min_length[3]|max_length[100]|is_unique[departmentmasters.name]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required'      => 'The department name is required.',
            'min_length'    => 'The department name must be at least 3 characters long.',
            'max_length'    => 'The department name cannot exceed 100 characters.',
            'is_unique'     => 'The department name must be unique.',
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

    public function createDepartment($data)
    {
        if ($this->validate($data)) {
            return $this->insert($data);
        }
        return false; // Validation failed
    }

    public function deleteDepartment($id)
    {
        return $this->delete($id);
    }

    public function updateDepartment($id, $data)
    {
        if ($this->validate($data)) {
            return $this->update($id, $data);
        }
        return false; // Validation failed
    }
}

