<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveModel extends Model
{
<<<<<<< HEAD
    protected $table            = 'leaves';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id','leave_id','start_date','end_date','no_of_days','remarks','status'];

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
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function getLeavesDetails(){
    return $this->select('leaves.*, employees.name as emp_name, leavetypemasters.type as leave_type, leavesmasters.avaliable_leaves as leave_left')
    ->join('employees','employees.emp_id = leaves.emp_id','left')
    ->join('leavetypemasters','leavetypemasters.id = leaves.leave_id','left')
    ->join('leavesmasters','leavesmasters.emp_id = leaves.emp_id','left')
    ->findAll();
}
public function add($leaveData)
    {
        return $this->insert($leaveData);  
    }
=======
    protected $table = 'leaves';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'leave_type', 'start_date','end_date','reason', 'status'];
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
}
