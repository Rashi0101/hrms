<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'emp_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emp_id','name','contact_number','email','dob','gender','address','blood_group','profile_photo','married_status','eme_number','eme_name','eme_relation','department_id','designation_id','reporting_manager','doj','emp_status','team_id','date_rej'];

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
      'name' => 'required|min_length[3]|max_length[100]',
      'contact_number' => 'required|numeric|min_length[10]|max_length[15]',
      'email' => 'required|valid_email',
      'dob' => 'required|valid_date',
      'gender' => 'required|in_list[male,female,other]',
      'address' => 'required|max_length[255]',
      'blood_group' => 'permit_empty|max_length[10]',
      'profile_photo' => 'permit_empty|max_length[255]',
      'married_status' => 'required|in_list[married,single]',
      'eme_number' => 'required|numeric|min_length[10]|max_length[15]',
      'eme_name' => 'required|max_length[100]',
      'eme_relation' => 'required|max_length[50]',
      'department_id' => 'required|is_not_unique[departmentmasters.id]',
      'designation_id' => 'required|is_not_unique[designationmasters.id]',
      'reporting_manager' => 'required|is_not_unique[employees.emp_id]',
      'doj' => 'required|valid_date',
      'emp_status' => 'required|in_list[active,inactive,terminated]',
      'team_id' => 'required|is_not_unique[teammasters.id]',
      'date_rej' => 'permit_empty|valid_date',
    ];
    protected $validationMessages   = [
         'name' => [
           'required' => 'Name is required.',
           'min_length' => 'Name must be at least 3 characters long.',
           'max_length' => 'Name cannot exceed 100 characters.',
         ],
         'contact_number' => [
             'required' => 'Contact number is required.',
             'numeric' => 'Contact number must be numeric.',
             'min_length' => 'Contact number must be at least 10 digits long.',
             'max_length' => 'Contact number cannot exceed 15 digits.',
         ],
         'email' => [
             'required' => 'Email is required.',
             'valid_email' => 'Please provide a valid email address.',
         ],
         'dob' => [
             'required' => 'Date of birth is required.',
             'valid_date' => 'Please provide a valid date for date of birth.',
         ],
         'gender' => [
             'required' => 'Gender is required.',
             'in_list' => 'Gender must be one of the following: male, female, or other.',
         ],
         'address' => [
             'required' => 'Address is required.',
             'max_length' => 'Address cannot exceed 255 characters.',
         ],
         'blood_group' => [
             'max_length' => 'Blood group cannot exceed 10 characters.',
         ],
         'profile_photo' => [
             'max_length' => 'Profile photo path cannot exceed 255 characters.',
         ],
         'married_status' => [
             'required' => 'Marital status is required.',
             'in_list' => 'Marital status must be either married or single.',
         ],
         'eme_number' => [
             'required' => 'Emergency contact number is required.',
             'numeric' => 'Emergency contact number must be numeric.',
             'min_length' => 'Emergency contact number must be at least 10 digits long.',
             'max_length' => 'Emergency contact number cannot exceed 15 digits.',
         ],
         'eme_name' => [
             'required' => 'Emergency contact name is required.',
             'max_length' => 'Emergency contact name cannot exceed 100 characters.',
         ],
         'eme_relation' => [
             'required' => 'Emergency contact relation is required.',
             'max_length' => 'Emergency contact relation cannot exceed 50 characters.',
         ],
         'department_id' => [
             'required' => 'Department is required.',
             'is_not_unique' => 'The selected department does not exist.',
         ],
         'designation_id' => [
             'required' => 'Designation is required.',
             'is_not_unique' => 'The selected designation does not exist.',
         ],
         'reporting_manager' => [
             'required' => 'Reporting manager is required.',
             'is_not_unique' => 'The selected reporting manager does not exist.',
         ],
         'doj' => [
             'required' => 'Date of joining is required.',
             'valid_date' => 'Please provide a valid date for date of joining.',
         ],
         'emp_status' => [
             'required' => 'Employment status is required.',
             'in_list' => 'Employment status must be one of the following: active, inactive, or terminated.',
         ],
         'team_id' => [
             'required' => 'Team is required.',
             'is_not_unique' => 'The selected team does not exist.',
         ],
         'date_rej' => [
             'valid_date' => 'Please provide a valid date for rejection.',
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



   public function getEmployeesWithAllDetails() {
      return $this -> select('employees.*, departmentmasters.name as department_name, designationmasters.name as designation, teammasters.name as team_name, employees.name as employee_name, reporting_manager.name as reporting_manager_name ')
         -> join('departmentmasters', 'departmentmasters.id = employees.department_id', 'left')
         -> join('designationmasters', 'designationmasters.id = employees.designation_id', 'left')
         -> join('teammasters', 'teammasters.id = employees.team_id', 'left')
         -> join('employees as reporting_manager', 'reporting_manager.emp_id = employees.reporting_manager', 'left')
         -> findAll();
   }

   public function createNewEmployee(array $data)
{
    // Step 1: Validate the data
    if (!$this->validate($data)) {
        return [
            'status' => false,
            'errors' => $this->errors()
        ];
    }

    // Step 2: Insert the employee
    $this->insert($data);
    $emp_id = $this->insertID();

    // If employee creation fails
    if (!$emp_id) {
        return [
            'status' => false,
            'message' => 'Failed to create employee. Please try again.'
        ];
    }

    // Step 3: Generate username and password for the user
    $name = strtoupper(substr($data['name'], 0, 4));
    $dob = new \DateTime($data['dob']);
    $password = $name . $dob->format('dm');

    // Prepare user data
    $userData = [
        'username' => $data['email'],
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'emp_id' => $emp_id,
        'role' => 'user',
        'status' => 'active',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    // Step 4: Insert the user data
    $userModel = new \App\Models\UserModel();
    if (!$userModel->insert($userData)) {
        // If inserting user fails, delete the employee record
        $this->delete($emp_id);
        return [
            'status' => false,
            'message' => 'Employee created, but failed to create user. Please try again.'
        ];
    }

    // Step 5: Create leave record for the employee
    $leaveData = [
        'emp_id' => $emp_id,
        'available_leaves' => 0, // You might want to check if it's initialized as 0
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    $leaveModel = new \App\Models\LeavesMasterModel();
    if (!$leaveModel->insert($leaveData)) {
        // If inserting leave fails, delete both the employee and user record
        $this->delete($emp_id);
        $userModel->delete($emp_id); // Ensure to remove user too
        return [
            'status' => false,
            'message' => 'Employee and user created, but failed to create leave. Please try again.'
        ];
    }

    // If all operations succeed
    return [
        'status' => true,
        'emp_id' => $emp_id,
        'message' => 'Employee, user, and leave record created successfully.'
    ];
}

   
  
   public function editEmployee(int $emp_id, array $data) {
       if (!$this -> validate($data)) {
           return [
               'status' => false,
               'errors' => $this -> errors()
           ];
       }
       $employee = $this -> find($emp_id);
       if (!$employee) {
           return [
               'status' => false,
               'message' => 'Employee not found.'
           ];
       }
       $userModel = new\App\Models\UserModel();
       if (isset($data['email']) && $data['email'] !== $employee['email']) {
           $existingUser = $userModel -> where('email', $data['email']) -> first();
           if ($existingUser) {
               return [
                   'status' => false,
                   'message' => 'The email address is already in use by another user.'
               ];
           }
       }
       $this -> update($emp_id, $data);
       $userData = [
           'username' => $data['email'],
           'email' => $data['email'],
           'updated_at' => date('Y-m-d H:i:s'),
       ];
   
       if ($userModel -> update($employee['emp_id'], $userData)) {
           return [
               'status' => true,
               'message' => 'Employee and user details updated successfully.'
           ];
       } else {
           return [
               'status' => false,
               'message' => 'Failed to update user details. Please try again.'
           ];
       }
   }
   public function deactivateEmployee(int $emp_id){
       $employee = $this->find($emp_id);
       if (!$employee) {
           return [
               'status' => false,
               'message' => 'Employee not found.'
           ];
       }
   
       $this->update($emp_id, ['emp_status' => 'inactive']);
       $userModel = new \App\Models\UserModel(); 
       $userUpdateStatus = $userModel->where('emp_id', $emp_id)->set(['status' => 'inactive'])->update();
       if ($userUpdateStatus) {
           return [
               'status' => true,
               'message' => 'Employee and user status updated to inactive successfully.'
           ];
       } else {
           return [
               'status' => false,
               'message' => 'Employee status updated, but failed to update user status. Please try again.'
           ];
       }
   }


   public function saveEmployeeData($data)
    {
        return $this->insert($data);
    }

    public function handleProfilePicture($profilePicture)
    {
        $profilePicturePath = '';
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/profile_pictures/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $fileName = $profilePicture->getRandomName();
            $profilePicture->move($uploadPath, $fileName);

            $profilePicturePath = 'uploads/profile_pictures/' . $fileName;
        }
        return $profilePicturePath;
    }

    public function importEmployeeDataFromExcel($data)
    {
       try {
        foreach ($data as $row) {
            $employeeData = [
                'emp_id' => $row[0],
                'name' => $row[1],             
                'contact_number' => $row[2],
                'email' => $row[3],
                'dob' => ($row[4] && \DateTime::createFromFormat('m/d/Y', $row[4]))
                    ? \DateTime::createFromFormat('m/d/Y', $row[4])->format('Y-m-d')
                    : '2001-01-01',
                'gender' => $row[5],
                'address' => $row[6],
                'blood_group' => $row[7],
                'married_status' => $row[8],
                'eme_number' => $row[9],
                'eme_name' => $row[10],
                'eme_relation' => $row[11],
                'department_id' => $row[12],
                'designation_id' => $row[13],
                'reporting_manager' => $row[14],
                'doj' => ($row[15] && \DateTime::createFromFormat('m/d/Y', $row[15]))
                    ? \DateTime::createFromFormat('m/d/Y', $row[15])->format('Y-m-d')
                    : '2001-01-01',
                'date_rej' => ($row[16] && \DateTime::createFromFormat('m/d/Y', $row[16]))
                    ? \DateTime::createFromFormat('m/d/Y', $row[16])->format('Y-m-d')
                    : '2001-01-01',
                'emp_status' => $row[17],
                'team_id' => $row[18],
                'profile_picture' => $row[19],
            ];

            $this->createNewEmployee($employeeData);

            $success = true;
            $message = 'Employee data imported successfully!';
        }
        return ['status' => $success, 'message' => $message];
    }catch (Exception $e) {
        // If an error occurs, handle it and return a failure status
        log_message('error', 'Error importing employee data: ' . $e->getMessage());
        return ['status' => false, 'message' => 'Failed to import employee data.'];
    }


    }


}