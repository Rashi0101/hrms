<?php

namespace App\Models;

use CodeIgniter\Model;

class HolidayModel extends Model
{
    protected $table = 'holidays'; // The name of the table in the database
    protected $primaryKey = 'id';  // The primary key
    protected $allowedFields = ['holiday_name', 'holiday_date', 'holiday_day']; // Fields that can be inserted/updated
    protected $useTimestamps = true; // Set this to true if you are using created_at and updated_at columns
}
