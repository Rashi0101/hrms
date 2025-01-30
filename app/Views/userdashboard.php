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
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 50%;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h2>Ornate TechnoServices</h2>
            <hr>
            <a href="<?= site_url('Home/home') ?>">Home</a>
            <hr>
            <a href="<?= site_url('Home/employee') ?>">Employees List</a>
            <hr>
            <a href="<?= site_url('Home/timesheet') ?>">Timesheet</a>
            <hr>
            <a href="<?= site_url('Home/payroll') ?>">Payroll</a>
            <hr>
            <a href="<?= site_url('Home/userList') ?>">Leaves</a>
            <hr>
            <a href="<?= site_url('Home/holidays') ?>">Holidays</a>
            <hr>
            <a href="<?= site_url('admin/attendance') ?>">Attendance</a>
            <hr>
        </div>
        <div>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="<?= site_url('Home/logout') ?>">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container mt-5">
            <h4>Welcome, <?= session()->get('name'); ?>!</h4>
            <img src="<?= base_url('uploads/' . session()->get('profile_picture')); ?>" alt="Profile Picture" class="profile-pic">
            <p><strong>Employee ID:</strong> <?= session()->get('emp_id'); ?></p>
            <p><strong>Department:</strong> <?= session()->get('department'); ?></p>
            <p><strong>Designation:</strong> <?= session()->get('designation'); ?></p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="container mt-5">
        <form method="GET" action="<?= site_url('/') ?>" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" id="search-input" class="form-control" placeholder="Enter Employee Code or Name" required autocomplete="off">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
            <!-- Dropdown for search suggestions -->
            <ul id="suggestions" class="list-group mt-2" style="position: absolute; z-index: 1000; width: 50%; display: none;"></ul>
        </form>
    </div>

    <!-- JavaScript for fetching and displaying suggestions -->
    <script>
        document.getElementById('search-input').addEventListener('input', function () {
            let query = this.value.trim();
            let suggestionsBox = document.getElementById('suggestions');

            if (query.length === 0) {
                suggestionsBox.style.display = 'none';
                return;
            }

            // Fetch suggestions from the server
            fetch('<?= site_url('Home/suggest') ?>?letter=' + query)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(employee => {
                            let listItem = document.createElement('li');
                            listItem.className = 'list-group-item list-group-item-action';
                            listItem.textContent = `${employee.name} (ID: ${employee.emp_id})`;

                            // When a suggestion is clicked, fill the search input with the employee name
                            listItem.addEventListener('click', () => {
                                document.getElementById('search-input').value = employee.name;
                                suggestionsBox.style.display = 'none';
                            });

                            suggestionsBox.appendChild(listItem);
                        });
                        suggestionsBox.style.display = 'block';
                    } else {
                        suggestionsBox.style.display = 'none';  // Hide the suggestions box if no results
                    }
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                    suggestionsBox.style.display = 'none';
                });
        });

        // Hide suggestions when clicking outside the suggestions box
        document.addEventListener('click', function (event) {
            if (!event.target.closest('#search-input') && !event.target.closest('#suggestions')) {
                document.getElementById('suggestions').style.display = 'none';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
