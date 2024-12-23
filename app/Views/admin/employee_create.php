<?php if (session()->getFlashdata('success')): ?>
    <div style="color: green;">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('employee_create/save_employee') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <label for="employee_id">Employee Id:</label>
    <input type="number" name="employee_id" id="employee_id" value="<?= old('employee_id') ?>" required><br><br>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= old('name') ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= old('email') ?>" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" value="<?= old('phone') ?>" required><br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" value="<?= old('dob') ?>" required><br><br>

    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="Male" <?= (old('gender') == 'Male' ? 'selected' : '') ?>>Male</option>
        <option value="Female" <?= (old('gender') == 'Female' ? 'selected' : '') ?>>Female</option>
        <option value="Other" <?= (old('gender') == 'Other' ? 'selected' : '') ?>>Other</option>
    </select><br><br>

    <label for="address">Address:</label>
    <textarea name="address" id="address"><?= old('address') ?></textarea><br><br>

    <label for="department">Department:</label>
    <input type="text" name="department" id="department" value="<?= old('department') ?>"><br><br>

    <label for="designation">Designation:</label>
    <input type="text" name="designation" id="designation" value="<?= old('designation') ?>"><br><br>

    <label for="hire_date">Hire Date:</label>
    <input type="date" name="hire_date" id="hire_date" value="<?= old('hire_date') ?>" required><br><br>

    <label for="salary">Salary:</label>
    <input type="number" name="salary" id="salary" step="0.01" value="<?= old('salary') ?>" required><br><br>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="Active" <?= (old('status') == 'Active' ? 'selected' : '') ?>>Active</option>
        <option value="Inactive" <?= (old('status') == 'Inactive' ? 'selected' : '') ?>>Inactive</option>
    </select><br><br>

    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="admin" <?= (old('role') == 'admin' ? 'selected' : '') ?>>admin</option>
        <option value="user" <?= (old('role') == 'user' ? 'selected' : '') ?>>user</option>
    </select><br><br>

    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
        <!-- <small class="text-danger">Please reselect the file if there are validation errors.</small> -->
    </div>

    <button type="submit">Submit</button>
</form>

<script>

    if (document.querySelector('.alert-danger')) {
        alert('Please reselect the profile picture before resubmitting.');
    }
</script>
