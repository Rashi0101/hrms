<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorBox = document.getElementById('client-errors');

            let errors = [];

            if (!email) {
                errors.push("Email is required.");
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                errors.push("Invalid email format.");
            }

            if (!password) {
                errors.push("Password is required.");
            } else if (password.length < 6) {
                errors.push("Password must be at least 6 characters long.");
            }

            if (errors.length > 0) {
                errorBox.style.display = 'block';
                errorBox.innerHTML = errors.join('<br>');
                return false;
            }

            errorBox.style.display = 'none';
            return true;
        }
    </script>
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="<?= base_url('app/image/logo.jpg') ?>" alt="Company Logo" class="logo">

        <div class="card-body">

            <!-- Display session flash errors -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?= implode('<br>', session()->getFlashdata('errors')); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div id="client-errors" class="alert alert-danger" style="display: none;"></div>

            <!-- Login form -->
            <form action="<?= base_url('login/authenticate') ?>" method="POST" onsubmit="return validateForm();">
    <?= csrf_field() ?>

    <!-- Form fields -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>

        </div>
    </div>
</body>
</html>
