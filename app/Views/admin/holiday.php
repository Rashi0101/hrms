<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday List Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Holiday List Page</h1>

    <!-- Success/Error Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Form to upload Excel -->
    <div class="mb-3">
        <form action="<?= base_url('admin/holiday') ?>" method="POST" enctype="multipart/form-data">
            <label for="excelFile">Upload Excel Sheet:</label>
            <input type="file" name="excelFile" id="excelFile" accept=".xlsx" required>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <h3 class="mt-5">Holiday List</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Holiday Name</th>
                <th>Date</th>
                <th>Day</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($holidays)): ?>
            <?php foreach ($holidays as $row): ?>
                <tr>
                    <td><?= esc($row['holiday_name']); ?></td>
                    <td><?= esc($row['holiday_date']); ?></td>
                    <td><?= esc($row['holiday_day']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No holidays found. Please upload an Excel file.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
