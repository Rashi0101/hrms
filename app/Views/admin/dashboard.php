<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-bar {
            width: 300px;
        }
        .dashboard-links ul {
            list-style-type: none;
            padding: 0;
        }
        .dashboard-links ul li {
            margin: 10px 0;
        }
        .dashboard-links a {
            color: #007bff;
            text-decoration: none;
            font-size: 18px;
        }
        .dashboard-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome to the Admin Dashboard</h1>
        </div>

        <div class="dashboard-links">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="<?= base_url('admin/attendance') ?>">Attendance</a></li>
                <li><a href="<?= base_url('admin/employee_create') ?>">Employee Creation</a></li>
                <li><a href="<?= base_url('admin/leaves') ?>">Leaves</a></li>
                <li><a href="<?= base_url('admin/holiday') ?>">Holiday List</a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
