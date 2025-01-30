<!-- app/Views/admin/employee_list.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Employee List</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Table to display employee data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Department</th>
                <th>Hire Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($employees)): ?>
                <tr>
                    <td colspan="9" class="text-center">No employees found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['employee_id']; ?></td>
                        <td><?= $employee['name']; ?></td>
                        <td><?= $employee['email']; ?></td>
                        <td><?= $employee['phone']; ?></td>
                        <td><?= ucfirst($employee['role']); ?></td>
                        <td><?= $employee['department']; ?></td>
                        <td><?= $employee['hire_date']; ?></td>
                        <td><?= ucfirst($employee['status']); ?></td>
                        <td>
                            <a href="<?= base_url('employee_edit/' . $employee['employee_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('employee_delete/' . $employee['employee_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
