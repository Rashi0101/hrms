<?php

namespace App\Models;

use CodeIgniter\Model;

class HolidayModel extends Model
{
<<<<<<< HEAD
    protected $table            = 'holidays';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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
=======
    protected $table = 'holidays'; // The name of the table in the database
    protected $primaryKey = 'id';  // The primary key
    protected $allowedFields = ['holiday_name', 'holiday_date', 'holiday_day']; // Fields that can be inserted/updated
    protected $useTimestamps = true; // Set this to true if you are using created_at and updated_at columns
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
}
