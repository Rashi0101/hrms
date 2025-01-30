<?php

namespace App\Controllers;

use App\Models\LeaveModel;

class LeaveCont extends BaseController
{
    public function index()
    {
        $leaveModel = new LeaveModel();
        $data['leaves'] = $leaveModel->where('status', 'Pending')->findAll();

        return view('admin/leaves', $data);
    }

    public function applyLeave()
    {
        $leaveModel = new LeaveModel();

        $data = [
            'employee_id' => $this->request->getPost('employee_id'),
            'leave_type' => $this->request->getPost('leave_type'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'reason' => $this->request->getPost('reason'),
            'status' => 'Pending',
        ];

        if ($leaveModel->insert($data)) {
            return redirect()->to('admin/leaves')->with('success', 'Leave application submitted successfully.');
        } else {
            return redirect()->to('admin/leaves')->with('error', 'Failed to submit leave application.');
        }
    }

    public function acceptLeave($id)
{
    $leaveModel = new LeaveModel();
 
    $leave = $leaveModel->find($id);
    if ($leave) {

        $leaveModel->update($id, ['status' => 'Accepted']);
        
        session()->setFlashdata('success', 'Leave Accepted');
    } else {
        session()->setFlashdata('error', 'Leave record not found');
    }

    return redirect()->to('admin/leaves');
}

    public function rejectLeave($id)
{
    $leaveModel = new LeaveModel();


    $leave = $leaveModel->find($id);
    if ($leave) {
     
        $leaveModel->update($id, ['status' => 'Rejected']);
        
        session()->setFlashdata('error', 'Leave Rejected');
    } else {
        session()->setFlashdata('error', 'Leave record not found');
    }

    return redirect()->to('admin/leaves');
}


}
