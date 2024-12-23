<?php

namespace App\Controllers;

use App\Models\Employee_model;
use App\Models\AttendanceModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AttendanceController extends BaseController
{
    public function index()
{
    // Get all attendance records from session, if any
    $allAttendanceRecords =  session()->get('allAttendanceRecords');

    if (!$allAttendanceRecords) {
        $data['attendance'] = [];
    } else {
        $data['attendance'] = $allAttendanceRecords;
    }
    session_destroy();
    return view('admin/attendance', $data);
}

public function upload()
{
    $file = $this->request->getFile('excelFile');

    if ($file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $newName);
        $filePath = WRITEPATH . 'uploads/' . $newName;

        try {
            // Load the spreadsheet
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit();

            // Validate headers
            $expectedHeaders = ['Employee Code', 'A. InTime', 'A.OutTime', 'W. Duration'];

            $headers = $data[11];
            // if ($headers !== $expectedHeaders) {
            //     unlink($filePath);
            //     return redirect()->to('admin/attendance')->with('error', 'Invalid file structure. Headers must be: ' . implode(', ', $expectedHeaders));
            // }
               
            // Remove the header row
            array_shift($data);

            $attendanceModel = new AttendanceModel();
            $invalidRows = [];
            $newRecords = [];
            $att_date= date('Y-m-d', strtotime($data[8][5]));
            foreach ($data as $index => $row) {
                if (
                    is_numeric($row[3]) && 
                    strtotime($row[8]) && strtotime($row[9]) && 
                    !empty($row[12]) && 
                    date('Y-m-d', strtotime($att_date)) 
                ) {

                    $existing = $attendanceModel->where('employee_id', $row[3])
                        ->where('Date', $att_date)
                        ->first();

                    if ($existing) {
                        // Update existing record
                        $attendanceModel->update($existing['id'], [
                            'check_in'  => $row[8],  
                            'check_out' => $row[9],  
                            'duration'  => $row[12],  
                        ]);
                    } else {
                        // Insert new record
                        $attendanceModel->insert_attendance([
                            'employee_id' => (int)$row[3],
                            'check_in'    => $row[8],  
                            'check_out'   => $row[9], 
                            'duration'    => $row[12],  
                            'Date'        => $att_date,  
                        ]);
                    }

                    // Add the new or updated record to the array
                    $newRecords[] = [
                        'employee_id' => (int)$row[3],
                        'check_in'    => $row[8], 
                        'check_out'   => $row[9], 
                        'duration'    => $row[12],  
                        'Date'        => $att_date,  
                    ];
                } else {
                    $invalidRows[] = $index + 2;
                }
            }

            // Combine old records with new records (if any) from session
            $existingRecords = session()->get('allAttendanceRecords') ?? [];
            $allAttendanceRecords = array_merge($existingRecords, $newRecords);

            // Store all attendance records in session
            session()->set('allAttendanceRecords', $allAttendanceRecords);

            // Prepare success message
            $message = 'Attendance records uploaded successfully.';
            if ($invalidRows) {
                $message .= ' Skipped rows: ' . implode(', ', $invalidRows);
            }

            return redirect()->to('admin/attendance')->with('success', $message);

        } catch (\Exception $e) {
            log_message('error', 'Exception during upload: ' . $e->getMessage());
            return redirect()->to('admin/attendance')->with('error', 'An error occurred during file upload. Please try again.');
        }
    }

    return redirect()->to('admin/attendance')->with('error', 'Failed to upload file. Please ensure the file is valid and try again.');
}

}
