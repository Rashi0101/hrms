<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamMasterModel extends Model
{
    protected $table            = 'teammasters';
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
        'name' => 'required|min_length[3]|max_length[100]|is_unique[teammasters.name]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required'   => 'The team name is required.',
            'min_length' => 'The team name must be at least 3 characters long.',
            'max_length' => 'The team name cannot exceed 100 characters.',
            'is_unique'  => 'The team name must be unique.',
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

    // Method to create a new team (with validation)
    public function createTeam($data)
    {
        if ($this->validate($data)) {
            return $this->insert($data);
        }
        return false; // Validation failed
    }

    // Method to update an existing team (with validation)
    public function updateTeam($id, $data)
    {
        if ($this->validate($data)) {
            return $this->update($id, $data);
        }
        return false; // Validation failed
    }

    // Method to get a team by name
    public function findByName($name)
    {
        return $this->where('name', $name)->first();
    }
}

