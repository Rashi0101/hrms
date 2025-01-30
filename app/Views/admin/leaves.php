<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Leave Management</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('leaves/applyLeave') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee ID</label>
            <input type="number" class="form-control" name="employee_id" id="employee_id" required>
        </div>

       <div class="mb-3">
        <label for="leave_type" class="form-label">Leave Type</label>
        <select class="form-control" name="leave_type" id="leave_type" required>
            <option value="" disabled selected>Select Leave Type</option>
            <option value="Casual Leave">Casual Leave</option>
            <option value="Sick Leave">Sick Leave</option>
            <option value="Annual Leave">Annual Leave</option>
            <option value="Maternity Leave">Maternity Leave</option>
            <option value="Paternity Leave">Paternity Leave</option>
            <option value="Emergency Leave">Emergency Leave</option>
        </select>
       </div>

         <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="start_date" required>
        </div>
         <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" id="end_date" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Apply Leave</button>
    </form>

    <h3 class="mt-5">Leave Records</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leaves as $leave): ?>
                <tr>
                    <td><?= esc($leave['employee_id']) ?></td>
                    <td><?= esc($leave['leave_type']) ?></td>
                    <td><?= esc($leave['start_date']) ?></td>
                    <td><?= esc($leave['end_date']) ?></td>
                    <td><?= esc($leave['reason']) ?></td>
                    <td><?= esc($leave['status']) ?></td>
                    <td>
                        <!-- Accept Button -->
                        <?php if ($leave['status'] == 'Pending'): ?>
                            <a href="<?= site_url('leaves/acceptLeave/' . $leave['id']) ?>" class="btn btn-success btn-sm">Accept</a>
                        <?php endif; ?>
                        <!-- Reject Button -->
                        <?php if ($leave['status'] == 'Pending'): ?>
                            <a href="<?= site_url('leaves/rejectLeave/' . $leave['id']) ?>" class="btn btn-danger btn-sm">Reject</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
