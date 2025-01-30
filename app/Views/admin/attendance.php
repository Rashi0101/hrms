<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<<<<<<< HEAD
      <style>
        body {
            background-color: #f8f9fa;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 200px;
            height: 100%;
            background-color: #4caf50;
            color: #ecf0f1;
            position: fixed;
            padding: 20px;
            display: flex;
            flex-direction: column;
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

        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .dashboard-header h1 {
            margin: 0;
        }
        .search-container {
            display: flex;
            width: 300px;
            position: relative;
        }
        .search-bar {
            width: 100%;
            border-radius: 0.25rem 0 0 0.25rem; /* Rounded left side */
        }
        .search-btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 0 10px;
            border-radius: 0 0.25rem 0.25rem 0; /* Rounded right side */
            cursor: pointer;
        }
        .search-btn:hover {
            background-color: #0056b3;
        }
        .suggestions-list {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
 
    </div>
=======
</head>
<body>

>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
<div class="container mt-5">
    <h1>Attendance Page</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

<<<<<<< HEAD
    <div class="mb-3">
        <form action="<?= base_url('/backend/admin/attendance/upload') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
            <label for="excelFile">Upload Excel Sheet:</label>
            <input type="file" name="excelFile" id="excelFile" accept=".xlsx" required>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
=======
        <div class="mb-3">
            <form action="<?= base_url('admin/attendance') ?>" method="POST" enctype="multipart/form-data">
                <label for="excelFile">Upload Excel Sheet:</label>
                <input type="file" name="excelFile" id="excelFile" accept=".xlsx" required>
                <button type="submit">Upload</button>
            </form>
        </div>
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

    <h3 class="mt-5">Attendance Records</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee id</th>
                <th>Check_in</th>
                <th>Check_out</th>
                <th>Duration</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
<<<<<<< HEAD
        <?php if (!empty($attendance)): ?>
            <?php foreach ($attendance as $row): ?>
                <tr>
                    <td><?= esc($row['emp_id']); ?></td> 
                    <td><?= esc($row['check_in']); ?></td>    
                    <td><?= esc($row['check_out']); ?></td> 
                    <td><?= esc($row['duration']); ?></td>    
                    <td><?= esc($row['Date']); ?></td>        
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No attendance data available. Please upload an Excel file.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

<form id="attendanceForm" action="<?= base_url('backend/admin/monthly-attendance/') ?>" method="post">
    <div>
        <label for="employee_id">Employee ID:</label>
        <input type="text" id="emp_id" name="emp_id" required>
    </div>
    <div>
        <label for="month">Month:</label>
        <select id="month" name="month" required>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
    </div>
   <!--  <div>
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" value="<?= date('Y') ?>" readonly>
    </div>  -->

    <!-- Year Select List -->
        <div>
            <label for="year">Year:</label>
            <select id="year" name="year" required>
                <?php 
                    $currentYear = date('Y');
                    for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++): ?>
                        <option value="<?= $i ?>" <?= ($i == $currentYear) ? 'selected' : ''; ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>

    <button type="submit">Calculate Monthly Attendance</button>
</form>


<script>
    document.getElementById('attendanceForm').addEventListener('submit', function (e) {
        var emp_id = document.getElementById('emp_id').value;
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;

        // Update the form action to include the year
        this.action = "<?= base_url('backend/admin/monthly-attendance/') ?>" + emp_id + "/" + month + "/" + year;
    });
</script>


=======
    <?php if (!empty($attendance)): ?>
        <?php foreach ($attendance as $row): ?>
            <tr>
                <td><?= esc($row['employee_id']); ?></td> 
                <td><?= esc($row['check_in']); ?></td>    
                <td><?= esc($row['check_out']); ?></td> 
                <td><?= esc($row['duration']); ?></td>    
                <td><?= esc($row['Date']); ?></td>        
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No attendance data available. Please upload an Excel file.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
