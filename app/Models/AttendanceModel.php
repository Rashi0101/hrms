<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table      = 'attendance';
    protected $primaryKey = 'id';
<<<<<<< HEAD
<<<<<<< HEAD
    protected $allowedFields = ['emp_id', 'check_in','check_out','duration','Date'];

    public function get_all_attendance()
    {
        // return $this->db->table('attendance')->get()->getResult();
        return $this->findAll();
    }
=======
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
    protected $allowedFields = ['employee_id', 'check_in','check_out','duration','Date'];

   public function get_all_attendance()
{
    return $this->db->table('attendance')->get()->getResult(); 
}

<<<<<<< HEAD
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    public function insert_attendance($data)
    {
        return $this->insert($data);
    }

<<<<<<< HEAD
<<<<<<< HEAD
    public function get_attendance_by_employee_and_date($emp_id, $date)
    {
        return $this->where('emp_id', $emp_id)->where('Date', $date)->first();
    }

    public function getMonthlyAttendance(int $emp_id, string $month): int
    {
        return $this->where('emp_id', $emp_id)
                    ->like('date', $month, 'after') 
                    ->selectSum('duration') 
                    ->get()
                    ->getRow()
                    ->duration ?? 0;
    }

    public function getAttendanceByEmployeeAndMonth($emp_id, $month)
    {
        return $this->where('emp_id', $emp_id)
                    ->like('Date', $month)
                    ->findAll();
    }

     public function upload_attendance_from_excel($data)
    {
        $invalidRows = [];
        $newRecords = [];
        $att_date = date('Y-m-d', strtotime($data[9][5]));
      
        foreach ($data as $index => $row) {
            if (
                is_numeric($row[3]) && 
                strtotime($row[8]) && strtotime($row[9]) && 
                !empty($row[12]) && 
                date('Y-m-d', strtotime($att_date)) 
            ) {
               
                $existing = $this->where('emp_id', $row[3])
                    ->where('Date', $att_date)
                    ->first();

                    


                if ($existing) {
                    // Update existing record
                    $this->update($existing['id'], [
                        'check_in'  => $row[8],  
                        'check_out' => $row[9],  
                        'duration'  => $row[12],  
                    ]);
                } else {
                    
                    // // Insert new record
                    // try {
                    //     $check_in = new \DateTime($att_date . ' ' . $row[8] ); 
                    //     $checktime_in = $check_in->getTimestamp(); 

                    //     $check_out = new \DateTime($att_date . ' ' . $row[9] ); 
                    //     $checktime_out = $check_out->getTimestamp(); 
                    // } catch (\Exception $e) {
                    //     echo 'Error creating DateTime object: ' . $e->getMessage();
                    //     exit();
                    // }
                    $data = [
                        'emp_id'    => (int)$row[3],  
                        'check_in'  => $row[8],  
                        'check_out' => $row[9], 
                        'duration'  => $row[12], 
                        'Date'      => $att_date, 
                    ];
                    // print_r($data);
                    $this->insert_attendance($data);

                }

                $newRecords[] = [
                    'emp_id'    => (int)$row[3],
                    'check_in'  => $row[8], 
                    'check_out' => $row[9], 
                    'duration'  => $row[12],  
                    'Date'      => $att_date,  
                ];
            } else {
                $invalidRows[] = $index + 2; 

            }
        }

        return ['newRecords' => $newRecords, 'invalidRows' => $invalidRows];
    }
=======
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
    public function get_attendance_by_employee_and_date($employee_id, $date)
    {
        return $this->where('employee_id', $employee_id)->where('Date', $date)->first();
    }

<<<<<<< HEAD
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
}
