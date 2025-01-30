<?php

namespace App\Models;

use CodeIgniter\Model;

class TimesheetModel extends Model
{
    protected $table            = 'timesheets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id', 'date', 'task', 'timeline', 'status', 'assgined_by', 'ip_address'];

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
        'emp_id'        => 'required|integer',
        'date'          => 'required|valid_date',
        'task'          => 'required|max_length[255]',
        'timeline'      => 'required|valid_time',  // Assuming you want a time format, e.g. 'HH:mm'
        'status'        => 'required|in_list[Pending,In Progress,Completed]',
        'assgined_by'   => 'required|integer',
        'ip_address'    => 'required|valid_ip',
    ];
    protected $validationMessages   = [
        'emp_id' => [
            'required' => 'The employee ID is required.',
            'integer'  => 'The employee ID must be an integer.',
        ],
        'date' => [
            'required' => 'The date is required.',
            'valid_date' => 'The date format is invalid.',
        ],
        'task' => [
            'required' => 'The task is required.',
            'max_length' => 'The task cannot exceed 255 characters.',
        ],
        'timeline' => [
            'required' => 'The timeline is required.',
            'valid_time' => 'The timeline format is invalid.',
        ],
        'status' => [
            'required' => 'The status is required.',
            'in_list'  => 'The status must be one of the following: Pending, In Progress, Completed.',
        ],
        'assgined_by' => [
            'required' => 'The assigned by field is required.',
            'integer'  => 'The assigned by ID must be an integer.',
        ],
        'ip_address' => [
            'required' => 'The IP address is required.',
            'valid_ip' => 'The IP address format is invalid.',
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

    // Method to get complete timeline data
    public function getCompleteTimeline()
    {
        return $this->select('timesheets.*,employees.name as emp_name,manager.name as manager_name')
            ->join('employees', 'employees.emp_id = timesheets.emp_id', 'left')
            ->join('employees as manager', 'manager.emp_id = timesheets.assgined_by', 'left')
            ->findAll();
    }
}

}
