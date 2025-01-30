<!-- app/Views/admin/employee_edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Employee</h2>

    <!-- Display any flash messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Edit Form -->
    <form action="<?= base_url('employee_update/' . $employee['employee_id']) ?>" method="post">
        <?= csrf_field() ?>

         <div class="form-group">
            <label for="">Employee Id:</label>
            <input type="number" name="employee_id" id="employee_id" class="form-control" value="<?= old('employee_id', $employee['employee_id']) ?>" required>
        </div>


        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= old('name', $employee['name']) ?>" required>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= old('email', $employee['email']) ?>" required>
        </div>

        <!-- Phone Field -->
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="<?= old('phone', $employee['phone']) ?>" required>
        </div>

        <!-- Date of Birth Field -->
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" class="form-control" value="<?= old('dob', $employee['dob']) ?>" required>
        </div>

        <!-- Gender Field -->
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="Male" <?= (old('gender', $employee['gender']) == 'Male' ? 'selected' : '') ?>>Male</option>
                <option value="Female" <?= (old('gender', $employee['gender']) == 'Female' ? 'selected' : '') ?>>Female</option>
                <option value="Other" <?= (old('gender', $employee['gender']) == 'Other' ? 'selected' : '') ?>>Other</option>
            </select>
        </div>

        <!-- Address Field -->
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea name="address" id="address" class="form-control" required><?= old('address', $employee['address']) ?></textarea>
        </div>

        <!-- Department Field -->
        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" name="department" id="department" class="form-control" value="<?= old('department', $employee['department']) ?>" required>
        </div>

        <!-- Designation Field -->
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" id="designation" class="form-control" value="<?= old('designation', $employee['designation']) ?>" required>
        </div>

        <!-- Hire Date Field -->
        <div class="form-group">
            <label for="hire_date">Hire Date:</label>
            <input type="date" name="hire_date" id="hire_date" class="form-control" value="<?= old('hire_date', $employee['hire_date']) ?>" required>
        </div>

        <!-- Salary Field -->
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" name="salary" id="salary" class="form-control" value="<?= old('salary', $employee['salary']) ?>" required>
        </div>

        <!-- Status Field -->
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="Active" <?= (old('status', $employee['status']) == 'Active' ? 'selected' : '') ?>>Active</option>
                <option value="Inactive" <?= (old('status', $employee['status']) == 'Inactive' ? 'selected' : '') ?>>Inactive</option>
            </select>
        </div>

        <!-- Role Field -->
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="admin" <?= (old('role', $employee['role']) == 'admin' ? 'selected' : '') ?>>Admin</option>
                <option value="user" <?= (old('role', $employee['role']) == 'user' ? 'selected' : '') ?>>User</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
</div>

</body>
</html>
