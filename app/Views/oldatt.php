<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Attendance Page</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

        <div class="mb-3">
            <form action="<?= base_url('admin/attendance') ?>" method="POST" enctype="multipart/form-data">
                <label for="excelFile">Upload Excel Sheet:</label>
                <input type="file" name="excelFile" id="excelFile" accept=".xlsx" required>
                <button type="submit">Upload</button>
            </form>
        </div>

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
        <?php if (!empty($excelData)): ?>
            <?php foreach ($excelData as $row): ?>
                <?php
                    $employeeId = $row[0];  
                    $checkIn = $row[1];      
                    $checkOut = $row[2];     

                    $duration = 'Not Available';
                    if ($checkIn && $checkOut) {
                        try {
                            $checkInTime = new \DateTime($checkIn);
                            $checkOutTime = new \DateTime($checkOut);
                            $duration = $checkInTime->diff($checkOutTime)->format('%h:%i');  // Format as hours and minutes
                        } catch (\Exception $e) {
                            $duration = 'Invalid Time';
                        }
                    }
                    $date = $row[4];  
                ?>
                <tr>
                    <td><?php echo $employeeId; ?></td>
                    <td><?php echo $checkIn ? date('Y-m-d H:i:s', strtotime($checkIn)) : 'N/A'; ?></td>
                    <td><?php echo $checkOut ? date('Y-m-d H:i:s', strtotime($checkOut)) : 'N/A'; ?></td>
                    <td><?php echo $duration; ?></td>
                    <td><?php echo date('Y-m-d'); ?></td> 
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No attendance data available. Please upload an Excel file.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
