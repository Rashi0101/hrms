<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Timesheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f7f6;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #4CAF50;
            color: #ecf0f1;
            position: fixed;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #45a049;
            color: #ffffff;
        }

        /* Sidebar bottom links */
        .sidebar div {
            margin-top: auto;
        }

        .sidebar hr {
            border: 1px solid #ecf0f1;
            margin: 10px 0;
        }

        /* Main content */
        .content {
            margin-left: 280px;
            padding: 20px;
            width: 100%;
            background-color: #fff;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .filter-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-form select,
        .filter-form input {
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            width: 200px;
        }

        .filter-form select {
            max-width: 300px;
        }

        .filter-form button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
            min-width: 120px;
            margin-bottom: 10px;
        }

        .filter-form button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }

        .edit-button,
        .delete-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
            text-align: center;
        }

        .edit-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .no-records {
            text-align: center;
            color: #888;
            font-size: 16px;
            margin-top: 20px;
        }

        /* Responsive layout adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }

            .filter-form {
                flex-direction: column;
            }

            .filter-form select,
            .filter-form input,
            .filter-form button {
                width: 100%;
                margin-bottom: 10px;
            }

            .filter-form button {
                min-width: auto;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h2>Ornate TechnoServices</h2><hr>
            <a href="<?= site_url('admin/dashboard1') ?>">Home</a><hr>
            <a href="<?= site_url('Home/employee') ?>">Employees List</a><hr>
            <a href="<?= site_url('admin/admintimesheet') ?>">Timesheet</a><hr>
            <a href="<?= site_url('admin/leaves') ?>">Leaves</a><hr>
            <a href="<?= site_url('admin/holiday') ?>">Holidays</a><hr>
            <a href="<?= site_url('admin/attendance') ?>">Attendance</a>
            <hr>
        </div>
        <div>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="<?= site_url('Home/logout') ?>">Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>Admin Timesheet</h1>

        <!-- Filter Form -->
        <form action="<?= site_url('admin/admintimesheet/filter') ?>" method="GET" class="filter-form">
            <!-- Employee Dropdown -->
            <select name="employee_name">
                <option value="">Select Employee</option>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?= esc($employee['name']); ?>" <?= (isset($selectedEmployee) && $selectedEmployee == $employee['name']) ? 'selected' : ''; ?>>
                        <?= esc($employee['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Status Dropdown -->
            <select name="status">
                <option value="">Select Status</option>
                <option value="Completed" <?= (isset($selectedStatus) && $selectedStatus == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="Pending" <?= (isset($selectedStatus) && $selectedStatus == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="In Progress" <?= (isset($selectedStatus) && $selectedStatus == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
            </select>

            <!-- Date Range Fields -->
            <input type="date" name="date_from" placeholder="From Date" value="<?= isset($selectedDateFrom) ? esc($selectedDateFrom) : ''; ?>">
            <input type="date" name="date_to" placeholder="To Date" value="<?= isset($selectedDateTo) ? esc($selectedDateTo) : ''; ?>">

            <!-- Preset Date Ranges -->
            <select name="preset_date_range">
                <option value="">Custom Date Range</option>
                <option value="last_3_months" <?= (isset($presetDateRange) && $presetDateRange == 'last_3_months') ? 'selected' : ''; ?>>Last 3 Months</option>
                <option value="last_month" <?= (isset($presetDateRange) && $presetDateRange == 'last_month') ? 'selected' : ''; ?>>Last Month</option>
                <option value="last_year" <?= (isset($presetDateRange) && $presetDateRange == 'last_year') ? 'selected' : ''; ?>>Last Year</option>
            </select>

            <!-- Buttons -->
            <button type="submit">Filter</button>
            <button type="reset" onclick="window.location.href='<?= site_url('admin/admintimesheet') ?>'; return false;">Reset Filter</button>
        </form>

        <?php if (session()->getFlashdata('message')): ?>
            <p style="color: green;"><?= session()->getFlashdata('message'); ?></p>
        <?php endif; ?>

        <?php if (!empty($timesheet)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Task</th>
                        <th>Timeline</th>
                        <th>Assigned By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($timesheet as $row): ?>
                        <tr>
                            <td><?= esc($row['emp_id']); ?></td>
                            <td><?= esc($row['name']); ?></td>
                            <td><?= esc($row['date']); ?></td>
                            <td><?= esc($row['task']); ?></td>
                            <td><?= esc($row['timeline']); ?></td>
                            <td><?= esc($row['assigned_by']); ?></td>
                            <td><?= esc($row['status']); ?></td>
                            <td>
                                <a href="<?= site_url('admin/admintimesheet/edit/' . $row['id']); ?>" class="edit-button">Edit</a>
                                <!-- Additional actions can go here -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-records">No records found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
