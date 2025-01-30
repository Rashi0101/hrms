<?php

namespace App\Controllers;

use App\Models\HolidayModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use CodeIgniter\Controller;

class HolidayController extends BaseController
{
    public function index()
    {
        // Get all holiday records from session, if any
        $allHolidayRecords = session()->get('allHolidayRecords');

        if (!$allHolidayRecords) {
            $data['holidays'] = [];
        } else {
            $data['holidays'] = $allHolidayRecords;
        }

        // Clear session data after display
        //session()->remove('allHolidayRecords');

        // Return the view with holidays data
        return view('admin/holiday', $data);
    }

    public function upload()
    {
        // Validate the file upload
        $file = $this->request->getFile('excelFile');
        if ($file->isValid() && !$file->hasMoved()) {
            // Create a random name and move the file to the upload folder
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            try {
                // Load the spreadsheet
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray(); // Convert to array

                // Skip header row
                array_shift($data);

                // Process the data and insert it into the database
                $holidayModel = new HolidayModel();
                $invalidRows = [];
                $newRecords = [];

                foreach ($data as $index => $row) {
                    // Make sure all necessary columns are provided (Holiday Name, Date, Day)
                    if (!empty($row[0]) && !empty($row[1]) && !empty($row[2])) {
                        // Get holiday name, date, and day
                        $holiday_name = $row[0];
                        $holiday_date = $row[1];
                        $holiday_day = date('l', strtotime($holiday_date)); // Get the day of the week

                        // Insert into the database
                        $holidayModel->insert([
                            'holiday_name' => $holiday_name,
                            'holiday_date' => $holiday_date,
                            'holiday_day'  => $holiday_day,
                        ]);

                        // Add the record to newRecords array for session
                        $newRecords[] = [
                            'holiday_name' => $holiday_name,
                            'holiday_date' => $holiday_date,
                            'holiday_day'  => $holiday_day,
                        ];
                    } else {
                        // Mark invalid rows for skipping
                        $invalidRows[] = $index + 2; // Add 2 because array_shift removed the header
                    }
                }

                // Combine old records with new records (if any) from session
                $existingRecords = session()->get('allHolidayRecords') ?? [];
                $allHolidayRecords = array_merge($existingRecords, $newRecords);

                // Store all holiday records in session
                session()->set('allHolidayRecords', $allHolidayRecords);

                // Success message
                $message = 'Holidays uploaded successfully.';
                if ($invalidRows) {
                    $message .= ' Skipped rows: ' . implode(', ', $invalidRows);
                }

                return redirect()->to('admin/holiday')->with('success', $message);

            } catch (\Exception $e) {
                log_message('error', 'Error uploading holiday file: ' . $e->getMessage());
                return redirect()->to('admin/holiday')->with('error', 'An error occurred while uploading the file.');
            }
        } else {
            return redirect()->to('admin/holiday')->with('error', 'Invalid file upload.');
        }
    }
}
