<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Employee_model;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function view()
    {
        $employeeModel = new Employee_model();
        $employees = $employeeModel->get_all_employees();

        return view('admin/employeeview', ['employees' => $employees]);
    }

    // app/Controllers/EmployeeController.php

public function delete_employee($id)
{
    $employeeModel = new Employee_model();

    // Check if the employee exists
    $employee = $employeeModel->find($id);
    if ($employee) {
        // Delete employee
        $employeeModel->delete($id);
        session()->setFlashdata('success', 'Employee deleted successfully');
    } else {
        session()->setFlashdata('error', 'Employee not found');
    }

    return redirect()->to('/admin/employeeview');
}

public function edit_employee($id)
    {
        $employeeModel = new Employee_model();
        $employee = $employeeModel->find($id);  

        if (!$employee) {
            // If employee doesn't exist, show an error
            session()->setFlashdata('error', 'Employee not found');
            return redirect()->to('/admin/employeeview');
        }

        // Pass the employee data to the view
        return view('admin/employee_edit', ['employee' => $employee]);
    }

        public function employee_update($id)
    {
        $employeeModel = new Employee_model();

        // Validation rules can be defined as needed
        if (!$this->validate([

            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            // Add other validation rules as needed
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get updated data from the form
        $data = [
            'employee_id' => $this->request->getPost('employee_id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'dob' => $this->request->getPost('dob'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'department' => $this->request->getPost('department'),
            'designation' => $this->request->getPost('designation'),
            'hire_date' => $this->request->getPost('hire_date'),
            'salary' => $this->request->getPost('salary'),
            'status' => $this->request->getPost('status'),
            'role' => $this->request->getPost('role'),
        ];

        // Update employee data
        if ($employeeModel->update($id, $data)) {
            session()->setFlashdata('success', 'Employee updated successfully!');
            return redirect()->to('/admin/employeeview');  // Redirect to employee list page
        } else {
            session()->setFlashdata('error', 'Failed to update employee.');
            return redirect()->back()->withInput();
        }
    }
public function search_employees()
{
    // Get the search query from the request
    $query = $this->request->getGet('query'); // Input from search box
    
    // Validate input
    if (!$query) {
        return $this->response->setJSON([]); // Return empty array if no query is provided
    }

    // Fetch employees whose name starts with the query
    $employeeModel = new Employee_model(); // Assuming you have an Employee_model
    $employees = $employeeModel
        ->like('name', $query, 'before') // Match employee names starting with query
        ->findAll(); // Get all matching employees

    // Return the data as a JSON response
    return $this->response->setJSON($employees);
}

public function logout()
{
    session()->destroy(); // Destroy session
    return $this->response->setJSON(['status' => 'success']); 
}


}

