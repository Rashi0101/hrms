<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            height: 380px;
            text-align: center;
            position: relative;
        }

        /* Header styles */
        .login-container h2 {
            color: #4caf50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Input field styles */
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        /* Error message styles */
        .error {
            font-size: 12px;
            color: red;
            text-align: center;
        }

        /* Input focus effect */
        input[type="text"]:focus,
        input[type="password"]:focus {
            color: #4caf50;
            border-color: #4caf50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
            transition: all 0.3s ease;
        }

        /* Submit button styles */
        input[type="submit"] {
            background: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 102%;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #388e3c;
        }


        .forget-password {
            position: absolute;
            bottom: 20px;
            right: 35%;
            color: #4caf50;
            border: #4caf50;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .add-user:hover, .forget-password:hover {
            background: #4caf50;
            color: white;
        }

        /* Additional responsiveness */
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo with clickable link -->
        <a href="https://ornatets.com/" target="_blank">
            <img src="<?= base_url('uploads/image.png') ?>" alt="Ornate Tech Logo" style="max-width: 100%; height: auto;">
        </a>
        <h2>Login</h2>
        <!-- Login Form -->
        <form id="loginForm" method="post" action="<?= base_url('backend/authenticate'); ?>">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
            <input type="text" id="username" name="username" placeholder="Enter your E-mail" 
                   value="<?= old('username') ?>" required aria-label="Username">
            <span class="error" id="name-error"></span>
            <input type="password" name="password" placeholder="Password" required aria-label="Password">
            <input type="submit" id="submitBtn" value="Login" >
        </form>

        <!-- Display Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <p class="error"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

        <!-- Add User and Forget Password Buttons -->
        
        <a href="<?= base_url('Home/forget') ?>" class="forget-password">Forget Password</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nameField = document.getElementById("username");
            const nameError = document.getElementById("name-error");
            const submitBtn = document.getElementById("submitBtn");

            // Regular Expression for Name Validation
            const namePattern = /^[a-zA-ZÀ-ſ]{3,}(?:[.'-][a-zA-ZÀ-ſ]{1,})?(?:\s[a-zA-ZÀ-ſ]{1,}(?:[.'-]?[a-zA-ZÀ-ſ]+))$/;

            Restore validation state on page reload
            if (namePattern.test(nameField.value)) {
                nameError.textContent = ""; 
                submitBtn.disabled = false; 
            }

            Validate Name Field
            nameField.addEventListener("input", function () {
                if (namePattern.test(nameField.value)) {
                    nameError.textContent = ""; // Clear error
                    submitBtn.disabled = false; // Enable the submit button
                } else {
                    nameError.textContent = "Please enter a valid name (letters and spaces only).";
                    submitBtn.disabled = true; // Disable the submit button
                }
            });
        });
    </script>
</body>
</html>