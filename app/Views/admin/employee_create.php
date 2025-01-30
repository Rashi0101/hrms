<<<<<<< HEAD
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgb(65, 163, 62);
            color: white;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            display: block;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: rgb(42, 57, 44);
        }
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h2 class="text-center">Ornate TechnoServices</h2>
            <hr>
            <a href="<?= site_url('Home/home') ?>">Home</a>
            <a href="<?= site_url('Home/employee') ?>">Employees List</a>
            <a href="<?= site_url('payroll') ?>">Payroll</a>
            <a href="<?= site_url('backend/admin/adminleaves') ?>">Leaves</a>
            <a href="<?= site_url('Home/holidays') ?>">Holidays</a>
            <a href="<?= site_url('admin/attendance') ?>">Attendance</a>
        </div>
        <div>
            <hr>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="<?= site_url('Home/logout') ?>">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
      <div class="content">
        <!-- Display Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <!-- Display Validation Errors -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Display General Message (e.g., from the controller) -->
        <?php if (session()->get('message')): ?>
            <div class="alert alert-success">
                <?= session()->get('message') ?>
            </div>
        <?php endif; ?>

        <!-- Display General Error Message -->
        <?php if (session()->get('error')): ?>
            <div class="alert alert-danger">
                <?= session()->get('error') ?>
            </div>
        <?php endif; ?>

        <!-- Employee Form -->
        <h2>New Employee Form</h2>
        <form action="<?= base_url('backend/employee_create/save_employee') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
            </div>

        <div class="mb-3">
                <label for="contact_number" class="form-label">Phone:</label>
                <input type="number" name="contact_number" id="contact_number" class="form-control" value="<?= old('contact_number') ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
            </div>

            

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" id="dob" class="form-control" value="<?= old('dob') ?>" required>
            </div>

            <div class="mb-3">
                   <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="male" <?= (old('gender') == 'Male' ? 'selected' : '') ?>>Male</option>
                    <option value="female" <?= (old('gender') == 'Female' ? 'selected' : '') ?>>Female</option>
                    <option value="other" <?= (old('gender') == 'Other' ? 'selected' : '') ?>>Other</option>
                </select>
            </div>

 <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea name="address" id="address" class="form-control"><?= old('address') ?></textarea>
            </div>


 <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group:</label>
                <input type="text" name="blood_group" id="blood_group" class="form-control" value="<?= old('blood_group') ?>">
            </div>



<div class="mb-3">
                <label for="profile_photo" class="form-label">Profile Picture:</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control">
            </div>

  <div class="mb-3">
                <label for="married_status" class="form-label">Married Status:</label>
                <select name="married_status" id="married_status" class="form-select" required>
                    <option value="single" <?= (old('married_status') == 'Single' ? 'selected' : '') ?>>Single</option>
                    <option value="married" <?= (old('married_status') == 'Married' ? 'selected' : '') ?>>Married</option>
                </select>
            </div>

<div class="mb-3">
                <label for="eme_number" class="form-label">Emergency Contact Number:</label>
                <input type="number" name="eme_number" id="eme_number" class="form-control" step="0.01" value="<?= old('eme_number') ?>" required>
            </div>

            <div class="mb-3">
                <label for="eme_name" class="form-label">Emergency Contact Name:</label>
                <input type="text" name="eme_name" id="eme_name" class="form-control" value="<?= old('eme_name') ?>" required>
            </div>

            <div class="mb-3">
                <label for="eme_relation" class="form-label">Emergency Contact Relation:</label>
                <input type="text" name="eme_relation" id="eme_relation" class="form-control" value="<?= old('eme_relation') ?>" required>
            </div>
           
            <div class="mb-3">
                <label for="department_id" class="form-label">Department ID:</label>
                <input type="number" name="department_id" id="department_id" class="form-control" value="<?= old('department_id') ?>">
            </div>

            <div class="mb-3">
                <label for="designation_id" class="form-label">Designation ID:</label>
                <input type="number" name="designation_id" id="designation_id" class="form-control" value="<?= old('designation_id') ?>">
            </div>

            <div class="mb-3">
                <label for="reporting_manager" class="form-label">Reporting Manager ID:</label>
                <input type="number" name="reporting_manager" id="reporting_manager" class="form-control" value="<?= old('reporting_manager') ?>">
            </div>

            

            <div class="mb-3">
                <label for="doj" class="form-label">Hire Date:</label>
                <input type="date" name="doj" id="doj" class="form-control" value="<?= old('doj') ?>" required>
            </div>

            <div class="mb-3">
                <label for="emp_status" class="form-label">Status:</label>
                <select name="emp_status" id="emp_status" class="form-select">
                    <option value="active" <?= (old('status') == 'Active' ? 'selected' : '') ?>>Active</option>
                    <option value="inactive" <?= (old('status') == 'Inactive' ? 'selected' : '') ?>>Inactive</option>
                    <option value="terminated" <?= (old('status') == 'Terminated' ? 'selected' : '') ?>>Terminated</option>
                </select>
            </div>

            
           <div class="mb-3">
                <label for="team_id" class="form-label">Team ID:</label>
                <input type="number" name="team_id" id="team_id" class="form-control" value="<?= old('team_id') ?>">
            </div>
            

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

        <!-- Excel Upload Form -->
        <h3>Upload Employee List (Excel)</h3>
        <form action="<?= base_url('backend/employee_create/upload_excel') ?>" method="post" enctype="multipart/form-data">
            <label for="excel_file">Choose Excel File:</label>
            <input type="file" name="excel_file" id="excel_file" accept=".xls, .xlsx" required>
            <button type="submit" class="btn btn-primary mt-3">Upload Excel File</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
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
<<<<<<< HEAD
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
