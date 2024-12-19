<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveModel extends Model
{
    protected $table = 'leaves';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'leave_type', 'start_date','end_date','reason', 'status'];
}
