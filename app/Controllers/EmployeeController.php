<?php

namespace App\Controllers;
use App\Models\Employee_model;
use App\Models\UserModel;

class EmployeeController extends BaseController
{
    public function employee_create()
    {
        return view('admin/employee_create');  
    }

    public function save_employee()
{
    $employeeModel = new Employee_model();
    $userModel = new UserModel();

    $validation = \Config\Services::validation();

    $validation->setRules([
        'employee_id' => 'required',
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric',
        'dob' => 'required',
        'gender' => 'required',
        'address' => 'required',
        'department' => 'required',
        'designation' => 'required',
        'hire_date' => 'required',
        'salary' => 'required|numeric',
        'status' => 'required',
        'role' => 'required',
        'profile_picture' => 'permit_empty|is_image[profile_picture]|max_size[profile_picture,1024]',
    ]);

    if ($validation->withRequest($this->request)->run() == FALSE) {
        // Handle validation errors and preserve the uploaded file
        $profilePicture = $this->request->getFile('profile_picture');

        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            // Temporarily save the file
            $tempPath = WRITEPATH . 'uploads/temp/';
            if (!is_dir($tempPath)) {
                mkdir($tempPath, 0777, true);
            }
            $fileName = $profilePicture->getRandomName();
            $profilePicture->move($tempPath, $fileName);

            session()->setFlashdata('temp_profile_picture', $tempPath . $fileName);
        }

        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $profilePicturePath = session()->getFlashdata('temp_profile_picture') ?: '';

    if (!$profilePicturePath) {
        $profilePicture = $this->request->getFile('profile_picture');
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $uploadPath = WRITEPATH . 'uploads/profile_pictures/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $fileName = $profilePicture->getRandomName();
            $profilePicture->move($uploadPath, $fileName);

            $profilePicturePath = 'uploads/profile_pictures/' . $fileName;
        }
    }

    $name = $this->request->getPost('name');
    $dob = $this->request->getPost('dob');
    $email = $this->request->getPost('email');
    $role = $this->request->getPost('role');

    $data = [
        'employee_id' => $this->request->getPost('employee_id'),
        'name' => $name,
        'email' => $email,
        'phone' => $this->request->getPost('phone'),
        'dob' => $dob,
        'gender' => $this->request->getPost('gender'),
        'address' => $this->request->getPost('address'),
        'department' => $this->request->getPost('department'),
        'designation' => $this->request->getPost('designation'),
        'hire_date' => $this->request->getPost('hire_date'),
        'salary' => $this->request->getPost('salary'),
        'status' => $this->request->getPost('status'),
        'role' => $role,
        'profile_picture' => $profilePicturePath,
    ];
    if ($employeeModel->insert($data)) {
            // Create a password for the user based on the employee's name and dob
            $userPassword = $name . $dob;

            // Prepare user data
            $userData = [
                'email' => $email,
                'password' => password_hash($userPassword, PASSWORD_DEFAULT), 
                'role' => $role,
            ];

            // Insert the user data into the users table
            if ($userModel->insert($userData)) {
                session()->setFlashdata('success', 'Employee and user added successfully!');
                return redirect()->to('/admin/employee_create');
            } else {
            // Capture any error from userModel insert
            $error = $userModel->errors();
            log_message('error', 'User insertion failed: ' . print_r($error, true));
            session()->setFlashdata('error', 'There was an error saving the user. ' . implode(', ', $error));
            return redirect()->back()->withInput();
        }
    } else {
        session()->setFlashdata('error', 'There was an error saving the employee!');
        return redirect()->back()->withInput();
    }
    


    // if ($employeeModel->insert($data)) {
    //     session()->setFlashdata('success', 'Employee added successfully!');
    //     return redirect()->to('/admin/employee_create');
    // } else {
    //     session()->setFlashdata('error', 'There was an error saving the employee!');
    //     return redirect()->back()->withInput();
    // }
}
}
