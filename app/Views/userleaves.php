<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Leave Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
     <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 200px;
            height: 98%;
            background-color: #4caf50;
            color: #ecf0f1;
            position: fixed;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 8px 10px; 
            border-radius: 5px; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #45a049; 
            color: #ffffff; 
        }

        .sidebar hr {
            border: 0;
            height: 1px;
            background-color: #ecf0f1;
            margin: 20px 0;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .content h2 {
            text-align: center;
        }

        .employee-info {
            display: flex;
            align-items: center;
            margin: 20px;
            position: relative;
        }

        .table_div {
            margin-left: 10px;
        }

        .employee-photo {
            width: 100px;
            height: 100px;
            border-radius: 0;
            margin-right: 20px;
        }

        .employee-details {
            font-size: 16px;
        }

        .apply-leave-btn {
            position: absolute;
            right: 0;
            top: 50%;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .apply-leave-btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        .empty-row {
            text-align: center;
            color: #888;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }

        .modal-close {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .modal-close:hover {
            background-color: #c0392b;
        }

        .modal form input,
        .modal form select,
        .modal form textarea {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        .modal form input[type="submit"] {
            background: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .modal form input[type="submit"]:hover {
            background: #388e3c;
        }

        .success-message {
            color: green;
            font-size: 18px;
            font-weight: bold;
        }
         .cancel-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #e74c3c;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
        }

        .cancel-btn:hover {
            background-color: #c0392b
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h2>Ornate TechnoServices</h2><hr>
            <a href="<?= site_url('Home/home') ?>">Home</a><hr>
            <a href="<?= site_url('Home/employee') ?>">Employees List</a><hr>
            <a href="<?= site_url('payroll') ?>">Payroll</a><hr>
            <a href="<?= site_url('Home/userList') ?>">Leaves</a><hr>
            <a href="<?= site_url('Home/holidays') ?>">Holidays</a><hr>
            <a href="<?= site_url('Home/user_attendance') ?>">Attendance</a>
            <hr>
        </div>
        <div>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="<?= site_url('Home/logout') ?>">Logout</a>
        </div>
    </div>

    <div class="content">
        <h2>Leaves Details</h2>
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
        <div class="employee-info">
           <img src="<?= base_url('uploads/' . session()->get('profile_picture')); ?>" alt="Profile Picture" class="employee-photo">
            <div class="employee-details">
                <p><h4><?= session()->get('name'); ?></h4></p>
                <p><strong>Employee ID:</strong> <?= session()->get('emp_id'); ?></p>
             
            </div>
            <button class="apply-leave-btn" onclick="openModal()">Apply Leave</button>
        </div>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Total Leaves Left</th>
            <th>Total Leaves Applied</th>
            <th>Cancelled Leaves</th>
            <th>Pending Leaves</th>
            <th>Approved Leaves</th>
            <th>Rejected Leaves</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($employee)): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="6">No leave data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Leave Application History</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Leave Type</th>
            <th>Number of Days</th>
            <th>Leaves Start</th>
            <th>Leaves End</th>
            <th>Half Day</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($leaves)): ?>
            <?php foreach ($leaves as $leave): ?>
                <tr>
                    <td><?= esc($leave['leave_type']) ?></td>
                    <td><?= esc($leave['no_of_days']) ?></td>
                    <td><?= esc($leave['start_date']) ?></td>
                    <td><?= esc($leave['end_date']) ?></td>
                    <td><?= $leave['no_of_days'] == 1 ? esc($leave['half_day']) : 'Full Day' ?></td>
                    <td><?= esc($leave['description']) ?></td>
                    <td>
                        <?= esc($leave['status']) ?>
                        <?php if ($leave['status'] === 'Pending'): ?>
                            <a href="<?= site_url('bakend/cancelLeave/' . $leave['id']) ?>" 
                               class="cancel-btn" 
                               onclick="return confirm('Are you sure you want to cancel this leave?')">Cancel</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No leave applications found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>




   <div class="modal" id="leaveModal">
        <div class="modal-content">
            <h3>Apply Leave</h3>
            <form method="post" action="<?= base_url('backend/applyLeave') ?>">
                <select name="leave_type" required>
                    <option value="">Select Leave Type</option>
                    <option value="Casual">Casual Leave</option>
                    <option value="Sick">Sick Leave</option>
                    <option value="Planned">Planned Leave</option>
                    <option value="Planned">Emergency Leave</option>
                </select>
                <label for="start_date">Leave Start Date</label>
                <input type="date" id="start_date" name="start_date" required onchange="calculateDays()">
                <label for="end_date">Leave End Date</label>
                <input type="date" id="end_date" name="end_date" required onchange="calculateDays()">
                <label for="num_days">Number of Days</label>
              <input type="number" id="num_days" name="num_days" readonly>

<!-- Half Day / Full Day Options -->
 <div id="halfDayOptions" style="display:none;">
    <input type="radio" id="half_day" name="half_day" value="Half Day">
    <label for="half_day">Half Day</label>

    <input type="radio" id="full_day" name="half_day" value="Full Day">
    <label for="full_day">Full Day</label>
</div>

<!-- 1st Half / 2nd Half Options -->
<div id="halfDetails" style="display:none;">
    <input type="radio" id="first_half" name="half_detail" value="1st Half">
    <label for="first_half">1st Half</label>

    <input type="radio" id="second_half" name="half_detail" value="2nd Half">
    <label for="second_half">2nd Half</label>
</div>

                <textarea name="description" placeholder="Reason for Leave" required></textarea>
                <input type="submit" value="Apply">
                <button type="button" class="modal-close" onclick="closeModal()">Close</button>
            </form>
        </div>
    </div>
     <script>
    function calculateDays() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const timeDiff = end - start;

            if (timeDiff < 0) {
                alert("End date must be later than start date.");
                document.getElementById('end_date').value = '';
                return;
            }

            const days = timeDiff / (1000 * 3600 * 24) + 1;
            document.getElementById('num_days').value = days;

            document.getElementById('halfDayOptions').style.display = days === 1 ? 'block' : 'none';
            document.getElementById('halfDetails').style.display = 'none';  // Hide half details section
        }
    }

    function openModal() {
        document.getElementById('leaveModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('leaveModal').style.display = 'none';

        // Reset the form fields
        const leaveForm = document.getElementById('leaveForm');
        leaveForm.reset();

        // Reset the number of days field and hide half-day options
        document.getElementById('num_days').value = '';
        document.getElementById('halfDayOptions').style.display = 'none';
        document.getElementById('halfDetails').style.display = 'none';  // Hide half details section

        // Uncheck radio buttons if any
        const radioButtons = leaveForm.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => radio.checked = false);
    }
</script>

</body>
</html>
