<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .dashboard-header h1 {
            margin: 0;
        }
        .search-container {
            display: flex;
            width: 300px;
            position: relative;
        }
        .search-bar {
            width: 100%;
            border-radius: 0.25rem 0 0 0.25rem; /* Rounded left side */
        }
        .search-btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 0 10px;
            border-radius: 0 0.25rem 0.25rem 0; /* Rounded right side */
            cursor: pointer;
        }
        .search-btn:hover {
            background-color: #0056b3;
        }
        .suggestions-list {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome to the Admin Dashboard</h1>
            
            <div>
                <!-- Search Box with Search Icon -->
                <div class="search-container">
                    <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search..." onkeyup="showSuggestions()" autocomplete="off">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                    <!-- Suggestions dropdown -->
                    <div id="suggestions" class="suggestions-list" style="display: none;"></div>
                </div>

                <!-- Logout Button -->
                <button class="btn btn-danger" onclick="logoutUser()">Logout</button>
            </div>
        </div>

        <div class="dashboard-links">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="<?= base_url('admin/attendance') ?>">Attendance</a></li>
                <li><a href="<?= base_url('admin/employee_create') ?>">Employee Creation</a></li>
                <li><a href="<?= base_url('admin/leaves') ?>">Leaves</a></li>
                <li><a href="<?= base_url('admin/holiday') ?>">Holiday List</a></li>
                <li><a href="<?= base_url('admin/employeeview') ?>">Employee List</a></li>
            </ul>
        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // This function is triggered when the user types in the search box
        function showSuggestions() {
            const searchInput = document.getElementById('searchInput').value;
            const suggestionsList = document.getElementById('suggestions');

            if (searchInput.length < 1) {
                suggestionsList.style.display = 'none';
                return;
            }

            // Send AJAX request to the server to fetch matching data
            fetch(`/admin/search_employees?query=${searchInput}`)
                .then(response => response.json())
                .then(data => {
                    // If there are results, show them
                    if (data.length > 0) {
                        suggestionsList.innerHTML = ''; // Clear previous results
                        data.forEach(employee => {
                            const div = document.createElement('div');
                            div.classList.add('suggestion-item');
                            div.textContent = employee.name; // Display employee name
                            div.onclick = () => selectEmployee(employee); // Handle item click
                            suggestionsList.appendChild(div);
                        });
                        suggestionsList.style.display = 'block';
                    } else {
                        suggestionsList.style.display = 'none'; // No suggestions, hide the list
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // When a suggestion is clicked, fill the input field with the selected name
        function selectEmployee(employee) {
            document.getElementById('searchInput').value = employee.name;
            document.getElementById('suggestions').style.display = 'none';
            // Optionally, navigate to the employee page or perform any other action
            window.location.href = `/admin/employeeview/${employee.id}/edit`; // Replace with actual employee edit URL
        }

     function logoutUser() {
    if (confirm("Are you sure you want to logout?")) {
        fetch('/newhrms/public/admin/logout', { method: 'POST' })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Parse the JSON response
                } else {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
            })
            .then(data => {
                if (data.status === 'success') {
                window.location.href = '/newhrms/public/'; // Adjust the URL to include `/newhrms/public/`
                } else {
                    alert('Logout failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error during logout:', error);
                alert(`An error occurred: ${error.message}`);
            });
    }
}


    </script>
</body>
</html>
