<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\EmployeeModel;
use App\Models\LeaveModel;
use App\Models\AttendanceModel;

class CoreController extends BaseController
{
    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->employeeModel = new EmployeeModel();
    }
   

    public function index()
    {
        //
    }

public function authenticate()
{
    $model = new UserModel();         // Your users table model
    $employeeModel = new EmployeeModel();  

    // Get email and password from the form
    $submittedEmail = $this->request->getPost('username');
    $submittedPassword = $this->request->getPost('password');

    // Find the user by email
    $user = $model->where('username', $submittedEmail)->first();




    if (!$user) {
        session()->setFlashdata('error', 'User not found.');
        return redirect()->back()->withInput();
    }

    // Verify the password
    if (!password_verify($submittedPassword, $user['password'])) {
        session()->setFlashdata('error', 'Incorrect password.');
        return redirect()->back()->withInput();
    }
    if(!$user['emp_id'] == 0){
    // Fetch employee details
    $employee = $employeeModel->where('email', $submittedEmail)->first();
    if (!$employee) {
        session()->setFlashdata('error', 'Employee not found.');
        return redirect()->back()->withInput();
    }

    
    // Set session data
    $session = session();
    $session->set([
        'user_id'        => $user['id'],
        'email'          => $user['username'],
        'name'           => $employee['name'] ?? '',
        'emp_id'         => $employee['emp_id'] ?? '',
        'role'           => $user['role'],
        'department'     => $employee['department'] ?? '',
        'designation'    => $employee['designation'] ?? '',
        'profile_picture'=> $employee['profile_picture'] ?? '',
    ]);

    // Log the user role for debugging (without halting execution)
    // var_dump($session->get('email') );
    // die();
 }
    // Redirect based on the user role
    if (strcasecmp($user['role'], 'admin') === 0) {
        return redirect()->to(base_url('backend/admin/dashboard'))->with('success', 'Login successful as Admin.');
    } elseif (strcasecmp($user['role'], 'user') === 0) {
        return redirect()->to(base_url('backend/applyLeave'))->with('success', 'Login successful as User.');
    }

    // Optionally, handle unexpected role or error
    session()->setFlashdata('error', 'Invalid role or unexpected error.');
    return redirect()->to(base_url('login'));
}


public function admindashboard(){
    return view('admin/dashboard');
}

public function employee_create(){
    return view('admin/employee_create');
}

    public function save_employee()
    {
        $employeeModel = new EmployeeModel();
        $userModel = new UserModel();

    

        // Handle profile picture
        $profilePicture = $this->request->getFile('profile_picture');
        $profilePicturePath = $employeeModel->handleProfilePicture($profilePicture);

        $name = $this->request->getPost('name');
        $dob = $this->request->getPost('dob');
        $email = $this->request->getPost('email');

        // Prepare employee data
        $data = [
            'emp_id' => $this->request->getPost('emp_id'),
            'name' => $name,
            'contact_number' => $this->request->getPost('contact_number'),
            'email' => $email,
            'dob' => $dob,
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'blood_group' => $this->request->getPost('blood_group'),
            'married_status'  => $this->request->getPost('married_status'),
            'eme_number' => $this->request->getPost('eme_number'),
            'eme_name' => $this->request->getPost('eme_name'),
            'eme_relation' => $this->request->getPost('eme_relation'),
            'department_id' => $this->request->getPost('department_id'),
            'designation_id' => $this->request->getPost('designation_id'),
            'reporting_manager' =>$this->request->getPost('reporting_manager'),
            'doj' => $this->request->getPost('doj'),
            'date_rej' => $this->request->getPost('date_rej'),
            'emp_status' => $this->request->getPost('emp_status'),
            'team_id' =>$this->request->getPost('team_id'),
            'profile_picture' => $profilePicturePath,
        ];

        // Save employee data
        if ($employeeModel->saveEmployeeData($data)) {

            // Create user data for login
            $userPassword = $this->request->getPost('name') . $this->request->getPost('dob');
            $userData = [
                'email' => $this->request->getPost('email'),
                'password' => password_hash($userPassword, PASSWORD_DEFAULT),
            ];

            // Save user data
            if ($userModel->saveUserData($userData)) {
                session()->setFlashdata('success', 'Employee and user added successfully!');
                return redirect()->to('backend/admin/employee_create');
            } else {
                session()->setFlashdata('error', 'There was an error saving the user.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'There was an error saving the employee!');
            return redirect()->back()->withInput();
        }
    }

    public function upload_excel()
    {
        $file = $this->request->getFile('excel_file');

        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = WRITEPATH . 'uploads/' . $file->getName();
            $file->move(WRITEPATH . 'uploads');

            // Process the uploaded file
            try {
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

            //          echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit();

                $headers = $data[0];
                array_shift($data);

                $employeeModel = new EmployeeModel();
                $userModel = new UserModel();

                $status = $employeeModel->importEmployeeDataFromExcel($data);

            if ($status['status']) {
                // If success, redirect with a success message
                return redirect()->to('backend/admin/employee_create')->with('message', $status['message']);

            } else {
                // If failure, pass the error message
                return redirect()->back()->with('error', $status['message']);
            }
                // return redirect()->to('backend/admin/employee_create')->with('success', 'Excel data uploaded successfully!');
            } catch (Exception $e) {
                log_message('error', 'Error loading Excel file: ' . $e->getMessage());
                return redirect()->back()->with('errors', 'Error processing the Excel file. Please try again.');
            }
        } else {
            return redirect()->back()->with('errors', 'The uploaded file is invalid or has already been moved.');
        }
    }

public function adminleaves(){
    $session=session();
    $emp_id=$session->get['emp_id'];

    
    return view('admin/adminleaves');
}

public function searchLeave()
{
    // Load the LeaveModel
    $leaveModel = new \App\Models\LeaveModel();

    // Get filters from the request
    $employeeId = $this->request->getGet('emp_id');
    $filterType = $this->request->getGet('filter_type');
    $date = $this->request->getGet('date');
    $status = $this->request->getGet('status');

    // Check if employee_id is empty and show an error message
    if (empty($employeeId)) {
        session()->setFlashdata('error', 'Please choose an Employee ID.');
        return redirect()->to('backend/admin/adminleaves'); // Redirect back to the leaves page
    }

    // Build the query dynamically based on the filters
    $query = $leaveModel->select('*');

    if (!empty($employeeId)) {
        $query->where('employee_id', $employeeId);
    }

    if ($filterType === 'date' && !empty($date)) {
        $query->where('start_date <=', $date)->where('end_date >=', $date);
    } elseif ($filterType === 'status' && !empty($status)) {
        $query->where('status', $status);
    }

    // Execute the query and get the results
    $leaves = $query->findAll();

    // Check if there are results
    if (!$leaves) {
        session()->setFlashdata('error', 'No leave records found for the given filters.');
    }

    return view('admin/leaves', [
        'leaves' => $leaves,
    ]);
}

public function userdashboard(){
    return view('userdashboard');
}

public function userleaves(){
{
     $session = session();
    $empId = $session->get('emp_id');

    // ✅ Load the models
    $leaveModel = new LeaveModel();
    $employeeModel = new EmployeeModel();

    // ✅ Fetch employee details (optional)
    $data['employee'] = $employeeModel->where('emp_id', $empId)->first();

    // ✅ Fetch leave data for the logged-in employee
   $data['leaves'] = $leaveModel->where('emp_id', $empId)->findAll();

    // var_dump($data);
    // die();
    

    // ✅ Count leave statuses for the logged-in employee
    // $cancelledCount = $employeeModel->where(['status' => 'cancelled', 'emp_id' => $empId])->countAllResults();
    // $pendingCount = $employeeModel->where(['status' => 'pending', 'emp_id' => $empId])->countAllResults();
    // $approvedCount = $employeeModel->where(['status' => 'approved', 'emp_id' => $empId])->countAllResults();
    // $rejectedCount = $employeeModel->where(['status' => 'rejected', 'emp_id' => $empId])->countAllResults();




    // // ✅ Set initial leave allocation (e.g., 18 leaves per year)
    // $totalLeavesAllocated = 18;
    // $leavesAppliedCount = $cancelledCount + $pendingCount + $approvedCount + $rejectedCount;

    // // ✅ Calculate remaining leaves for the employee
    // $leavesLeft = $totalLeavesAllocated - $approvedCount;

    // // ✅ Prepare the data to update in the database
    // $updateData = [
    //     'leaves_cancelled' => $cancelledCount,
    //     'leaves_pending' => $pendingCount,
    //     'leaves_approved' => $approvedCount,
    //     'leaves_rejected' => $rejectedCount,
    //     'leaves_left' => $leavesLeft,
    //     'leaves_applied' => $leavesAppliedCount,
    // ];

    // $employeeModel->insert($updateData);

    // ✅ Update or insert leave summary for the employee
    // $leaveSummaryModel = new LeaveSummaryModel();
    // $existingSummary = $leaveSummaryModel->where('emp_id', $empId)->first();

    // if ($existingSummary) {
    //     $leaveSummaryModel->update($existingSummary['id'], $updateData);
    // } else {
    //     $updateData['emp_id'] = $empId;
    //     $leaveSummaryModel->insert($updateData);
    // }

    // ✅ Pass the data to the view
    return view('userleaves', $data);
}
}

public function applyLeave()
{
    // Load models
    $leaveModel = new LeaveModel(); // Assuming this model handles leave applications
    $employeeModel = new EmployeeModel(); // Assuming this model handles employee data
    $session = session();

    // Get logged-in user's email from session
    $submittedEmail = $session->get('email');

    // Fetch employee details
    $employee = $employeeModel->where('email', $submittedEmail)->first();
    // if (!$employee) {
    //     session()->setFlashdata('error', 'Employee not found.');
    //     return redirect()->back()->withInput();
    // }

    $emp_id = $employee['emp_id'];
   


 //    // Prepare leave data for insertion
    $leaveData = [
        'leave_type'   => $this->request->getPost('leave_type'),
        'start_date'   => $this->request->getPost('start_date'),
        'end_date'     => $this->request->getPost('end_date'),
        'no_of_days'   => $this->request->getPost('num_days'),
        'half_day'     => $this->request->getPost('half_day') ?? 'No',
        'description'  => $this->request->getPost('description'),
        'status'       => 'Pending',
        'emp_id'  =>  $employee['emp_id'],
        // 'leaves_applied' =>$leaves_applied,
    ];


 //    // Insert leave data
 //    $leaveModel->insert($leaveData);
    

 //    // Optimize leave counts
 //    $leaveStats = $leaveModel
 //        ->select("COUNT(IF(status = 'cancelled', 1, NULL)) as cancelled_count,
 //                  COUNT(IF(status = 'pending', 1, NULL)) as pending_count,
 //                  COUNT(IF(status = 'approved', 1, NULL)) as approved_count,
 //                  COUNT(IF(status = 'rejected', 1, NULL)) as rejected_count")
 //        ->where('emp_id', $emp_id)
 //        ->first();

 //    // Calculate remaining leaves
 //    $initialLeaves = 18;
 //    $approvedCount = $leaveStats['approved_count'];
 //    $leavesLeft = $initialLeaves - $approvedCount;

 //    // Prepare update data
 //    $updateData = [
 //        'leaves_cancelled' => $leaveStats['cancelled_count'],
 //        'leaves_pending' => $leaveStats['pending_count'],
 //        'leaves_approved' => $leaveStats['approved_count'],
 //        'leaves_rejected' => $leaveStats['rejected_count'],
 //        'leaves_left' => $leavesLeft,
 //        'leaves_applied' => array_sum($leaveStats),
 //    ];

 //    // Update leave summary
 //    $leaveSummaryModel = new LeaveN();
 //    $leaveSummaryModel->update($emp_id, $updateData);

 //    // Prepare the email content
    $leaveRequest = [
        // 'id'     =>      $leaveData['id'], 
        'name'          => $employee['name'],
        'emp_id'   =>   $employee['emp_id'],
        'no_of_days'    => $leaveData['no_of_days'],
        'half_day'      => $leaveData['half_day'],
        'leave_start'   => $leaveData['start_date'],
        'leave_end'     => $leaveData['end_date'],
        'reason'        => $leaveData['description'],
    ];

    $emailBody = "
        <h3>Leave Request Notification</h3>
        <p><strong>Name:</strong> {$leaveRequest['name']}</p>
        <p><strong>Employee ID:</strong> {$leaveRequest['emp_id']}</p>
        <p><strong>Number of Days:</strong> {$leaveRequest['no_of_days']}</p>
        <p><strong>Applied for Half Day:</strong> {$leaveRequest['half_day']}</p>
        <p><strong>Leave Start Date:</strong> {$leaveRequest['leave_start']}</p>
        <p><strong>Leave End Date:</strong> {$leaveRequest['leave_end']}</p>
        <p><strong>Reason:</strong> {$leaveRequest['reason']}</p>
        <br>
        <br>
        <p>Please review and take action:</p>
        <a href='" . site_url('backend/admin/adminleaves') . "' style='background-color: green; color: white; padding: 10px 15px; text-decoration: none;'>View</a>
    ";

    // Send email notification
    $email = \Config\Services::email();
    $email->setFrom('noreply@ornatets.com', 'HR Admin');
    $email->setTo(['utkarsh@ornatets.com']);
    $email->setSubject('Leave Request Notification');
    $email->setMessage($emailBody);
    $email->setMailType('html');

    if ($email->send()) {
        session()->setFlashdata('success', 'Leave request submitted and email sent successfully.');
    } else {
        session()->setFlashdata('error', 'Failed to send email. ' . $email->printDebugger());
    }

    return redirect()->to('backend/userleaves');
}


public function createEmployee()
{
    $data = $this->request->getPost(); // Get form data


    $employeeModel = new EmployeeModel();

    // Try to create the employee record
    $response = $employeeModel->createNewEmployee($data);

    if ($response['status']) {
        // If success, redirect with a success message
        return redirect()->to('/success')->with('message', $response['message']);
    } else {
        // If failure, pass the error message
        return redirect()->back()->with('error', $response['message']);
    }
}


public function attendance()
    {
        $attendanceModel = new AttendanceModel();
        $data = $attendanceModel->get_all_attendance();
        return view('admin/attendance', ['attendance' => $data]);
    }

    public function upload()
    {
        $file = $this->request->getFile('excelFile');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            try {
                // Load and process the Excel file using PhpSpreadsheet
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

            //      echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit();

                $attendanceModel = new AttendanceModel();
                $result = $attendanceModel->upload_attendance_from_excel($data);

                // Prepare success message
                $message = 'Attendance records uploaded successfully.';
                if ($result['invalidRows']) {
                    $message .= ' Skipped rows: ' . implode(', ', $result['invalidRows']);
                }

                return redirect()->to('/backend/admin/attendance')->with('success', $message);

            } catch (\Exception $e) {
                log_message('error', 'Exception during upload: ' . $e->getMessage());
                return redirect()->to('/backend/admin/attendance')->with('error', 'An error occurred during file upload. Please try again.');
            }
        }

        return redirect()->to('/backend/admin/attendance')->with('error', 'Failed to upload file. Please ensure the file is valid and try again.');
    }

    public function calculateMonthlyAttendance($emp_id, $month, $year)
{
    $attendanceModel = new AttendanceModel();
    $attendanceData = $attendanceModel->getAttendanceByEmployeeAndMonth($emp_id, $month);

    $totalDurationInMinutes = 0;

    foreach ($attendanceData as $record) {
        $duration = $record['duration'];
        $durationParts = explode(":", $duration);

        if (count($durationParts) === 3) {
            $hours = (int)$durationParts[0];
            $minutes = (int)$durationParts[1];
            $seconds = (int)$durationParts[2];
        } else {
        
            if (count($durationParts) === 2) {
                $hours = 0;
                $minutes = (int)$durationParts[0];
                $seconds = (int)$durationParts[1];
            } else if (count($durationParts) === 1) {
                $hours = 0;
                $minutes = 0;
                $seconds = (int)$durationParts[0];
            } else {
               
                $hours = 0;
                $minutes = 0;
                $seconds = 0;
            }
        }

        $totalDurationInMinutes += ($hours * 60) + $minutes + ($seconds / 60);
    }

    $totalHours = floor($totalDurationInMinutes / 60);
    $totalMinutes = floor($totalDurationInMinutes % 60);
    $totalSeconds = round(($totalDurationInMinutes * 60) % 60);

    return sprintf("%02d:%02d:%02d", $totalHours, $totalMinutes, $totalSeconds);
}

    public function monthlyAttendance($emp_id, $month, $year)
    {
        $attendanceModel = new AttendanceModel();
        $attendanceData = $attendanceModel->getAttendanceByEmployeeAndMonth($emp_id, $month);

        $totalAttendance = $this->calculateMonthlyAttendance($emp_id, $month, $year);

        return view('admin/monthly_attendance', [
            'attendanceData' => $attendanceData,
            'totalAttendance' => $totalAttendance,
            'emp_id' => $emp_id,
            'month' => $month,
            'year' => $year
        ]);
    }



}
