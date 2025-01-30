<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Monthly Attendance</h1>
    
    <!-- Display Success/Failure Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    

        <?php if (isset($totalAttendance)): ?>
            <p><strong>Employee ID:</strong> <?= esc($emp_id) ?></p>
            <p><strong>Month:</strong> <?= esc($month) ?></p>
            <p><strong>Total Hours Worked:</strong> <?= esc($totalAttendance) ?> hours</p>

        <?php else: ?>
            <p>No attendance records found for the selected employee and month.</p>
        <?php endif; ?>

    </div>

    <!-- Monthly Attendance Table -->
    <h3>Attendance Records</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Duration (hours)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
<?php if (!empty($attendanceData)): ?>
    <?php foreach ($attendanceData as $record): ?>
        <tr>
            
            <td><?= esc($record['check_in']) ?></td>
            <td><?= esc($record['check_out']) ?></td>
            <td><?= esc($record['duration']) ?> hours</td>
            <td><?= esc($record['Date']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">No attendance records available.</td>
    </tr>
<?php endif; ?>
</tbody>


    </table>

    <a href="<?= site_url('admin/attendance') ?>" class="btn btn-primary">Back to Attendance Form</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>