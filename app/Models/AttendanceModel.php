<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table      = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'check_in','check_out','duration','Date'];

   public function get_all_attendance()
{
    return $this->db->table('attendance')->get()->getResult(); 
}


    public function insert_attendance($data)
    {
        return $this->insert($data);
    }

    public function get_attendance_by_employee_and_date($employee_id, $date)
    {
        return $this->where('employee_id', $employee_id)->where('Date', $date)->first();
    }

}
